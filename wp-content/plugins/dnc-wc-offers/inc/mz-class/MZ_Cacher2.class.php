<?php

/*
Copyright (c) 2016 Martovianus Zolus

Permission is hereby granted, free of charge, to any person obtaining a copy 
of this software and associated documentation files (the "Software"), to deal 
in the Software without restriction, including without limitation the rights 
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell 
copies of the Software, and to permit persons to whom the Software is 
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in 
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE 
SOFTWARE.
*/

/**
 * Base class intended to aid in chacing & automatic-packaging of assets to accelerate page delivery
 */

abstract class MZ_Cacher2{
	const CACHE_MAX_AGE = 86400;
	
	private /* array( string ) */ $extensions;
	private /* array( string:directory-path => string:url-path ) */ $sources;
	private /* string */ $cacheDirectory;
	private /* int */ $maxAge;
	private /* string:format */ $contentTypeFormat;
	private /* bool */ $laxRevalidate;
	private /* bool */ $exclusiveImports;
	
	protected function __construct( array $args ){
		foreach( array(
			'extensions',
			'sources',
			'cacheDirectory',
			'maxAge',
			'contentTypeFormat',
			'laxRevalidate',
			'exclusiveImports',
		) as $var )
			$$var = MZ_Arrays::isget( $var, $args, null );
		
		$extensions = array_filter( (array)$extensions );
		if( empty( $extensions ) )
			throw new Exception( '[%s] No extensions', __METHOD__ );
		
		$this->extensions = $extensions;
		
		$thisSources = array();
		foreach( array_filter( (array)$sources ) as $key => $tmp ){
			if( !is_array( $tmp ) ){
				$url = is_string( $key ) ? MZ_Strings::mb_trim( $key ) : MZ_Assure::findURLForPath( $dir );
				$path = MZ_Strings::mb_trim( $tmp );
			}else
				list( $path, $url ) = array_map( 'MZ_Strings::mb_trim', $tmp );
			
			if( '' === $url )
				throw new Exception( sprintf( '[%s] Empty URL: %s', __METHOD__, var_export( $tmp, true ) ) );
			
			if( !is_dir( $path ) )
				throw new Exception( sprintf( '[%s] Not a directory: %s', __METHOD__, $path ) );
			
			$path = MZ_Files::normalizeDirectory( $path );
			if( isset( $thisSources[ $path ] ) )
				throw new Exception( sprintf( '[%s] Multiple entries for directory: %s', __METHOD__, $path ) );
			
			$thisSources[ $path ] = MZ_Files::normalizeDirectory( $url, '/' );
		} // foreach $url => $dir
		
		if( empty( $thisSources ) )
			throw new Exception( sprintf( '[%s] No valid source directories', __CLASS__ ) );
		
		$this->sources = $thisSources;
		
		$cacheDirectory = MZ_Strings::mb_trim( $cacheDirectory );
		
		if( !is_dir( $cacheDirectory ) )
			$cacheDirectory = key( $thisSources ) . 'dnu-cache';
		
		$this->cacheDirectory = MZ_Files::normalizeDirectory( $cacheDirectory );
		
		$this->maxAge = ( is_int( $maxAge ) && ( 0 <= $maxAge ) ) ? $maxAge : self::CACHE_MAX_AGE;
		
		$contentTypeFormat = MZ_Strings::mb_trim( $contentTypeFormat );
		if( empty( $contentTypeFormat ) )
			throw new Exception( sprintf( '[%s] Empty content-type format', __METHOD__ ) );
		
		$this->contentTypeFormat = $contentTypeFormat;
		
		$this->laxRevalidate = (bool)$laxRevalidate;
		$this->exclusiveImports = (bool)$exclusiveImports;
	} // method MZ_Cacher2::__construct
	
	public function __get( $name ){
		return isset( $this->$name ) ? $this->$name : null;
	} // method MZ_Cacher2::__get
	
