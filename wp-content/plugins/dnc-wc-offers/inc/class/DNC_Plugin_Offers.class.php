<?php
/*
Copyright (c) 2017 Designs and Codes

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
 * Plugin file
 */
class DNC_Plugin_Offers extends DNC_Plugin {
	protected function __construct( $pluginFilePath ){
		parent::__construct( $pluginFilePath );
	} // method DNC_Plugin_Offers::__construct
	
	/**
	 * Initializes our plugin
	 *
	 * @return void
	 */
	public function actionInit(){
		// Register our CPTs
		foreach( array(
			'DNC_PostType_Offer',
		) as $class )
			call_user_func( array( $class, 'initialize' ) );
		
		add_filter( 'locate_template', array( $this, 'filterLocateTemplate' ) );
		add_filter( 'the_content', array( $this, 'filterTheContent' ), 10 );
		
		/*
		 * Load our shortcodes
		 */
		foreach( array(
			__DIR__,
			( __DIR__ . '/../wp-class' ),
		) as $dir ){
			foreach( (array)@scandir( $dir ) as $file ){
				$regs = array();
				
				if( mb_ereg( '^(DNC_Shortcode_.+)\.class\.php$', $file, $regs ) )
					call_user_func( sprintf( '%s::register', $regs[ 1 ] ) );
			} // foreach $file
		} // foreach $dir
	} // method DNC_Plugin_Offers::actionInit
	
	/**
	 * Filters the content for posts of our type
	 *
	 * @param string $content
	 * @return string
	 */
	/* protected */ function filterTheContent( $content ){
		static $fDisallowedTags = '(?:address|article|aside|blockquote|canvas|dd|div|[dou]l|fieldset|figcaption|figure|footer|form|h[1-6]|header|hgroup|hr|li|main|nav|noscript|output|p|pre|section|table|tfoot|video)';
		
		if( !in_the_loop() || ( DNC_PostType_Offer::POST_TYPE !== get_post_type() ) )
			return $content;
		
		return MZ_Strings::mb_str_replace( array(
			'<p>[',
			']</p>',
			']<br />',
		), array(
			'[',
			']',
			']',
		), $content );
	} // method DNC_Plugin_Offers::filterTheContent
} // class DNC_Plugin_Offers
