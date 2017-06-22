<?php
/**
 * affiliates-gravityforms.php
 *
 * Copyright (c) 2014 - 2016 www.itthinx.com
 * 
 * =============================================================================
 * 
 *                             LICENSE RESTRICTIONS
 * 
 *           This plugin is provided subject to the license granted.
 *              Unauthorized use and distribution is prohibited.
 *                     See COPYRIGHT.txt and LICENSE.txt.
 * 
 * Files licensed under the GNU General Public License state so explicitly in
 * their header or where implied. Other files are not licensed under the GPL
 * and the license obtained applies.
 * 
 * =============================================================================
 * 
 * You MUST be granted a license by the copyright holder for those parts that
 * are not provided under the GPLv3 license.
 * 
 * If you have not been granted a license DO NOT USE this plugin until you have
 * BEEN GRANTED A LICENSE.
 * 
 * Use of this plugin without a granted license constitutes an act of COPYRIGHT
 * INFRINGEMENT and LICENSE VIOLATION and may result in legal action taken
 * against the offending party.
 * 
 * Being granted a license is GOOD because you will get support and contribute
 * to the development of useful free and premium themes and plugins that you
 * will be able to enjoy.
 * 
 * Thank you!
 * 
 * Visit www.itthinx.com for more information.
 * 
 * =============================================================================
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * This header and all notices must be kept intact.
 *
 * @author itthinx
 * @package affiliates-gravityforms
 * @since 1.0.0
 *
 * Plugin Name: Affiliates Gravity Forms Integration
 * Plugin URI: http://www.itthinx.com/plugins/affiliates-gravityforms/
 * Description: Integrates Affiliates, Affiliates Pro and Affiliates Enterprise with Gravity Forms.
 * Author: itthinx
 * Author URI: http://www.itthinx.com/
 * Version: 1.2.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AFF_GF_VERSION', '1.2.4' );
if ( !function_exists( 'itthinx_plugins' ) ) {
	require_once 'itthinx/itthinx.php';
}
itthinx_plugins( __FILE__ );
define( 'AFF_GF_PLUGIN_DOMAIN', 'affiliates-gravityforms' );
define( 'AFF_GF_FILE', __FILE__ );

include_once 'includes/class-affiliates-gravity-forms.php';
