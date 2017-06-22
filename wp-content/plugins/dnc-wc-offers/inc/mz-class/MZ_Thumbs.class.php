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
 * Thumbnail generator library
 */

class MZ_Thumbs {
	
	private function __construct(){}
	
	/**
	 * Parses a string in one of the following formats ('x' is case-insensitive):
	 * <ul>
	 * <li><code><var>integer</var></code> => specifies both thumbnail width and height
	 * <li><code><var>integer</var>x</code> => specifies the thumbnail width (height is null)
	 * <li><code>x<var>integer</var></code> => specifies the thumbnail height (width is null)
	 * <li><code><var>integer</var>x<var>integer</var></code> => specified both thumbnail height and width
	 * @param $raw_size the raw text to be parsed
	 * @returns array( int?, int? ) an array containing the width and height parsed
	 */
	static function parse_size( $raw_size ){
		$index = stripos( strval( $raw_size ), 'x' );
		if( false !== $index ){
			$width = self::parse_size_component( mb_substr( $raw_size, 0, $index ) );
			$height = self::parse_size_component( mb_substr( $raw_size, $index + 1 ) );
		}else // no 'x' means it's a square
			$width = $height = self::parse_size_component( $raw_size );
		return array(
			$width,
			$height,
			'width' => $width,
			'height' => $height,
		);
	} // method MZ_Thumbs::parse_size
	
	/**
	 * Accepts a string of digits, returning a positive number if found or null if the prereq is not met
	 * @param $size the text to be parsed
	 * @returns int? a positive integer containing the number parsed (or null)
	 */
	static function parse_size_component( $size ){
		if( empty( $size ) || !ctype_digit( $size ) )
			return null;
		$size = intval( $size, 10 );
		return ( $size > 0 ) ? $size : null;
	} // method MZ_Thumbs::parse_size_component
	
	private static function sterilize_desired_size0( $thumb_size, $image_width, $image_height ){
		if( !is_array( $thumb_size ) )
			$thumb_size = self::parse_size( $thumb_size );
		foreach( array(
			'thumb_width',
			'thumb_height',
		) as $index => $var ){
			$tmp = MZ_Arrays::isget( $index, $thumb_size, null );
			$$var = ( is_int( $tmp ) && ( $tmp > 0 ) ) ? $tmp : null;
		} // foreach $index => $var
		if( null === $thumb_width ){
			if( null === $thumb_height )
				return array( $image_width, $image_height );
			$thumb_width = intval( $image_width * ( $thumb_height / floatval( $image_height ) ) );
		}else if( null === $thumb_height )
			$thumb_height = intval( $image_height * ( $thumb_width / floatval( $image_width ) ) );
		return array( $thumb_width, $thumb_height );
	} // method MZ_Thumbs::sterilize_desired_size0
	
	private static function create_thumbnail0( $image_path, $image_width, $image_height, $thumb_path, $thumb_width, $thumb_height, $image_format ){
		$load = 'imagecreatefrom' . $image_format;
		$save = 'image' . $image_format;
		if( !( function_exists( $load ) && function_exists( $save ) ) ){
			MZ_Debug::log( '[%s] Cannot handle image type: %s (%s)', __CLASS__, $image_format, $image_path );
			return false;
		} // endif !( function_exists( $load ) && function_exists( $save ) )
		
		$image = @call_user_func( $load, $image_path );
		if( !is_resource( $image ) ){
			MZ_Debug::log( '[%s] Cannot load image file: %s', __CLASS__, $image_path );
			return false;
		} // endif !is_resource( $image )
		
		$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
		if( !is_resource( $thumb ) ){
			imagedestroy( $image ); // best-effort
			MZ_Debug::log( '[%s] Unable to create memory image: %s', __CLASS__, $image_path );
			return false;
		} // endif !is_resource( $thumb )
		
		foreach( array(
			'width',
			'height',
		) as $var )
			${ 'mult_' . $var } = ${ 'image_' . $var } / floatval( ${ 'thumb_' . $var } );
		if( $mult_width < $mult_height )
			$image_height = $thumb_height * $mult_width;
		else
			$image_width = $thumb_width * $mult_height;
		unset( $mult_width, $mult_height );
		
		if( !imagecopyresampled( $thumb, $image, 0, 0, 0, 0, $thumb_width, $thumb_height, $image_width, $image_height ) ){
			imagedestroy( $image ); // best-effort
			imagedestroy( $thumb ); // best-effort
			MZ_Debug::log( '[%s] Unable to resample image: %s', __CLASS__, $image_path );
			return false;
		} // endif !imagecopyresampled( $thumb, $image, 0, 0, 0, 0, $thumb_width, $thumb_height, $image_width, $image_height )
		
		imagedestroy( $image ); // best-effort
		$ret = @call_user_func( $save, $thumb, $thumb_path );
		imagedestroy( $thumb ); // best-effort
		if( false === $ret )
			MZ_Errors::log( '[%s] Cannot save image file: %s (%s)', __CLASS__, $thumb_path, $image_path );
		return $ret;
	} // method MZ_Thumbs::create_thumbnail0
	
