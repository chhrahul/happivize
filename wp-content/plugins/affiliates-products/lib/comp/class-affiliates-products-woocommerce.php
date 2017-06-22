<?php
/**
 * class-affiliates-products-woocommerce.php
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
 * @since affiliates-products 1.2.0
 */

/**
 * WooCommerce component.
 */
class Affiliates_Products_WooCommerce extends Affiliates_Products_Base {

	private static $name   = 'WooCommerce';
	private static $system = 'woocommerce';

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
		$woo_is_active = in_array( 'woocommerce/woocommerce.php', $active_plugins );
		if ( $woo_is_active ) {
			Affiliates_Products_Components::register_component( self::$system, self::$name, __CLASS__, __FILE__ );
			add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ), 20 );
			self::$instance = new Affiliates_Products_WooCommerce();
			add_action ( 'woocommerce_checkout_order_processed', array( __CLASS__, 'woocommerce_checkout_order_processed' ) );

			$options = get_option( 'affiliates_products', array() );
			$auto_assign_to_author = isset( $options['auto_assign_to_author'] ) ? $options['auto_assign_to_author'] : false;
			$default_rate          = isset( $options['default_rate'] ) ? $options['default_rate'] : 0;

			if ( $auto_assign_to_author || ( bccomp( $default_rate, '0', Affiliates_Products_Base::DECIMALS ) > 0 ) ) { 
				add_action( 'transition_post_status', array( __CLASS__, 'transition_post_status' ), 10, 3 );
			}
		}
	}

	/**
	 * Adds the admin section.
	 */
	public static function admin_menu() {

		$page = add_submenu_page(
			'affiliates-products',
			__( 'WooCommerce' ),
			__( 'WooCommerce' ),
			AFFILIATES_ADMINISTER_OPTIONS,
			'affiliates-products-woocommerce',
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

		$filters = array(
			" 1 = %d ",
			" $wpdb->posts.post_type = 'product' ",
			" $wpdb->posts.post_status IN ('publish','draft') "
		);
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
				$filters[] = sprintf( " $wpdb->posts.ID IN ( %s ) ", implode( ',', $filter_product_ids ) );
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
				$filters[] = sprintf( " $wpdb->posts.ID IN ( %s ) ", implode( ',', $filter_product_ids ) );
			}
// 			if ( $affiliate_user_login ) {
// 				$filters[] = " $wpdb->users.user_login LIKE '%%%s%%' ";
// 				$filter_params[] = $affiliate_user_login;
// 			}
			if ( !empty( $product_id ) ) {
				$filters[] = " $wpdb->posts.ID = %d ";
				$filter_params[] = intval( $product_id );
			}
			if ( !empty( $product_name ) ) {
				$filters[] = " $wpdb->posts.post_title LIKE '%%%s%%' ";
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
						$orderby = "ORDER BY $wpdb->posts.ID";
						break;
					case 'name' :
						$orderby = "ORDER BY $wpdb->posts.post_title";
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
			$s = "SELECT * FROM $wpdb->posts $filters $orderby LIMIT $row_count OFFSET $offset";
		} else {
			$s = "SELECT * FROM $wpdb->posts $filters $orderby";
		}

		$q = $wpdb->prepare( $s, $filter_params );
		$rows = $wpdb->get_results( $q );

		foreach ( $rows as $row ) {
			$affiliate_id = null;
			$rate = null;
			$vendor_id = null;
			$vendor_rate = null;
			$facilitator_id = null;
			$facilitator_rate = null;
			if ( isset( $product_options[$row->ID] ) ) {
				if ( isset( $product_options[$row->ID]['affiliate_id'] ) ) {
					$affiliate_id = $product_options[$row->ID]['affiliate_id'];
				}
				if ( isset( $product_options[$row->ID]['rate'] ) ) {
					$rate = $product_options[$row->ID]['rate'];
				}
				if ( isset( $product_options[$row->ID]['vendor_id'] ) ) {
					$vendor_id = $product_options[$row->ID]['vendor_id'];
				}
				if ( isset( $product_options[$row->ID]['vendor_rate'] ) ) {
					$vendor_rate = $product_options[$row->ID]['vendor_rate'];
				}
				if ( isset( $product_options[$row->ID]['facilitator_id'] ) ) {
					$facilitator_id = $product_options[$row->ID]['facilitator_id'];
				}
				if ( isset( $product_options[$row->ID]['facilitator_rate'] ) ) {
					$facilitator_rate = $product_options[$row->ID]['facilitator_rate'];
				}
			}

			$products[] = array(
				'id'           => $row->ID,
				'name'         => $row->post_title,
				'affiliate_id' => $affiliate_id,
				'rate'         => $rate,
				'vendor_id'    => $vendor_id,
				'vendor_rate'  => $vendor_rate,
				'facilitator_id'  => $facilitator_id,
				'facilitator_rate'  => $facilitator_rate
			);
		}

		return $products;
	}

	/**
	 * Record a product referral when a new order has been saved.
	 * @param int $order_id
	 */
	public static function woocommerce_checkout_order_processed( $order_id ) {

		$order_total        = get_post_meta( $order_id, '_order_total', true );
		$order_tax          = get_post_meta( $order_id, '_order_tax', true );
		$order_shipping     = get_post_meta( $order_id, '_order_shipping', true );
		$order_shipping_tax = get_post_meta( $order_id, '_order_shipping_tax', true );

		$order_subtotal     = $order_total - $order_tax - $order_shipping - $order_shipping_tax;

		$currency           = get_option( 'woocommerce_currency' );

		$order_link = '<a href="' . admin_url( 'post.php?post=' . $order_id . '&action=edit' ) . '">';
		$order_link .= sprintf( __( 'Order #%s', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ), $order_id );
		$order_link .= "</a>";

		$options = get_option( 'affiliates_products', null );
		$product_options = isset( $options[self::$instance->get_system()] ) ? $options[self::$instance->get_system()] : array();

		if ( $order = self::get_order( $order_id ) ) {

			$items = $order->get_items();

			$nets = self::get_net_item_totals( $order_id );

			foreach( $items as $order_item_id => $item ) {

				$product = $order->get_product_from_item( $item );
				// check if it's assigned to an affiliate
				if ( $product->exists() && isset( $product_options[$product->id] ) ) {
					$product_id = $product->id;
					if ( isset( $product_options[$product_id]['affiliate_id'] ) ) {
						$affiliate_id = $product_options[$product_id]['affiliate_id'];
						$rate = isset( $product_options[$product_id]['rate'] ) ? $product_options[$product_id]['rate'] : null;
						if ( $rate && affiliates_check_affiliate_id( $affiliate_id ) ) {

							// get the quantity and calculate the product subtotal
							$product_price    = $order->get_item_total( $item );
							$quantity         = $item['qty'];
							if ( isset( $nets[$order_item_id] ) ) {
								$product_subtotal = $nets[$order_item_id];
							} else {
								$product_subtotal = $order->get_line_total( $item );
							}

							if ( $product_subtotal > 0 ) {
								$commission = bcmul( $product_subtotal, $rate, AFFILIATES_REFERRAL_AMOUNT_DECIMALS );

								$product_description = $product->get_title();

								// store a referral
								$data = array(
										'order_id' => array(
												'title' => 'Order ID',
												'domain' => AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
												'value' => esc_sql( $order_id )
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
// 										'product_link' => array(
// 												'title'  => 'Product',
// 												'domain' => AFFILIATES_PRODUCTS_PLUGIN_DOMAIN,
// 												'value'  => esc_sql( $product_link )
// 										)
								);

								$post_id = $order_id;
								$description = sprintf( '%s (Order #%s, Product #%s)', $product_description, $order_id, $product_id );
								if ( class_exists( 'Affiliates_Referral_WordPress' ) ) {
									$r = new Affiliates_Referral_WordPress();
									$r->add_referrals( array( $affiliate_id ), $post_id, $description, $data, $product_subtotal, $commission, $currency, null, 'product', $order_id );
								} else {
									self::add_referral( $affiliate_id, $post_id, $description, $data, $commission, $currency );
								}

							}

						}
					}
				}
			}
		}
	}

	/**
	 * Sets defaults.
	 * @param string $new_status
	 * @param string  $old_status
	 * @param object $post
	 */
	public static function transition_post_status( $new_status, $old_status, $post ) {

		if ( isset( $post->ID ) && isset( $post->post_type ) ) {
			if ( $post->post_type == 'product' ) {
				if ( $product_id = $post->ID ) {

					$options = get_option( 'affiliates_products', array() );
					$product_options = isset( $options[self::$instance->get_system()] ) ? $options[self::$instance->get_system()] : array();

					// don't overwrite settings, especially important because
					// we can get in here quite often
					if ( !isset( $product_options[$product_id] ) ) {

						$auto_assign_to_author = isset( $options['auto_assign_to_author'] ) ? $options['auto_assign_to_author'] : false;
						$default_rate          = isset( $options['default_rate'] ) ? $options['default_rate'] : 0;

						$product_option = array();
						if ( $auto_assign_to_author ) {
							if ( isset( $post->post_author ) ) {
								if ( $affiliate_ids = affiliates_get_user_affiliate( $post->post_author ) ) {
									if ( count( $affiliate_ids ) > 0 ) {
										$product_option['affiliate_id'] = $affiliate_ids[0];
									}
								}
							}
						}

						if ( bccomp( $default_rate, '0', Affiliates_Products_Base::DECIMALS ) > 0 ) {
							$product_option['rate'] = $default_rate;
						}

						if ( count( $product_option ) > 0 ) {
							$product_options[$product_id] = $product_option;

							$options[self::$instance->get_system()] = $product_options;
							update_option( 'affiliates_products', $options );
						}
					}
				}
			}
		}
	}


	/**
	 * Adapted from WC_Cart::apply_product_discounts_after_tax()
	 * @param WC_Order $order
	 * @param array $item
	 * @return float sum of total product discounts for line item (takes item quantity into account)
	 */
	public static function get_discount_after_tax_for_order_item( &$order, &$item ) {
		$discount = 0;
		$coupons = $order->get_used_coupons();

		$product = $order->get_product_from_item( $item );

		foreach( $coupons as $code ) {
			$coupon = new WC_Coupon( $code );
			if ( !$coupon->apply_before_tax() ) {
				$product_cats = wp_get_post_terms( $item['product_id'], 'product_cat', array("fields" => "ids") );
				$product_ids_on_sale = woocommerce_get_product_ids_on_sale();

				$this_item_is_discounted = false;

				// Specific products get the discount
				if ( sizeof( $coupon->product_ids ) > 0 ) {

					if (in_array($item['product_id'], $coupon->product_ids) || in_array($item['variation_id'], $coupon->product_ids) || in_array($product->get_parent(), $coupon->product_ids))
						$this_item_is_discounted = true;

					// Category discounts
				} elseif ( sizeof( $coupon->product_categories ) > 0 ) {

					if ( sizeof( array_intersect( $product_cats, $coupon->product_categories ) ) > 0 )
						$this_item_is_discounted = true;

				} else {

					// No product ids - all items discounted
					$this_item_is_discounted = true;

				}

				// Specific product ID's excluded from the discount
				if ( sizeof( $coupon->exclude_product_ids ) > 0 ) {
					if ( in_array( $item['product_id'], $coupon->exclude_product_ids ) || in_array( $item['variation_id'], $coupon->exclude_product_ids ) || in_array( $product->get_parent(), $coupon->exclude_product_ids ) ) {
						$this_item_is_discounted = false;
					}
				}

				// Specific categories excluded from the discount
				if ( sizeof( $coupon->exclude_product_categories ) > 0 ) {
					if ( sizeof( array_intersect( $product_cats, $coupon->exclude_product_categories ) ) > 0 ) {
						$this_item_is_discounted = false;
					}
				}

				// Sale Items excluded from discount
				if ( $coupon->exclude_sale_items == 'yes' ) {
					if ( in_array( $item['product_id'], $product_ids_on_sale, true ) || in_array( $item['variation_id'], $product_ids_on_sale, true ) || in_array( $product->get_parent(), $product_ids_on_sale, true ) ) {
						$this_item_is_discounted = false;
					}
				}

				// Apply filter - note the danger around $values, we're just trying to construct something that might not contain all that is needed to make the filters happy
				$values = $item;
				$values['data'] = $product;
				$values['quantity'] = $item['qty'];
				$this_item_is_discounted = apply_filters( 'woocommerce_item_is_discounted', $this_item_is_discounted, $values, $before_tax = false, $coupon );

				// Apply the discount
				if ( $this_item_is_discounted ) {
					$price = $order->get_item_total( $item, true );
					if ( $coupon->type == 'fixed_product' ) {
						if ( $price < $coupon->amount ) {
							$discount_amount = $price;
						} else {
							$discount_amount = $coupon->amount;
						}
						$discount += $discount_amount * $item['qty'];
					} else if ( $coupon->type == 'percent_product' ) {
						$dp = (int) get_option( 'woocommerce_price_num_decimals' );
						$discount += round( ( $price / 100 ) * $coupon->amount, $dp ) * $item['qty'];
					}
				}
			}
		}
		return $discount;
	}

	/**
	 * Returns net item totals taking into account discounts that have been
	 * applied after taxes.
	 *
	 * Requires the WC_Order class to exist, null is returned otherwise.
	 *
	 * @param int $order_id
	 * @param boolean $prorate_remaining whether to prorate and subtract the non-per-product-discounts per item (yeah that sounds terrible)
	 * @return array of float net item totals, indexed by order_item_id; null if the order can't be retrieved
	 */
	public static function get_net_item_totals( $order_id, $prorate_remaining = false ) {

		$result = null;

		if ( $order_id && class_exists( 'WC_Order' ) ) {
			if ( $order = self::get_order( $order_id ) ) {

				if ( method_exists( 'WC_Order', 'get_total_discount' ) ) {
					$order_discount = $order->get_total_discount();
				} else {
					// $order_discount is the sum of discounts applied after tax
					$order_discount = $order->get_order_discount(); // *
				}

				// $item_total_inc_tax is the sum of item totals after product discounts have been applied and including tax
				$item_total_inc_tax    = 0; // *

				// $net_item_totals at this stage are per-item net discounts based on product discounts that were applied after taxes - prorated remaining order discount is subtracted below
				$net_item_totals = array(); // *

				// $sum_of_... is based on product discounts applied after tax (i.e. excluding other discounts applied after tax)
				$sum_of_product_discounts_after_tax = 0; // *

				foreach( $order->get_items() as $order_item_id => $item ) {

					$this_item_total         = $order->get_item_total( $item, false, false );
					$this_item_total_inc_tax = $order->get_item_total( $item, true, false );

					$item_total_inc_tax += $this_item_total_inc_tax;

					$discount_pre_tax = 0;
					if ( $this_item_total > 0 ) {
						$discount = self::get_discount_after_tax_for_order_item( $order, $item );
						if ( $discount > 0 ) {
							$sum_of_product_discounts_after_tax += $discount;
							$tax_rate = $this_item_total_inc_tax / $this_item_total - 1;
							if ( $tax_rate > 0 ) {
								$discount_pre_tax = $discount / ( 1 + $tax_rate );
							}
						}
					}
					$net_item_total = $this_item_total * $item['qty']- $discount_pre_tax;
					if ( $net_item_total < 0 ) {
						$net_item_total = 0;
					}
					$net_item_totals[$order_item_id] = $net_item_total;

				}

				$remaining_order_discount_after_tax = $order_discount - $sum_of_product_discounts_after_tax; // *

				if ( $prorate_remaining ) {
					// prorate remaining order discount after tax for each item
					$prorated_item_discounts = array(); // *
					foreach( $order->get_items() as $order_item_id => $item ) {
						$this_item_total         = $order->get_item_total( $item, false, false );
						$this_item_total_inc_tax = $order->get_item_total( $item, true, false );
						$this_prorated_discount = 0;
						if ( $item_total_inc_tax > 0 ) {
							$this_prorated_discount = $this_item_total * $remaining_order_discount_after_tax / $item_total_inc_tax; // qty factors out
						}
						$prorated_item_discounts[$order_item_id] = $this_prorated_discount;
					}

					$n = count( $net_item_totals );
					foreach ( $order->get_items() as $order_item_id => $item ) {
						$net_item_totals[$order_item_id] -= $prorated_item_discounts[$order_item_id];
					}
				}

				$result = $net_item_totals;

			}
		}

		return $result;
	}

	/**
	 * Retrieve an order.
	 *
	 * @param int $order_id
	 * @return WC_Order or null
	 */
	public static function get_order( $order_id = '' ) {
		$result = null;
		if ( class_exists( 'WC_Order' ) ) {
			$order = new WC_Order( $order_id );
			if ( $order->get_order( $order_id ) ) {
				$result = $order;
			}
		} else {
			$order = new woocommerce_order();
			if ( method_exists( $order, 'get_order' ) ) {
				if ( $order->get_order( $order_id ) ) {
					$result = $order;
				}
			}
		}
		return $result;
	}
}
Affiliates_Products_WooCommerce::init();
