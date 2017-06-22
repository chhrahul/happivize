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
 * Extension of MZ_Cacher2 intended for handling stylesheets
 */

class MZ_Cacher2_Styles extends MZ_Cacher2{
	private /* Less_Parser? */ $parser = null;
	
	public function __construct( array $args ){
		if( !isset( $args[ 'extensions' ] ) ){
			$args[ 'extensions' ] = array(
				'less',
				'css',
			);
		} // endif !isset( $args[ 'extensions' ] )
		
		if( !isset( $args[ 'contentTypedFormat' ] ) )
			$args[ 'contentTypeFormat' ] = 'text/css; charset=%s';
		
		parent::__construct( $args );
	} // method MZ_Cacher2_Styles::__construct
	
	protected function beginRebuild(){
		ini_set( 'memory_limit', '64M' );
		set_time_limit( 60 );
		
		require_once dirname( __FILE__ ) . '/../less.php/Less.php';
		
		$parser = new Less_Parser( $this->getLessOptions0() );
		
		$sources = $this->sources;
		if( $this->exclusiveImports )
			$sources = array_reverse( $sources, true );
		$parser->SetImportDirs( $sources );
		
		$this->parser = $parser;
	} // method MZ_Cacher2_Styles::beginRebuild
	
	protected function addToRebuild( $filePath, $urlPath ){
		$this->parser->parseFile( $filePath, $urlPath );
	} // method MZ_Cacher2_Styles::addToRebuild
	
	protected function finishRebuild(){
		try{
			$parser = $this->parser;
			$css = $parser->getCss();
			$listData = $parser->allParsedFiles();
			
			return array(
				$css,
				$listData,
			);
		}catch( Exception $e ){
			MZ_Debug::log( '[%s] Failed to parse LESS: %s', __CLASS__, $e->getMessage() );
			return false;
		} // catch Exception $e
	} // method MZ_Cacher2_Styles::finishRebuild
	
	private function getLessOptions0(){
		static $ret = null;
		
		if( null === $ret ){
			$ret = array(
				'compress' => !MZ_Debug::is_debug(),
				'relativeUrls' => false,
				'cache_dir' => $this->cacheDirectory,
			);
		} // endif null === $ret
		
		return $ret;
	} // method MZ_Cacher2_Styles::getLessOptions0
} // class MZ_Cacher2_Styles
