<?php
/**
 * i-affiliates-products-component.php
 *
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 *
 * This code is provided subject to the license granted.
 * Unauthorized use and distribution is prohibited.
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * This header and all notices must be kept intact.
 *
 * @author Karim Rahimpur
 * @package affiliates-products
 * @since affiliates-products 1.0.0
 */

/**
 * Common component interface.
 */
interface I_Affiliates_Products_Component {
	public function get_products( $args = array() );
	public function get_name();
	public function get_system();
}
