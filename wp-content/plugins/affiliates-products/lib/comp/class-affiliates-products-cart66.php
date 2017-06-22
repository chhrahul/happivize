<?php
/**
 * class-affiliates-products-cart66.php
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
 * Cart66 component.
 */
class Affiliates_Products_Cart66 extends Affiliates_Products_Base {

	private static $name   = 'Cart66';
	private static $system = 'cart66';

	/**
	 * Admin setup.
	 */
	public static function init() {
		$active_plugins = get_option( 'active_plugins', array() );
		if ( is_multisite() ) {
			$active_sitewide_plugins = get_site_option( 'active_sitewide_plugins', array() );
			$active_sitewide_plugins = array_keys( $active_sitewide_plugins );
			$active_plugins = array_merge( $active_plugins, $active_sitewide_plugins );
		}
		$cart66_is_active = in_array( 'cart66/cart66.php', $active_plugins ) || in_array( 'cart66-lite/cart66.php', $active_plugins );
		if ( $cart66_is_active ) {
			Affiliates_Products_Components::register_component( self::$system, self::$name, __CLASS__, __FILE__ );
			add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ), 20 );
			self::$instance = new Affiliates_Products_Cart66();
			add_action ( 'cart66_after_order_saved', array( __CLASS__, 'cart66_after_order_saved' ) );
		}
	}

	/**
	 * Adds the admin section.
	 */
	public static function admin_menu() {

		$page = add_submenu_page(
			'affiliates-products',
			__( 'Cart66' ),
			__( 'Cart66' ),
			AFFILIATES_ADMINISTER_OPTIONS,
			'affiliates-products-cart66',
			array( __CLASS__, 'affiliates_products' )
		);
		add_action( 'admin_print_styles-' . $page, 'affiliates_admin_print_styles' );
		add_action( 'admin_print_scripts-' . $page, 'affiliates_admin_print_scripts' );
		add_action( 'admin_print_scripts-' . $page, array( 'Affiliates_Products_Admin', 'admin_print_scripts' ) );
		add_action( 'admin_print_styles-' . $page, array( 'Affiliates_Products_Admin', 'admin_print_styles' ) );
	}

	public function get_system() {
		return self::$system;
	}

	public function get_name() {
		return self::$name;
	}

	public function get_products( $args = array() ) {

		global $wpdb;

		$options = get_option( 'affiliates_products', null );
		$product_options = isset( $options[self::$instance->get_system()] ) ? $options[self::$instance->get_system()] : array();

		$products = array();
		$products_table = Cart66Common::getTableName( 'products' );

		$filters = array( " 1 = %d " );
		$filter_params = array( 1 );
		if ( isset( $args['filters'] ) ) {
			extract( $args['filters'] );
			if ( isset( $affiliate_id ) ) {
				$filter_product_ids = array();
				foreach( $product_options as $id => $values ) {
					if ( isset( $values['affiliate_id'] ) && ( $values['affiliate_id'] == $affiliate_id ) ) {
						$filter_product_ids[] = intval( $id );
					}
				}
				if ( count( $filter_product_ids ) == 0 ) {
					$filter_product_ids[] = 'NULL';
				}
				$filters[] = sprintf( " $products_table.id IN ( %s ) ", implode( ',', $filter_product_ids ) );
			}
			if ( isset( $affiliate_name ) ) {
				$filter_product_ids = array();
				foreach( $product_options as $id => $values ) {
					if ( isset( $values['affiliate_id'] ) ) {
						if ( $affiliate = affiliates_get_affiliate( $values['affiliate_id'] ) ) {
							if ( stripos( $affiliate['name'], $affiliate_name ) !== false ) {
								$filter_product_ids[] = intval( $id );
							}
						}
					}
				}
				if ( count( $filter_product_ids ) == 0 ) {
					$filter_product_ids[] = 'NULL';
				}
				$filters[] = sprintf( " $products_table.id IN ( %s ) ", implode( ',', $filter_product_ids ) );
			}
// 			if ( $affiliate_user_login ) {
// 				$filters[] = " $wpdb->users.user_login LIKE '%%%s%%' ";
// 				$filter_params[] = $affiliate_user_login;
// 			}
			if ( !empty( $product_id ) ) {
				$filters[] = " $products_table.id = %d ";
				$filter_params[] = intval( $product_id );
			}
			if ( !empty( $product_name ) ) {
				$filters[] = " $products_table.name LIKE '%%%s%%' ";
				$filter_params[] = $product_name;
			}
		}
		if ( !empty( $filters ) ) {
			$filters = " WHERE " . implode( " AND ", $filters );
		} else {
			$filters = '';
		}

		$orderby = '';
		if ( isset( $args['display'] ) ) {
			extract( $args['display'] );
			if ( isset( $orderby ) ) {
				switch( $orderby ) {
					case 'id' :
					case 'name' :
						$orderby = "ORDER BY $products_table.$orderby";
						break;
					case 'affiliate_id' :
						break;
					default :
						$orderby = '';
				}
				if ( isset( $order ) ) {
					$orderby .= " $order";
				}
			}
		}

		if ( isset( $row_count ) && isset( $offset ) ) {
			$s = "SELECT * FROM $products_table $filters $orderby LIMIT $row_count OFFSET $offset";
		} else {
			$s = "SELECT * FROM $products_table $filters $orderby";
		}

		$q = $wpdb->prepare( $s, $filter_params );
		$rows = $wpdb->get_results( $q );

		foreach ( $rows as $row ) {
			$product = new Cart66Product( $row->id );
			$affiliate_id = null;
			$rate = null;
			if ( isset( $product_options[$row->id] ) ) {
				if ( isset( $product_options[$row->id]['affiliate_id'] ) ) {
					$affiliate_id = $product_options[$row->id]['affiliate_id'];
				}
				if ( isset( $product_options[$row->id]['rate'] ) ) {
					$rate = $product_options[$row->id]['rate'];
				}
			}

			// note that if we were to exclude subscriptions we have to adjust the row_count
			// and offset stuff above
// 			if ( !$product->isSubscription() ) {
				$products[] = array(
					'id'           => $row->id,
					'name'         => $row->name,
					'affiliate_id' => $affiliate_id,
					'rate'         => $rate
				);
// 			}
		}

		return $products;
	}

	/**
	 * Record a product referral when a new order has been saved.
	 * @param array $orderinfo
	 */
	public static function cart66_after_order_saved( $orderinfo ) {

		$order_id = isset( $orderinfo['id'] ) ? $orderinfo['id'] : null;
		if ( $order_id === null ) {
			return;
		}

		$trans_id = isset( $orderinfo['trans_id'] ) ? $orderinfo['trans_id'] : null;

		$order_subtotal  = isset( $orderinfo['subtotal'] ) ? $orderinfo['subtotal'] : "0";
		$discount_amount = isset( $orderinfo['discount_amount'] ) ? $orderinfo['discount_amount'] : "0";
		$order_subtotal = bcsub( $order_subtotal, $discount_amount );
		if ( bccomp( $order_subtotal, "0" ) < 0 ) {
			$order_subtotal = "0";
		}
		$coupon_products = array();
		$product_coupon = null;
		$coupon = isset( $orderinfo['coupon'] ) ? $orderinfo['coupon'] : null;
		if ( $coupon == 'none' ) {
			$coupon = null;
		}
		if ( $coupon !== null ) {
			for ( $i = 0; $product_coupon === null && $i <= strlen( $coupon ); $i++ ) {
				$p = new Cart66Promotion();
				if ( $p->codeExists( substr( $coupon, 0, $i ) ) ) {
					if ( $p->loadByCode( substr( $coupon, 0, $i ) ) ) {
						$coupon_products = explode( ',', $p->products );
						$product_coupon = $p;
					}
				}
			}
		}

		// see also Cart66::initCurrencySymbols()
		if ( defined( 'CURRENCY_CODE' ) ) {
			$currency = CURRENCY_CODE;
		} else {
			$currency = Cart66Setting::getValue( 'currency_code' );
		}
		if ( empty( $currency ) ) {
			$currency = 'USD';
		}

		$order_link = '<a href="' . admin_url( 'admin.php?page=cart66_admin&task=view&id='. $order_id ) . '">';
		$order_link .= sprintf( __( 'Order ID %s', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ), $order_id, $trans_id );
		$order_link .= "</a>";

		$options = get_option( 'affiliates_products', null );
		$product_options = isset( $options[self::$instance->get_system()] ) ? $options[self::$instance->get_system()] : array();

		$order = new Cart66Order( $order_id );
		$items = $order->getItems();
		foreach( $items as $item ) {
			// get the product id
			$product_id = $item->product_id;
			// check if it's assigned to an affiliate
			if ( isset( $product_options[$product_id] ) ) {
				if ( isset( $product_options[$product_id]['affiliate_id'] ) ) {
					$affiliate_id = $product_options[$product_id]['affiliate_id'];
					$rate = isset( $product_options[$product_id]['rate'] ) ? $product_options[$product_id]['rate'] : null;
					if ( $rate && affiliates_check_affiliate_id( $affiliate_id ) ) {
						// get the quantity and calculate the product subtotal
						$product_price = $item->product_price;
						$quantity = $item->quantity;
						$product_subtotal = bcmul( $product_price, $quantity, AFFILIATES_REFERRAL_AMOUNT_DECIMALS );
						// deduct product discount if applicable
						if ( in_array( $item->product_id, $coupon_products ) ) {
							$product_subtotal = bcsub( $product_subtotal, $discount_amount );
							if ( bccomp( $product_subtotal, '0', AFFILIATES_REFERRAL_AMOUNT_DECIMALS ) < 0 ) {
								$product_subtotal = '0';
							}
						}
						$commission = bcmul( $product_subtotal, $rate, AFFILIATES_REFERRAL_AMOUNT_DECIMALS );
						$product_description = $item->description;
						// store a referral
						$data = array(
								'order_id' => array(
										'title' => 'Order ID',
										'domain' => AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
										'value' => esc_sql( $order_id )
								),
								'trans_id' => array(
										'title' => 'Order #',
										'domain' => AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
										'value' => esc_sql( $trans_id )
								),
								'order_total' => array(
										'title' => 'Total',
										'domain' =>  AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
										'value' => esc_sql( $order_subtotal )
								),
								'order_currency' => array(
										'title' => 'Currency',
										'domain' =>  AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
										'value' => esc_sql( $currency )
								),
								'order_link' => array(
										'title' => 'Order',
										'domain' =>  AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
										'value' => esc_sql( $order_link )
								),
								'product_id' => array(
										'title' => 'Product ID',
										'domain' => AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
										'value' => esc_sql( $product_id )
								),
								'product_description' => array(
										'title' => 'Product Description',
										'domain' =>  AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
										'value' => esc_sql( $product_description )
								),
								'product_price' => array(
										'title' => 'Product Price',
										'domain' =>  AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
										'value' => esc_sql( $product_price )
								),
								'product_quantity' => array(
										'title' => 'Product Quantity',
										'domain' =>  AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
										'value' => esc_sql( $quantity )
								),
								'product_subtotal' => array(
										'title' => 'Product Subtotal',
										'domain' =>  AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
										'value' => esc_sql( $product_subtotal )
								),
// 								'product_link' => array(
// 										'title'  => 'Product',
// 										'domain' => AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
// 										'value'  => esc_sql( $product_link )
// 								)
						);

						$post_id = get_the_ID();
						$description = sprintf( '%s (Order ID %s, # %s, Product ID %s)', $product_description, $order_id, $trans_id, $product_id );
						if ( class_exists( 'Affiliates_Referral_WordPress')) {
							$r = new Affiliates_Referral_WordPress();
							$r->add_referrals( array( $affiliate_id ), $post_id, $description, $data, $product_subtotal, $commission, $currency, null, 'product', $order_id );
						} else {
							self::add_referral( $affiliate_id, $post_id, $description, $data, $commission, $currency );
						}

					}
				}
			}
		}

		// trigger action for status update if the integration is available
		if ( class_exists( 'Affiliates_Cart66_Integration' ) ) {
			Affiliates_Cart66_Integration::cart66_order_updated( $order_id );
		}
	}

}
Affiliates_Products_Cart66::init();
