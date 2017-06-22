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
 * Implements an [image] shortcode
 *
 * <p>Shortcode format: [image id="" class="" title="" align="" size="" alt="" link="" style="" /]</p>
 *	<p>Where:</p>
 * <dl>
 * <dt>id</dt>
 * <dd>The post ID for the image attachment</dd>
 *
 * <dt>class</dt>
 * <dd>A list of classes to be added to the resulting image</dd>
 *
 * <dt>title</dt>
 * <dt>alt</dt>
 * <dd>Sets the corresponding attribute for the resulting image.  Defaults to the attachment's corresponding attribute if left blank</dd>
 *
 * <dt>align</dt>
 * <dd>
 * <p>One of:</p>
 * <ul>
 * <li>none</li>
 * <li>left</li>
 * <li>center</li>
 * <li>right</li>
 * </ul>
 * <p>The effect of each will depend on the underlying template's stylesheet</p>
 * </dd>
 *
 * <dt>size</dt>
 * <dd>Affects the sizing class present on the image.  Expects a named Wordpress image size</dd>
 *
 * <dt>link</dt>
 * <dd>If given, wraps the resulting image in an anchor (&lt;a&gt;), pointing to the given url</dd>
 *
 * <dt>style</dt>
 * <dd>Sets the resulting image's style attribute</dd>
 * <dl>
 * <p>Additionally, if any data-* attributes are given (a la, html5-style), they are copied to the resulting image verbatum.</p>
 *
 * <p>Finally, also registers an <tt>image_send_to_editor</tt> to override the insertion of images.</p>
 */
class DNC_Shortcode_Image extends DNC_Shortcode{
	const CANONICAL_NAME = 'image';
	const LOG_CATEGORY = 'dnc-shortcode-image';
	
	public function __construct(){
		add_filter( 'image_send_to_editor', array( $this, 'filterImageSendToEditor' ), 9999, 8 );
	} // method DNC_Shortcode_Image::__construct
	
	/**
	 * Perform our shortcode
	 *
	 * @param string|array $atts
	 * @param string $content
	 * @param string $name
	 * @return string
	 */
	public function hook( $atts, $content = '', $name = '' ){
		static $fAlignments = array(
			'none',
			'left',
			'right',
			'center',
		);
		
		static $fAtts = array(
			'id' => '',
			'class' => '',
			'title' => '',
			'align' => '',
			'size' => '',
			'alt' => '',
			'link' => '',
			'style' => '',
		);
		
		$atts = shortcode_atts( $fAtts, $atts, $name );
		
		// Fetch the id
		$id = absint( $atts[ 'id' ] );
		
		if( 0 === $id )
			return '';
		
		// Get the attachment's url (if it isn't an attachment, abort)
		$src = wp_get_attachment_url( $id );
		
		if( !is_string( $src ) )
			return '';
		
		// Prepare the alignment
		$align = MZ_Strings::mb_trim( $atts[ 'align' ] );
		
		if( !in_array( $align, $fAlignments ) )
			$align = reset( $fAlignments );
		
		// Prepare the size
		$size = MZ_Strings::mb_trim( $atts[ 'size' ] );
		
		if( '' === $size )
			$size = 'full';
		
		// Prepare the class attribute
		$class = sprintf( 'aligncenter align%1$s-sm size-%2$s wp-image-%3$s', esc_attr( $align ), esc_attr( $size ), $id );
		$class = apply_filters( 'get_image_tag_class', $class, $id, $align, $size );
		$class .= ' ' . $atts[ 'class' ];
		// Break out class string into array, trim & filter the entries, filter out any non-unique entries, implode to string
		$class = implode( ' ', array_keys( array_fill_keys( array_filter( array_map( 'MZ_Strings::mb_trim', explode( ' ', $class ) ) ), true ) ) );
		
		// Fetching/synthesizing alt attribute
		$alt = MZ_Strings::mb_trim( $atts[ 'alt' ] );
		
		if( '' === $alt )
			$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
		
		// Begin the output string
		$ret = sprintf( '<img src="%s" alt="%s" class="%s"', esc_attr( $src ), esc_attr( $alt ), esc_attr( $class ) );
		
		// Fetch/synthesize the title attribute
		$title = MZ_Strings::mb_trim( $atts[ 'title' ] );
		
		if( '' === $title )
			$title = MZ_Strings::mb_trim( get_the_excerpt( $id ) );
		
		if( '' !== $title )
			$ret .= sprintf( ' title="%s"', esc_attr( $title ) );
		
		$style = MZ_Strings::mb_trim( $atts[ 'style' ] );
		
		if( '' !== $style )
			$ret .= sprintf( ' style="%s"', esc_attr( $style ) );
		
		$prefixPattern = '^data[-_]';
		$prefixLength = 5;
		
		// Process any data attributes
		foreach( $atts as $key => $value ){
			if( !mb_ereg_match( $prefixPattern, $key, 'pr' ) )
				continue;
			
			$ret .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $value ) );
		}
		
		return $ret . ' />';
	} // method DNC_Shortcode_Image::hook
	
	/**
	 * Overrides the html that the media tool would otherwise add, so that we're inserting our shortcode
	 *
	 * @param string $html
	 * @param int $id
	 * @param string $caption
	 * @param string $title
	 * @param string $align
	 * @param string $url
	 * @param string $size
	 * @param string $alt
	 * @return string
	 */
	/* protected */ function filterImageSendToEditor( $html, $id, $caption, $title, $align, $url, $size, $alt ){
		$id = absint( $id );
		
		if( 0 === $id )
			return $html;
		
		$ret = sprintf( '[image id="%s"', $id );
		
		foreach( array(
			'caption',
			'title',
			'align',
			'size',
			'alt',
		) as $attribute ){
			$tmp = esc_attr( MZ_Strings::mb_trim( $$attribute ) );
			
			if( '' === $tmp )
				continue;
			
			$ret .= sprintf( ' %s="%s"', $attribute, $tmp );
		} // foreach $attribute
		
		return $ret . ' /]';
	} // method DNC_Shortcode_Image::filterImageSendToEditor
} // class DNC_Shortcode_Image