	/**
	 * Takes an absolute file-path and a size and returns a file-path to the resulting thumbnail file if able.  If the thumbnail would be full-size, returns the given file-path
	 * @param $image_path absolute file-path to the image to fetch/create thumbnail for
	 * @param $thumb_size either a string of the format accepted by {@link MZ_Thumbs::parse_size} or an array of the format returned by it
	 * @returns string: array( string:file-path, int:width, int:height, string:mime-type ) | false
	 */
	static function fetch_thumbnail( $image_path, $thumb_size, $allow_stale = false ){
		if( !MZ_Files::is_absolute_path( $image_path ) ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_DEBUG, '[%s] Not an absolute path: %s', __CLASS__, $image_path );
			return false;
		} // endif !MZ_Files::is_absolute_path( $image_path )
		
		$image_info = @getimagesize( $image_path );
		if( false === $image_info ){ // getimagesize does in fact return false on failure
			MZ_Debug::log_if( MZ_Debug::LEVEL_DEBUG, '[%s] File not readable or not an image: %s', __CLASS__, $image_path );
			return false;
		} // endif false === $image_type
		list( $image_width, $image_height, $image_type ) = $image_info;
		unset( $image_info );
		
		list( $thumb_width, $thumb_height ) = self::sterilize_desired_size0( $thumb_size, $image_width, $image_height );
		if( ( $thumb_width === $image_width ) && ( $thumb_height === $image_height ) ){ // If the desired size is empty, don't bother checking for a thumb
			return array(
				'path' => $image_path,
				'width' => $image_width,
				'height' => $image_height,
				'mime' => image_type_to_mime_type( $image_type ),
			);
		} // endif ( $thumb_width === $image_width ) && ( $thumb_height === $image_height )
		
		$thumb_dir = dirname( $image_path ) . '/thumbs/';
		@mkdir( $thumb_dir, 0755, true ); // best-effort
		$thumb_path = $thumb_dir . $thumb_width . 'x' . $thumb_height . 'x' . basename( $image_path );
		$thumb_time = MZ_Files::mtime( $thumb_path );
		
		if( MZ_Files::mtime( $image_path ) >= $thumb_time ){ // Is there a thumb for this size? Is it more recent than the source?
			// (Re)build the thumbnail
			
			if( !self::create_thumbnail0( $image_path, $image_width, $image_height, $thumb_path, $thumb_width, $thumb_height, image_type_to_extension( $image_type, false ) ) ){
				if( !$allow_stale || ( false === $thumb_time ) )
					return false;
				MZ_Debug::log( '[%s] Could not refresh thumb, using stale version: %s (%s)', $thumb_path, $image_path );
			} // endif !self::create_thumbnail0( $image_path, $image_width, $image_height, $thumb_path, $thumb_width, $thumb_height, image_type_to_extension( $image_type, false ) )
		} // endif MZ_Files::mtime( $image_path ) >= $thumb_time
		return array(
			'path' => $thumb_path,
			'width' => $thumb_width,
			'height' => $thumb_height,
			'mime' => image_type_to_mime_type( $image_type ),
		);
	} // method MZ_Thumbs::fetch_thumbnail
	
} // class MZ_Thumbs

MZ_Assure::library_only( __FILE__ );
