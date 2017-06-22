<?php

/*
Copyright (c) 2015 Martovianus Zolus

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
 *
 * @deprecated
 * @see MZ_Cacher2
 */

abstract class MZ_Cacher{
	const LOOP_CUTOFF = 8;
	
	private /* array( string ) */ $slugs = array();
	private /* array( string: path ); ordered from independent to dependent */ $paths = array();
	
	private /* string: path */ $cache_file = null;
	private /* string: path */ $cache_tmp = null;
	private /* int: unix timestamp */ $cache_mtime = null;
	private /* resource: file handle */ $cache_handle = null;
	private /* int: length */ $cache_length = null;
	
	protected function __construct(){
		// Does nothing
	} // method MZ_Cacher::__construct
	
	/**
	 * string: solidus-suffixed directory path
	 */
	protected abstract function get_source_dir();
	
	/**
	 * array( string: simple filename extension )
	 */
	protected abstract function get_extensions();
	
	protected abstract function default_headers();
	
	/**
	 * string: solidus-suffixed directory path
	 */
	protected function get_cache_dir(){
		static $dir = false;
		if( $dir === false ){
			$tmp = $this->get_source_dir() . 'cache/';
			$dir = ( is_dir( $tmp ) || @mkdir( $tmp ) ) ? $tmp : null;
		} // endif $dir === false
		return $dir;
	} // method MZ_Cacher::get_cache_dir
	
	protected function get_temp_dir(){
		static $dir = false;
		if( $dir === false ){
			$tmp = $this->get_source_dir() . 'tmp/';
			$dir = ( is_dir( $tmp ) || @mkdir( $tmp ) ) ? $tmp : null;
		} // endif $dir === false
		return $dir;
	} // method MZ_Cacher::get_temp_dir
	
	protected function filter_slug( $slug ){
		return true;
	} // method MZ_Cacher::filter_slug
	
	protected function filter_paths_for_slug( array $paths, $slug ){
		return MZ_Arrays::ordered_unique( $paths );
	} // method MZ_Cacher::filter_paths_for_slug
	
	/**
	 * array( string: file path | MZ_CacheSource )
	 */
	protected function sources_for_slug( $slug ){
		$paths = array();
		$prefix = $this->get_source_dir() . $slug . '.';
		foreach( $this->get_extensions() as $extension )
			$paths[] = $prefix . $extension;
		return $this->filter_paths_for_slug( array_filter( $paths, 'is_file' ), $slug );
	} // method MZ_Cacher::sources_for_slug
	
	protected function get_epoch(){
		return MZ_Files::mtime( __FILE__ );
	} // method MZ_Cacher::get_epoch
	
	protected function process_begin( $first_path ){
		// Do nothing
	} // method MZ_Cacher::process_begin
	
	protected function process_end( $last_path ){
		// Do nothing
	} // method MZ_Cacher::process_end
	
	protected function process_path( $path ){
		return @file_get_contents( $path );
	}
	
	const PATTERN_COMMENT = '/\*.*?\*/';
	const PATTERN_LINE = '^\s*depends\s*\:\s*(.*?)\s*$';
	
