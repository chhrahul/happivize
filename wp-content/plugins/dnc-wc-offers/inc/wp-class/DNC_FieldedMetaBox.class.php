<?php
/*
Copyright (c) 2016 Designs and Codes

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
 * Metabox implementation for when metabox is a list of Metabox Fields
 */
class DNC_FieldedMetaBox extends DNC_MetaBox{
	private /* array( string => DNC_MetaBoxField ) */ $fields;
	
	public function __construct( array $properties, array $fields ){
		parent::__construct( $properties );
		
		// Setup fields
		$thisFields = array();
		foreach( $fields as $fieldName => $fieldInfo ){
			if( !( $fieldInfo instanceof DNC_MetaBoxField ) ){
				if( is_string( $fieldName ) && !empty( $fieldName ) && !isset( $fieldInfo[ 'name' ] ) )
					$fieldInfo[ 'name' ] = $fieldName;
				
				$fieldInfo = new DNC_MetaBoxField( $fieldInfo );
			} // endif !( $fieldInfo instanceof DNC_MetaBoxField )
			
			$fieldName = $fieldInfo->name;
			if( isset( $thisFields[ $fieldName ] ) )
				throw new InvalidArgumentException( sprintf( '[%s] Duplicate field name: %s', __CLASS__, $fieldName ) );
			
			$thisFields[ $fieldName ] = $fieldInfo;
		} // foreach $fieldName => $fieldInfo
		$this->fields = $thisFields;
	} // method DNC_FieldedMetaBox::__construct
	
	public function __get( $name ){
		if( isset( $this->$name ) )
			return $this->$name;
		
		return parent::__get( $name );
	} // method DNC_FieldedMetaBox::__get
	
	public function actionEchoMetaBox( WP_Post $post ){
		if( !parent::actionEchoMetaBox( $post ) )
			return false;
		
		$fieldPrefix = $this->getFieldPrefix();
		
		foreach( $this->fields as $name => $field )
			$field->emit0( $post->ID, ( $fieldPrefix . $name ), true );
		
		return true;
	} // method DNC_FieldedMetaBox::actionEchoMetaBox
	
	public function actionSavePostType( $postID ){
		if( !parent::actionSavePostType( $postID ) )
			return false;
		
		$fieldPrefix = $this->getFieldPrefix();
		foreach( $this->fields as $name => $field )
			$field->save0( $postID, ( $fieldPrefix . $name ) );
		
		return true;
	} // method DNC_FieldedMetaBox::actionSavePostType
} // class DNC_FieldedMetaBox
