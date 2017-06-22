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
 * Extension of MZ_Cacher2 intended for handling scripts
 */

class MZ_Cacher2_Scripts extends MZ_Cacher2{
	private /* array( string:file-path ) */ $files = array();
	private /* string|false */ $data = '';
	
	public function __construct( array $args ){
		if( !isset( $args[ 'extensions' ] ) ){
			$args[ 'extensions' ] = array(
				'js',
			);
		} // endif !isset( $args[ 'extensions' ] )
		
		if( !isset( $args[ 'contentTypedFormat' ] ) )
			$args[ 'contentTypeFormat' ] = 'application/javascript; charset=%s';
		
		if( !isset( $args[ 'exclusiveImports' ] ) )
			$args[ 'exclusiveImports' ] = true;
		
		parent::__construct( $args );
	} // method MZ_Cacher2_Scripts::__construct
	
	protected function beginRebuild(){
		require_once dirname( __FILE__ ) . '/../jshrink/Minifier.php';
		$this->data = '';
	} // method MZ_Cacher2_Scripts::beginRebuild
	
	protected function addToRebuild( $filePath, $urlPath ){
		if( false === $this->data )
			return;
		
		$data = @file_get_contents( $filePath );
		if( false === $data ){
			MZ_Debug::log_if( '[%s] Could not open file: %s', __METHOD__, $filePath );
			$this->data = false;
			return;
		} // endif false === $data
		
		$this->files[] = $filePath;
		$this->data .= $data;
	} // method MZ_Cacher2_Scripts::addToRebuild
	
	protected function finishRebuild(){
		$data = $this->data;
		if( false === $data )
			return false;
		
		return array(
			$data,
			$this->files,
		);
	} // method MZ_Cacher2_Scripts::finishRebuild
} // class MZ_Cacher2_Scripts