	/**
	 * By default, attempt to read the first C-style comment from the file, and look for lines starting in 'Depends:' (case and whitespace insensitive).  Resolve the trimmed suffix of the line as a path
	 */
	protected function find_dependencies_for_path( $path ){
		$data = (string)@file_get_contents( $path );
		$regs = array();
		if( mb_ereg( self::PATTERN_COMMENT, $data, $regs ) === false ){ // Only look in the first comment
			MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE_EXCESSIVE, 'File has no comments: %s', $path );
			return array();
		} // endif mb_ereg( self::PATTERN_COMMENT, $data, $regs ) === false
		if( !mb_ereg_search_init( $regs[ 0 ], self::PATTERN_LINE, 'mir' ) ){
			MZ_Debug::log( 'Could not initialize regex: %s', self::PATTERN_LINE );
			return false;
		} // endif !mb_ereg_search_init( $regs[ 0 ], self::PATTERN_LINE, 'mir' )
		$ret = array();
		while( ( $regs = mb_ereg_search_regs() ) !== false )
			$ret[] = $regs[ 1 ];
		MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE_EXCESSIVE, 'Dependancy-slugs: %s', print_r( $ret, true ) );
		return $this->realize_paths( $ret );
	} // method MZ_Cacher::find_dependencies_for_path
	
	protected final function realize_paths( array $paths ){
		$paths = array_map( array( $this, 'realize_path0' ), $paths ); // Convert relative paths to absolute; check that all paths are in source directory
		MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE_EXCESSIVE, 'Realized paths: %s', print_r( $paths, true ) );
		$paths = array_filter( $paths ); // Filter out the paths rejected above
		return MZ_Arrays::ordered_unique_strings( $paths );
	} // method MZ_Cacher::realize_paths
	
	public function process( $query = null ){
		// 1st, prepare query (if it isn't already an array) into an array of slugs
		if( $this->prepare_query0( $query ) ){
			// We now have a total listing of all the files that we need.  Synthesize our cache info.
			$this->init_cache0();
			if( $this->fetch_cache0() || ( $this->create_cache0() && $this->process_sources0() ) ){
				if( !MZ_Compat::http_match_modified( $this->cache_mtime ) ){
					$this->do_headers0( array(
						sprintf( 'Last-Modified: %s GMT', gmdate( 'D, d M Y H:i:s', $this->cache_mtime ) ) => true,
						'Vary: If-Modified-Since' => false,
						sprintf( 'Content-Length: %d', $this->cache_length ) => true,
					) );
					if( !( $this->emit_data0() || headers_sent() ) )
						header( 'Content-Length: 0', true );
				}else
					$this->do_headers0( array(
						sprintf( '%s 304 Not Modified', MZ_Arrays::isget( 'SERVER_PROTOCOL', $_SERVER, 'HTTP/1.1' ) ) => true,
					) );
			}else
				$this->do_headers0( array(
					sprintf( '%s 500 Internal Server Error', MZ_Arrays::isget( 'SERVER_PROTOCOL', $_SERVER, 'HTTP/1.1' ) ) => true,
				) );
		} // endif $this->prepare_query0( $query )
		$this->abort_cache0();
	} // method MZ_Cacher::process
	
	private function default_headers0(){
		$headers = $this->default_headers();
		if( empty( $headers ) || !is_array( $headers ) )
			$headers = array(
				sprintf( 'Content-Type: text/plain; charset=%s', DEFAULT_ENCODING ) => true,
				sprintf( 'Cache-Control: public, max-age=%d, must-revalidate', ( MZ_Debug::is_debug() ? 0 : 86400 ) ) => true,
			);
		return $headers;
	} // method MZ_Cacher::default_headers0
	
	private function do_headers0( array $headers ){
		if( headers_sent() ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_WARN, 'Headers already sent: %s', print_r( $headers, true ) );
			return false;
		} // endif headers_sent()
		foreach( array_merge( $this->default_headers0(), $headers ) as $header => $replace ){
			if( is_numeric( $header ) ){ // Patchup for people not obeying the expected parameter structure
				$header = $replace;
				$replace = true;
			} // endif is_numeric( $header )
			header( $header, $replace );
		} // foreach $header => $replace
		return true;
	} // method MZ_Cacher::do_headers
	
	private function emit_data0(){
		if( fseek( $this->cache_handle, 0, SEEK_SET ) === 0 )
			return @fpassthru( $this->cache_handle ) !== false;
		MZ_Debug::log( 'Unable to seek cache file for data: %s', $this->cache_file );
		return false;
	} // method MZ_Cacher::emit_data0
	
	private function abort_cache0(){
		if( !empty( $this->cache_handle ) ){
			fclose( $this->cache_handle );
			$this->cache_handle = null;
		} // endif !empty( $this->cache_handle )
		if( !empty( $this->cache_tmp ) ){
			unlink( $this->cache_tmp );
			$this->cache_tmp = null;
		} // endif !empty( $this->cache_tmp )
	} // method MZ_Cacher::abort_cache0
	
	private function create_cache0(){
		$tmp_dir = $this->get_temp_dir();
		for( $count = 0; $count < self::LOOP_CUTOFF; ++$count ){
			$tmp = sprintf( '%s%s', $tmp_dir, md5( uniqid( '', true ) ) ); // Quick-and-dirty temp filename
			if( ( $handle = @fopen( $tmp, 'x+b' ) ) !== false ){ // Intentional assign
				$this->cache_tmp = $tmp;
				$this->cache_handle = $handle;
				$this->cache_length = 0;
				return true;
			} // endif $handle !== false
			MZ_Debug::log_if( MZ_Debug::LEVEL_DEBUG, 'Filename collision: %s', $tmp );
		} // for $count < self::LOOP_CUTOFF
		MZ_Debug::log( 'Excessive attempts at making temporary file: %s', $this->cache_file );
		return false;
	} // method MZ_Cacher::create_cache0
	
	private function process_sources0(){
		$paths = $this->paths;
		if( list( , $path ) = each( $paths ) ){
			if( $this->append_cache0( $this->process_begin( $path ), '$begin' ) !== false ){
				do{
					MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE_EXCESSIVE, 'Processing source: %s', $path );
					if( $this->append_cache0( $this->process_path( $path ), $path ) === false ){
						$this->abort_cache0();
						return false;
					} // endif $this->append_cache0( $this->process_path( $path ), $path ) !== false
				}while( ( list( , $path ) = each( $paths ) ) !== false ); // Intentional assign
				if( $this->append_cache0( $this->process_end( $path ), '$end' ) !== false )
					return $this->finalize_cache0();
				MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_ERROR, 'Could not process epilog: %s', $this->cache_file );
			}else
				MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_ERROR, 'Could not process prolog: %s', $this->cache_file );
		} // endif each( $this )
		$this->abort_cache0();
		return false;
	} // method MZ_Cacher::process_sources0
	
	private function append_cache0( $data, $path ){
		if( $data !== false ){
			if( empty( $data ) ){
				MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, 'Empty file: %s', $path );
				return true; // Do nothing
			} // endif empty( $data )
			if( MZ_Files::fwrite_true( $this->cache_handle, $data ) !== false ){
				if( ( $this->cache_length += MZ_Strings::byte_len( $data ) ) >= 0 ) // Intentional assign
					return true;
				MZ_Debug::log( 'Integer overflow while calculating length: %s', $this->cache_file );
			}else
				MZ_Debug::log( 'Could not write file: %s', $this->cache_file );
		}else
			MZ_Debug::log( 'Data was false: %s', $this->cache_file );
		return false;
	} // method MZ_Cacher::append_cache0
	
	private function finalize_cache0(){
		assert( '!empty( $this->cache_tmp )' );
		if( !fflush( $this->cache_handle ) ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_ERROR, 'Could not flush cache tempfile: %s', $this->cache_tmp );
			return false;
		} // endif !fflush( $this->cache_handle )
		$this->cache_mtime = MZ_Files::mtime( $this->cache_handle );
		if( @rename( $this->cache_tmp, $this->cache_file ) ){
			$this->cache_tmp = null; // Prevents warnings in append_cache0()
			return true;
		} // endif @rename( $this->cache_tmp, $this->cache_file )
		if( copy( $this->cache_tmp, $this->cache_file ) )
			return true;
		MZ_Debug::log( 'Could not place cache file: %s', $this->cache_file );
		$this->abort_cache0();
		return false;
	} // method MZ_Cacher::finalize_cache0
	
	private function check_epoch0( $cache_time, $file ){
		if( $cache_time !== false ){
			if( $cache_time >= $this->get_epoch() ){
				if( $cache_time >= self::get_mtime_of0( $this->paths ) ){
					if( $cache_time >= $this->get_mtime_of0( $this->get_all_paths0() ) )
						return true;
					MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, 'Cache file older than dependency: %s', $file );
				}else
					MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, 'Cache file older than source: %s', $file );
			}else
				MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, 'Cache file older than code: %s', $file );
		}else
			MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, 'Unable to read mtime of cache file: %s', $file );
		return false;
	} // method MZ_Cacher::check_epoch0
	
	private static function get_mtime_of0( array $paths ){
		return empty( $paths ) ? 0 : max( array_map( 'MZ_Files::mtime', $paths ) );
	} // method MZ_Cacher::get_mtime_of0
	
	private function get_all_paths0(){
		$paths = array();
		$queue = $this->paths;
		while( ( list( , $path ) = each( $queue ) ) !== false ){ // Intentional assign
			if( isset( $paths[ $path ] ) )
				continue;
			$paths[ $path ] = $path; // Create entry
			foreach( $this->find_dependencies_for_path0( $path ) as $dependency ) // Manually enqueue
				$queue[] = $dependency;
		} // while $path !== false
		MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE_EXCESSIVE, 'Files considered: %s', print_r( $paths, true ) );
		return $paths;
	} // method MZ_Cacher::get_all_paths0
	
	private function find_dependencies_for_path0( $path ){
		$ret = $this->find_dependencies_for_path( $path );
		if( is_array( $ret ) )
			return $ret;
		MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_WARN, 'Not an array: %s', var_export( $ret, true ) );
		return array();
	} // function MZ_Cacher::find_dependencies_for_path0
	
	private function fetch_cache0(){
		$file = $this->cache_file;
		$handle = is_file( $file ) ? @fopen( $file, 'r+b' ) : false;
		if( $handle !== false ){
			$mtime = MZ_Files::mtime( $handle );
			if( $this->check_epoch0( $mtime, $file ) ){
				$length = MZ_Files::get_file_length( $handle );
				if( $length !== false ){
					$this->cache_handle = $handle;
					$this->cache_mtime = $mtime;
					$this->cache_length = $length;
					return true;
				} // endif $length !== false
				MZ_Debug::log_if( MZ_Debug::LEVEL_OFF, 'Unable to fetch length of cache file: %s', $file );
			} // endif $this->check_epoch0( $mtime, $file )
			@fclose( $handle ); // Best-effort
		}else
			MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, 'Unable to open cache file: %s', $file );
		return false;
	} // method MZ_Cacher::fetch_cache0
	
	private function init_cache0(){
		$this->cache_file = empty( $this->slugs ) ? false : sprintf( '%s%s.dat', $this->get_cache_dir(), implode( '$', $this->slugs ) );
	} // method MZ_Cacher::init_cache0
	
	private function prepare_query0( $query ){
		if( !( is_string( $query ) || is_array( $query ) ) )
			$query = MZ_Arrays::isget( 'QUERY_STRING', $_SERVER, '' );
		if( is_array( $query ) )
			$query = implode( ';', $query );
		$query = mb_ereg_replace( '[^a-zA-Z0-9\-_;]+', '', $query, 'msr' ); // Whitelist the query
		MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE_EXCESSIVE, 'Original query: %s', $query );
		
		$slugs = MZ_Strings::mb_explode( ';', $query ); // Break out into slugs
		$slugs = array_filter( $slugs, array( $this, 'filter_slug' ) ); // Allow subclasses to filter the slugs
		$slugs = array_map( 'strval', $slugs ); // Force the results to strings
		$slugs = array_filter( $slugs ); // Filter out any empty slugs
		$slugs = MZ_Arrays::ordered_unique_strings( $slugs ); // Prune any duplicates w/o re-ordering the list
		MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE_EXCESSIVE, 'Raw slugs: %s', print_r( $slugs, true ) );
		
		$paths_array = array_filter( array_map( array( $this, 'sources_for_slug' ), array_combine( $slugs, $slugs ) ) ); // Convert slugs into arrays of paths
		MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE_EXCESSIVE, 'Raw paths: %s', print_r( $paths_array, true ) );
		
		$slugs = array();
		$paths = array();
		foreach( $paths_array as $slug => $fake_paths ){
			$real_paths = $this->realize_paths( $fake_paths );
			if( !empty( $real_paths ) ){
				$slugs[] = $slug;
				$paths = array_merge( $paths, $real_paths );
			} // endif !empty( $real_paths )
		} // foreach $slug => $fake_paths
		$paths = MZ_Arrays::ordered_unique_strings( $paths );
		
		$this->slugs = $slugs;
		$this->paths = $paths;
		return !empty( $paths );
	} // method MZ_Cacher::prepare_query0
	
	private function realize_path0( $path ){
		$abs = MZ_Files::resolve_path( $path, $this->get_source_dir() );
		if( ( $abs !== false ) && is_file( $abs ) )
			return $abs;
		MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_WARN, 'Rejected source path: %s', $path );
		return false;
	} // method MZ_Cacher::realize_path0
	
} // class MZ_Cacher

MZ_Assure::library_only( __FILE__ );