	/**
	 * 
	 */
	public final function process( $query = null ){
		$paths = $this->prepareQuery0( self::normalizeQuery0( $query ) );
		
		if( empty( $paths ) ){
			header( 'Content-Length: 0' );
			MZ_Assure::dieWithCode( 200 );
		} // endif empty( $paths )
		
		$tmp = $this->getCacheFile0( $paths );
		
		if( is_array( $tmp ) ){
			list( $cacheFile, $cacheTime ) = $tmp;
			header( 'Content-Type: ' . sprintf( $this->contentTypeFormat, MZ_Strings::output_encoding() ) );
			header( sprintf( $this->getCacheFormat0(), $this->maxAge) );
			header( sprintf( 'Last-Modified: %s GMT', gmdate( 'D, d M Y H:i:s', $cacheTime ) ) );
			header( 'Vary: If-Modified-Since', false );
			
			if( MZ_Compat::http_match_modified( $cacheTime ) )
				MZ_Assure::dieWithCode( 304, null, false, false );
			
			$cacheSize = MZ_Files::get_file_length( $cacheFile );
			if( false !== $cacheSize ){
				if( 0 < $cacheSize ){
					header( sprintf( 'Content-Length: %d', $cacheSize ) );
				
					if( false !== @readfile( $cacheFile ) )
						die();
					
					MZ_Debug::log( '[%s] Unable to emit css {%s}: %s', __CLASS__, $query, $cacheFile );
				}else
					MZ_Debug::log( '[%s] Empty cachefile {%s}: %s', __CLASS__, $query, $cacheFile );
			}else
				MZ_Debug::log( '[%s] Cache file was deleted before reading {%s}: %s', __CLASS__, $query, $cacheFile );
			
			if( !headers_sent() )
				header( 'Content-Length: 0' ); // Best-effort patchup
		} // endif is_array( $tmp )
		
		MZ_Assure::dieWithCode( 500 );
	} // method MZ_Cacher2::process
	
	/**
	 * Convert each slug into an absolute path based on the $this->sources, and $this->$extensions
	 *
	 * @return array( string:file-path => string:url-path )
	 */
	protected function pathsForSlug( $slug ){
		$ret = array();
		
		$extensions = $this->extensions;
		$exclusiveImports = $this->exclusiveImports;
		
		foreach( $this->sources as $dir => $url ){
			$prefix = $dir . $slug . '.';
			foreach( $extensions as $extension ){
				$path = $prefix . $extension;
				if( @is_file( $path ) ){
					if( !isset( $ret[ $path ] ) )
						$ret[ $path ] = $url;
					
					if( $exclusiveImports )
						return $ret;
				} // endif @is_file( $path )
			} // foreach $extension
		} // foreach $dir => $url
		
		return $ret;
	} // method MZ_Cacher2::pathsForSlug
	
	/**
	 * @returns void
	 */
	protected abstract function beginRebuild();
	
	/**
	 * @returns void
	 */
	protected abstract function addToRebuild( $filePath, $urlPath );
	
	/**
	 * @returns array( string, array( string:file-path ) )|false
	 */
	protected abstract function finishRebuild();
	
	private function getCacheFormat0(){
		return $this->laxRevalidate ? 'Cache-Control: public, max-age=%d' : 'Cache-Control: public, max-age=%d, must-revalidate';
	} // method MZ_Cacher2::getCacheFormat0
	
