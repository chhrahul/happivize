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
* The template for displaying the header
* Displays all of the head element and everything up until the opening of #dnc-wc-offers-site-main.
* @package DesignsAndCodes
* @subpackage DesignsAndCodes_WC_Offers
* @since dnc-wc-offers 1.0
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
<?php
	if( is_singular() && pings_open( get_queried_object() ) ){
?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	} // endif is_singular() && pings_open( get_queried_object() )
	
	wp_head(); 
?>
</head>
<body <?php body_class(); ?>>
	<main id="dnc-wc-offers-site-main" class="dnc-wc-offers-site-main">
