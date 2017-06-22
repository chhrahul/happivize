<?php
/**
 *
 * @package   WPBruiser
 * @author    Mihai Chelaru
 * @link      http://www.wpbruiser.com
 * @copyright 2015 Mihai Chelaru
 *
 * @wordpress-plugin
 * Plugin Name: WPBruiser - WooCommerce
 * Plugin URI: http://www.wpbruiser.com
 * Description: WPBruiser - WooCommerce extension.
 * Version: 3.1.1
 * Author: Mihai Chelaru
 * Author URI: http://www.wpbruiser.com
 * Text Domain: goodbye-captcha
 * License: GPL-2.0+
 * Domain Path: /languages
 */
final class WPBruiserWooCommerce
{
	CONST MODULE_VERSION    = '3.1.1';
	protected function __construct()
	{}

	public static function getInstance()
	{
		static $instance = null;
		return (null !== $instance) ? $instance : $instance = new self();
	}
}

add_action('plugins_loaded', array( 'WPBruiserWooCommerce', 'getInstance' ), 20);