	private function getCacheFile0( array $paths ){
		$cacheDir = $this->cacheDirectory;
		if( !is_dir( $cacheDir ) ){
			if( !@mkdir( $cacheDir, 0755, true ) ){
				MZ_Debug::log( '[%s] Unable to create cache directory: %s', __CLASS__, $cacheDir );
				return false;
			} // endif !@mkdir( $cacheDir, 0755, true )
		} // endif !is_dir( $cacheDir )
		
		$filesList = json_encode( $paths );
		$cacheName = md5( $filesList );
		
		/*
		 * Check cache
		 */
		$base = $cacheDir . $cacheName;
		$cacheFile = $base . '.css';
		$listFile = $base . '.list';
		
		$cacheTime = MZ_Files::mtime( $cacheFile );
		if( self::isCacheMoreRecentThan0( $cacheTime, MZ_Files::mtime( __FILE__ ) ) ){
			$listData = is_file( $listFile ) ? @file_get_contents( $listFile ) : false; // Best-effort, prevent warning spam of error log
			$listData = array_filter( mb_split( '[\n\r]+', (string)$listData ) );
			if( !empty( $listData ) ){
				if( $filesList === array_shift( $listData ) ){
					if( !empty( $listData ) ){
						$good = true;
						foreach( $listData as $filePath ){
							$fileTime = $this->findMostModifiedVersion0( $filePath );
							
							if( !self::isCacheMoreRecentThan0( $cacheTime, $fileTime ) ){
								$good = false;
								break;
							} // endif !self::isCacheMoreRecentThan0( $cacheTime, $filePath )
						} // foreach $filePath
						
						if( $good )
							return array( $cacheFile, $cacheTime );
					} // endif !empty( $listData )
				} // endif $filesList === $listData
			} // endif !empty( $listData )
		} // endif self::isCacheMoreRecentThan0( $cacheTime, __FILE__ )
		
		/*
		 * Rebuild cache
		 */
		$this->beginRebuild();
		
		foreach( $paths as $path => $url )
			$this->addToRebuild( $path, $url );
		
		$result = $this->finishRebuild();
		if( false === $result )
			return false;
		
		list( $data, $listData ) = $result;
		
		if( false === file_put_contents( $cacheFile, $data ) ){
			MZ_Debug::log( '[%s] Unable to write cachefile: %s', __CLASS__, $cacheFile );
			return false;
		} // endif false === @file_put_contents( $cacheFile, $data )
		
		array_unshift( $listData, $filesList );
		@file_put_contents( $listFile, implode( PHP_EOL, $listData ) ); // best-effort
		return array( $cacheFile, time() );
	} // method MZ_Cacher2::getCacheFile0
	
	private function findMostModifiedVersion0( $filePath ){
		$mtime = MZ_Files::mtime( $filePath );
		if( false === $mtime ) // File no longer exists (or inaccessible), but was used in last build
			return false;
		
		$sources = array_keys( $this->sources );
		$bestRelative = null;
		$bestLength = null;
		foreach( $sources as $source ){
			$sourceLength = mb_strlen( $source );
			if( mb_substr( $filePath, 0, $sourceLength ) !== $source )
				continue;
			
			$relative = mb_substr( $filePath, $sourceLength );
			$length = mb_strlen( $relative );
			if( ( null === $bestRelative ) || ( $length < $bestLength ) ){
				$bestRelative = $relative;
				$bestLength = $length;
			} // endif ( null === $bestRelative ) || ( $length < $bestLength )
		} // foreach $source
		
		if( null === $bestRelative ) // Likely, some import from an unexpected place.  Legal, but unhelpful
			return $mtime;
		
		foreach( $sources as $source ){
			$time = MZ_Files::mtime( $source . $bestRelative );
			if( ( false !== $time ) && ( $time > $mtime ) )
				$mtime = $time;
		} // foreach $source
		
		return $mtime;
	} // method MZ_Cacher2::findMostModifiedVersion0
	
	/**
	 * Derives paths from the slugs
	 * returns the paths which link to valid files
	 *
	 * @returns array( string:file-path => string:url-path )
	 */
	private function prepareQuery0( array $slugs ){
		$ret = array();
		
		foreach( array_map( array( $this, 'pathsForSlug' ), $slugs ) as $paths ){
			foreach( $paths as $path => $url ){
				if( !isset( $ret[ $path ] ) )
					$ret[ $path ] = $url;
			} // foreach $path => $url
		} // foreach $paths
		
		return $ret;
	} // method MZ_Cacher2::prepareQuery0
	
	/**
	 * If query is empty, set to to the current query string
	 * If query is not an array, make it one by exploding on semicolon
	 * Whitelist each element of query (since it is now an array)
	 * Filter out empty elements
	 * Filter out after-first duplicate elements w/o reordering query
	 *
	 * @returns array( string:slug )
	 */
	private static function normalizeQuery0( $query ){
		if( empty( $query ) )
			$query = MZ_Arrays::isget( 'QUERY_STRING', $_SERVER, '' );
		
		if( !is_array( $query ) )
			$query = MZ_Strings::mb_explode( ';', (string)$query );
		
		return MZ_Arrays::ordered_unique_strings( array_filter( array_map( 'MZ_Strings::slugify', $query ) ) );
	} // method MZ_Cacher2::normalizeQuery0
	
	private static function isCacheMoreRecentThan0( $cacheTime, $fileTime ){
		return ( false !== $cacheTime ) && ( false !== $fileTime ) && ( $cacheTime >= $fileTime );
	} // method MZ_Cacher2::isCacheMoreRecentThan0
} // class MZ_Cacher2
