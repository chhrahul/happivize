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
 * The template for displaying the footer
 *
 * Contains the closing of #dnc-wc-offers-site-main, the site footer and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 
 $copyrightBegins = 2016;
 $copyrightNow = (int)date( 'Y' );
 $copyrightRange = ( $copyrightBegins === $copyrightNow ) ? $copyrightBegins : sprintf( '%s&ndash;%s', min( $copyrightBegins, $copyrightNow ), max( $copyrightBegins, $copyrightNow ) );
?>
	</main> <!-- #dnc-wc-offers-site-main -->
	
	<footer id="dnc-wc-offers-site-footer" class="dnc-wc-offers-site-footer" role="contentarea">
		<p class="dnc-wc-offers-site-footer-copyright">&copy;<?php echo $copyrightRange; ?> Happivize.  All rights reserved.</p>
	</footer> <!-- #dnc-wc-offers-site-footer -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
	<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>	  
<?php
	wp_footer();
?>
	<script type="text/javascript">
		var _learnq = _learnq || [];

		_learnq.push(['account', 'wgViqM']);

		(function () {
		var b = document.createElement('script'); b.type = 'text/javascript'; b.async = true;
		b.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'a.klaviyo.com/media/js/analytics/analytics.js';
		var a = document.getElementsByTagName('script')[0]; a.parentNode.insertBefore(b, a);
		})();
	</script>
</body>
</html>
