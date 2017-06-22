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
 * Handles rendering of a dnc-wc-offer single
 *
 * Instead of loading the template's header & footer, loads header-dnc-wc-offer and footer-dnc-wc-offer
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
	assert( 'DNC_PostType_Offer::getPost() instanceof DNC_Post_Offer' );
	
	add_action( 'wp_enqueue_scripts', array( DNC_PostType_Offer::getInstance(), 'actionEnqueueScripts' ) );
	
	DNC_Template::getTemplatePart( 'header', DNC_PostType_Offer::POST_TYPE );
	
	while( have_posts() ){
		the_post();
		
		DNC_Template::getTemplatePart( 'content', DNC_PostType_Offer::POST_TYPE );
	} // while have_posts()
	
	DNC_Template::getTemplatePart( 'footer', DNC_PostType_Offer::POST_TYPE );
