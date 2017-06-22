<?php
/**
 * class-affiliates-products-base.php
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
 * Base for components.
 */
abstract class Affiliates_Products_Base implements I_Affiliates_Products_Component {

	const NONCE_1 = 'nonce-1';
	const NONCE_2 = 'nonce-2';
	const FILTER_NONCE = 'filter-nonce';
	const SAVE_NONCE = 'save-nonce';

	const PER_PAGE = 10;

	const DECIMALS = 2;

	protected static $instance = null;

	public function get_system() {
		return null;
	}

	public function get_products( $args = array() ) {
		return null;
	}

	public static function affiliates_products() {
		global $wpdb, $affiliates_options;

		if ( self::$instance !== null ) {

			$options = get_option( 'affiliates_products', null );

			if ( $options === null ) {
				$options = array();
				add_option( 'affiliates_products', $options, '', 'no' );
			}
			if ( !isset( $options[self::$instance->get_system()] ) ) {
				$options = array( self::$instance->get_system() => array() );
			}
			$product_options = $options[self::$instance->get_system()];

				$output = '';

				if ( !current_user_can( AFFILIATES_ADMINISTER_OPTIONS ) ) {
					wp_die( __( 'Access denied.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) );
				}

				if (
						isset( $_POST['clear_filters'] ) ||

						isset( $_POST['affiliate_id'] ) ||
						isset( $_POST['affiliate_name'] ) ||
// 						isset( $_POST['affiliate_user_login'] ) ||
						isset( $_POST['product_id'] ) ||
						isset( $_POST['product_name'] )
				) {
					if ( !wp_verify_nonce( $_POST[self::FILTER_NONCE], 'admin' ) ) {
						wp_die( __( 'Access denied.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) );
					}
				}

				// filters
				$affiliate_id         = $affiliates_options->get_option( 'affiliates_products_affiliate_id', null );
				$affiliate_name       = $affiliates_options->get_option( 'affiliates_products_affiliate_name', null );
// 				$affiliate_user_login = $affiliates_options->get_option( 'affiliates_products_affiliate_user_login', null );
				$product_id           = $affiliates_options->get_option( 'affiliates_products_product_id', null );
				$product_name         = $affiliates_options->get_option( 'affiliates_products_product_name', null );

				if ( isset( $_POST['clear_filters'] ) ) {
					$affiliates_options->delete_option( 'affiliates_products_affiliate_id' );
					$affiliates_options->delete_option( 'affiliates_products_affiliate_name' );
// 					$affiliates_options->delete_option( 'affiliates_products_affiliate_user_login' );
					$affiliates_options->delete_option( 'affiliates_products_product_id' );
					$affiliates_options->delete_option( 'affiliates_products_product_name' );
					$affiliate_id = null;
					$affiliate_name = null;
// 					$affiliate_user_login = null;
					$product_id = false;
					$product_name = false;
				} else if ( isset( $_POST['submitted'] ) ) {
					if ( !empty( $_POST['affiliate_name'] ) ) {
						$affiliate_name = trim( $_POST['affiliate_name'] );
						if ( strlen( $affiliate_name ) > 0 ) {
							$affiliates_options->update_option( 'affiliates_products_affiliate_name', $affiliate_name );
						} else {
							$affiliate_name = null;
							$affiliates_options->delete_option( 'affiliates_products_affiliate_name' );
						}
					} else {
						$affiliate_name = null;
						$affiliates_options->delete_option( 'affiliates_products_affiliate_name' );
					}
// 					if ( !empty( $_POST['affiliate_user_login'] ) ) {
// 						$affiliate_user_login = trim( $_POST['affiliate_user_login'] );
// 						if ( strlen( $affiliate_user_login ) > 0 ) {
// 							$affiliates_options->update_option( 'affiliates_products_affiliate_user_login', $affiliate_user_login );
// 						} else {
// 							$affiliate_user_login = null;
// 							$affiliates_options->delete_option( 'affiliates_products_affiliate_user_login' );
// 						}
// 					} else {
// 						$affiliate_user_login = null;
// 						$affiliates_options->delete_option( 'affiliates_products_affiliate_user_login' );
// 					}

					// filter by affiliate id
					if ( !empty( $_POST['affiliate_id'] ) ) {
						$affiliate_id = affiliates_check_affiliate_id( $_POST['affiliate_id'] );
						if ( $affiliate_id ) {
							$affiliates_options->update_option( 'affiliates_products_affiliate_id', $affiliate_id );
						}
					} else if ( isset( $_POST['affiliate_id'] ) ) { // empty && isset => '' => all
						$affiliate_id = null;
						$affiliates_options->delete_option( 'affiliates_products_affiliate_id' );
					}

					// product filters
					if ( !empty( $_POST['product_id'] ) ) {
						$product_id = $_POST['product_id'];
						$affiliates_options->update_option( 'affiliates_products_product_id', $product_id );
					} else if ( isset( $_POST['product_id'] ) ) { // empty && isset => '' => all
						$product_id = null;
						$affiliates_options->delete_option( 'affiliates_products_product_id' );
					}
					if ( !empty( $_POST['product_name'] ) ) {
						$product_name = trim( $_POST['product_name'] );
						if ( strlen( $product_name ) > 0 ) {
							$affiliates_options->update_option( 'affiliates_products_product_name', $product_name );
						} else {
							$product_name = null;
							$affiliates_options->delete_option( 'affiliates_products_product_name' );
						}
					} else {
						$product_name = null;
						$affiliates_options->delete_option( 'affiliates_products_product_name' );
					}
				}

				$current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				$current_url = remove_query_arg( 'paged', $current_url );
				$current_url = remove_query_arg( 'action', $current_url );
				//$current_url = remove_query_arg( 'affiliate_id', $current_url );

				$output .=
					'<div class="affiliates-products">' .
					'<h2>' .
					__( 'Products', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) .
					'</h2>';

				$output .= '<p class="description info">';
				$output .= __( 'Product commission rates are to be given as a decimal number within (0.00, 1.00], i.e. greater than zero and with a maximum value of 1. For example, to grant an affiliate a 10% commission on a product, indicate <em>0.10</em> as the rate.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN );
				$output .= '</p>';


				$args = array();
				$args['display'] = array();

				if ( isset( $_POST['row_count'] ) ) {
					if ( !wp_verify_nonce( $_POST[self::NONCE_1], 'admin' ) ) {
						wp_die( __( 'Access denied.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) );
					}
				}
				$row_count = isset( $_POST['row_count'] ) ? intval( $_POST['row_count'] ) : 0;
				if ($row_count <= 0) {
					$row_count = $affiliates_options->get_option( 'affiliates_products_per_page', self::PER_PAGE );
				} else {
					$affiliates_options->update_option('affiliates_products_per_page', $row_count );
				}
				$args['display']['row_count'] = $row_count;

				$offset = isset( $_GET['offset'] ) ? intval( $_GET['offset'] ) : 0;
				if ( $offset < 0 ) {
					$offset = 0;
				}
				$args['display']['offset'] = $offset;

				if ( isset( $_POST['paged'] ) ) {
					if ( !wp_verify_nonce( $_POST[self::NONCE_2], 'admin' ) ) {
						wp_die( __( 'Access denied.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) );
					}
				}
				$paged = isset( $_GET['paged'] ) ? intval( $_GET['paged'] ) : 0;
				if ( $paged < 0 ) {
					$paged = 0;
				}
				$args['display']['paged'] = $paged;

				$orderby = isset( $_GET['orderby'] ) ? $_GET['orderby'] : null;
				switch ( $orderby ) {
					case 'id' :
					case 'name' :
					case 'affiliate_id' :
						break;
					default:
						$orderby = 'name';
				}
				$args['display']['orderby'] = $orderby;

				$order = isset( $_GET['order'] ) ? $_GET['order'] : null;
				switch ( $order ) {
					case 'asc' :
					case 'ASC' :
						$switch_order = 'DESC';
						break;
					case 'desc' :
					case 'DESC' :
						$switch_order = 'ASC';
						break;
					default:
						$order = 'ASC';
						$switch_order = 'DESC';
				}
				$args['display']['order'] = $order;

				$args['filters'] = array();
				$args['filters']['affiliate_id']   = $affiliate_id;
				$args['filters']['affiliate_name'] = $affiliate_name;
				$args['filters']['product_id']     = $product_id;
				$args['filters']['product_name']   = $product_name;

				$args_ = (array) clone (object) $args;
				unset( $args_['display']['row_count'] );
				unset( $args_['display']['offset'] );
				unset( $args_['display']['paged'] );

				$products = self::$instance->get_products( $args_ );
				$count  = count( $products );
				if ( $count > $row_count ) {
					$paginate = true;
				} else {
					$paginate = false;
				}
				$pages = ceil ( $count / $row_count );
				if ( $paged > $pages ) {
					$paged = $pages;
					$args['display']['paged'] = $paged;
				}
				if ( $paged != 0 ) {
					$offset = ( $paged - 1 ) * $row_count;
					$args['display']['offset'] = $offset;
				}
				$products = self::$instance->get_products( $args );

				// handle action here as we just got the products
				if ( isset( $_POST['action'] ) && $_POST['action'] == 'save' ) {
					if ( !wp_verify_nonce( $_POST[self::SAVE_NONCE], 'admin' ) ) {
						wp_die( __( 'I fart in your general direction!', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) );
					} else {

						// product-%d-affiliate-id
						foreach( $products as $product ) {

							$product = (object) $product;
							$product_option = isset( $product_options[$product->id] ) ? $product_options[$product->id] : array();

							$product_n_affiliate_id = sprintf( 'product-%d-affiliate-id', $product->id );
							if ( empty( $_POST[$product_n_affiliate_id] ) ) {
								unset( $product_option['affiliate_id'] );
							} else {
								$product_option['affiliate_id'] = intval( $_POST[$product_n_affiliate_id] );
							}

							$product_n_rate = sprintf( 'product-%d-rate',$product->id );
							if ( empty( $_POST[$product_n_rate] ) ) {
								unset( $product_option['rate'] );
							} else {
								$rate = bcadd( '0', $_POST[$product_n_rate], self::DECIMALS );
								if ( bccomp( $rate, '1', self::DECIMALS ) > 0 ) {
									$rate = '1.00';
								}
								if ( bccomp( $rate, '0', self::DECIMALS ) > 0 ) {
									$product_option['rate'] = $rate;
								} else {
									unset( $product_option['rate'] );
								}
							}

							/* 22-12 */

							$product_n_vendor_id = sprintf( 'product-%d-vendor-id', $product->id );
							if ( empty( $_POST[$product_n_vendor_id] ) ) {
								unset( $product_option['vendor_id'] );
							} else {
								$product_option['vendor_id'] = intval( $_POST[$product_n_vendor_id] );
							}

							$product_n_vendor_rate = sprintf( 'product-%d-vendor-rate',$product->id );
							if ( empty( $_POST[$product_n_vendor_rate] ) ) {
								unset( $product_option['vendor_rate'] );
							} else {
								$vendor_rate = bcadd( '0', $_POST[$product_n_vendor_rate], self::DECIMALS );
								if ( bccomp( $vendor_rate, '1', self::DECIMALS ) > 0 ) {
									$vendor_rate = '1.00';
								}
								if ( bccomp( $vendor_rate, '0', self::DECIMALS ) > 0 ) {
									$product_option['vendor_rate'] = $vendor_rate;
								} else {
									unset( $product_option['vendor_rate'] );
								}
							}

							$product_n_facilitator_id = sprintf( 'product-%d-facilitator-id', $product->id );
							if ( empty( $_POST[$product_n_facilitator_id] ) ) {
								unset( $product_option['facilitator_id'] );
							} else {
								$product_option['facilitator_id'] = intval( $_POST[$product_n_facilitator_id] );
							}

							$product_n_facilitator_rate = sprintf( 'product-%d-facilitator-rate',$product->id );
							if ( empty( $_POST[$product_n_facilitator_rate] ) ) {
								unset( $product_option['facilitator_rate'] );
							} else {
								$facilitator_rate = bcadd( '0', $_POST[$product_n_facilitator_rate], self::DECIMALS );
								if ( bccomp( $facilitator_rate, '1', self::DECIMALS ) > 0 ) {
									$facilitator_rate = '1.00';
								}
								if ( bccomp( $facilitator_rate, '0', self::DECIMALS ) > 0 ) {
									$product_option['facilitator_rate'] = $facilitator_rate;
								} else {
									unset( $product_option['facilitator_rate'] );
								}
							}

							if ( count( $product_option ) > 0 ) {
								$product_options[$product->id] = $product_option;
							} else {
								unset( $product_options[$product->id] );
							}
						}

						$options[self::$instance->get_system()] = $product_options;
						update_option( 'affiliates_products', $options );
						// need to reload products to reflect changes
						$products = self::$instance->get_products( $args );
						
					}
				}

				$column_display_names = array(
					'id'           => __( 'Id', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ),
					'name'         => __( 'Product', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ),
					'affiliate_id' => __( 'Affiliate', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ),
					'rate'         => __( 'Affiliate Commission', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ),
					'vendor_id'       => __( 'Vendor', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ),
					'vendor_rate'  => __( 'Vendor Commission', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ),
					'facilitator_id'  => __( 'Facilitator', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ),
					'facilitator_rate'  => __( 'Facilitator Commission', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN )
				);

				$output .= '<div class="affiliates-products">';

				$output .=
				'<div class="filters">' .
				'<label class="description" for="setfilters">' . __( 'Filters', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</label>' .
				'<form id="setfilters" action="" method="post">' .

				'<p>' .
				'<label class="product-id-filter" for="product_id">' . __( 'Product Id', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</label>' .
				'<input class="product-id-filter" name="product_id" type="text" value="' . esc_attr( $product_id ) . '"/>' .
				'<label class="product-name-filter" for="product_name">' . __( 'Product Name', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</label>' .
				'<input class="product-name-filter" name="product_name" type="text" value="' . esc_attr( $product_name ) . '"/>' .
				'</p>' .
				'<p>' .

				'<label class="affiliate-id-filter" for="affiliate_id">' . __( 'Affiliate Id', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</label>' .
				'<input class="affiliate-id-filter" name="affiliate_id" type="text" value="' . esc_attr( $affiliate_id ) . '"/>' .
				'<label class="affiliate-name-filter" for="affiliate_name">' . __( 'Affiliate Name', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</label>' .
				'<input class="affiliate-name-filter" name="affiliate_name" type="text" value="' . $affiliate_name . '"/>' .
// 				'<label class="affiliate-user-login-filter" for="affiliate_user_login">' . __( 'Affiliate Username', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</label>' .
// 				'<input class="affiliate-user-login-filter" name="affiliate_user_login" type="text" value="' . $affiliate_user_login . '" />' .
				'</p>' .

				'<p>' .
				wp_nonce_field( 'admin', self::FILTER_NONCE, true, false ) .
				'<input class="button" type="submit" value="' . __( 'Apply', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '"/>' .
				'<input class="button" type="submit" name="clear_filters" value="' . __( 'Clear', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '"/>' .
				'<input type="hidden" value="submitted" name="submitted"/>' .
				'</p>' .
				'</form>' .
				'</div>';

				$output .= '
					<div class="page-options">
					<form id="setrowcount" action="" method="post">
					<div>
					<label for="row_count">' . __('Results per page', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</label>' .
					'<input name="row_count" type="text" size="2" value="' . esc_attr( $row_count ) .'" />
					' . wp_nonce_field( 'admin', self::NONCE_1, true, false ) . '
					<input class="button" type="submit" value="' . __( 'Apply', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '"/>
					</div>
					</form>
					</div>
					';

				if ( $paginate ) {
					require_once( AFFILIATES_CORE_LIB . '/class-affiliates-pagination.php' );
					$pagination = new Affiliates_Pagination( $count, null, $row_count );
					$output .= '<form id="posts-filter" method="post" action="">';
					$output .= '<div>';
					$output .= wp_nonce_field( 'admin', self::NONCE_2, true, false );
					$output .= '</div>';
					$output .= '<div class="tablenav top">';
					$output .= $pagination->pagination( 'top' );
					$output .= '</div>';
					$output .= '</form>';
				}


				$output .= '<form action="" method="post">';

				$output .= '
					<table id="" class="wp-list-table widefat fixed" cellspacing="0">
					<thead>
					<tr>
					';

				foreach ( $column_display_names as $key => $column_display_name ) {
					$options = array(
							'orderby' => $key,
							'order' => $switch_order
					);
					$class = $key;
					if ( !in_array($key, array( 'affiliate_id', 'rate' ) ) ) {
						if ( strcmp( $key, $orderby ) == 0 ) {
							$lorder = strtolower( $order );
							$class = "$key manage-column sorted $lorder";
						} else {
							$class = "$key manage-column sortable";
						}
						$column_display_name = '<a href="' . esc_url( add_query_arg( $options, $current_url ) ) . '"><span>' . $column_display_name . '</span><span class="sorting-indicator"></span></a>';
					}
					$output .= "<th scope='col' class='$class'>$column_display_name</th>";
				}

				$output .= '</tr>
					</thead>
					<tbody>
					';

				$affiliates_table       = _affiliates_get_tablename( 'affiliates' );
				$affiliates_users_table = _affiliates_get_tablename( 'affiliates_users' );

				$affiliates = $wpdb->get_results(
					"SELECT $affiliates_table.*, $wpdb->users.* FROM $affiliates_table LEFT JOIN $affiliates_users_table ON $affiliates_table.affiliate_id = $affiliates_users_table.affiliate_id LEFT JOIN $wpdb->users on $affiliates_users_table.user_id = $wpdb->users.ID ORDER BY $affiliates_table.name"
				);

				$vendors_args = array();
				$vendors_args['fields'] = array( 'ID', 'display_name' );
				$vendors_args['role'] = 'vendor';
				$vendors = get_users( $vendors_args );

				$facilitator_args = array();
				$facilitator_args['fields'] = array( 'ID', 'display_name' );
				$facilitator_args['role'] = 'facilitator';
				$facilitators = get_users( $facilitator_args );
				

				if ( $count > 0 ) {
					$viewing = count( $products );
					for ( $i = 0; $i < $viewing; $i++ ) {

						$result = (object) $products[$i];

						$output .= '<tr id="affiliate_custompro" class="' . ( $i % 2 == 0 ? 'even' : 'odd' ) . '">';

						$output .= "<td class='product-id'>";
						$output .= $result->id;
						$output .= "</td>";

						$output .= "<td class='product-name'>";
						$output .= stripslashes( wp_filter_nohtml_kses( $result->name ) );
						$output .= "</td>";

						$output .= '<td class="affiliate-id">';
						$output .= sprintf( '<select name="product-%d-affiliate-id">', $result->id );
						$output .= '<option value="">-</option>';
						foreach( $affiliates as $affiliate ) {
							$selected = $result->affiliate_id == $affiliate->affiliate_id ? ' selected="selected" ' : '';
							if ( affiliates_check_affiliate_id( $affiliate->affiliate_id ) ) {
								$output .= sprintf( '<option %s value="%d">%s [ID: %d]</option>', $selected, $affiliate->affiliate_id, wp_filter_nohtml_kses( $affiliate->name ), $affiliate->affiliate_id );
							} else if ( $selected != '' ) {
								$output .= sprintf( '<option %s value="%d" disabled="disabled">%s [ID: %d]</option>', $selected, $affiliate->affiliate_id, wp_filter_nohtml_kses( $affiliate->name ), $affiliate->affiliate_id );
							}
						}
						$output .= '</select>';
						$output .= '</td>';

						$output .= '<td class="rate">';
						$output .= sprintf( '<input name="product-%d-rate" type="text" value="%s" />', $result->id, $result->rate );
						$output .= '</td>';

						$output .= '<td class="affiliate-id">';
						$output .= sprintf( '<select name="product-%d-vendor-id">', $result->id );
						$output .= '<option value="">-</option>';
						foreach( $vendors as $vendor ) {
							$selected = $result->vendor_id == $vendor->ID ? ' selected="selected" ' : '';
							if ( $vendor->ID ) {
								$output .= sprintf( '<option %s value="%d">%s [ID: %d]</option>', $selected, $vendor->ID, wp_filter_nohtml_kses( $vendor->display_name ), $vendor->ID );
							} else if ( $selected != '' ) {
								$output .= sprintf( '<option %s value="%d" disabled="disabled">%s [ID: %d]</option>', $selected, $vendor->ID, wp_filter_nohtml_kses($vendor->display_name), $vendor->ID );
							}
						}
						$output .= '</select>';
						$output .= '</td>';

						$output .= '<td class="vendor_rate">';
						$output .= sprintf( '<input name="product-%d-vendor-rate" type="text" value="%s" />', $result->id, $result->vendor_rate );
						$output .= '</td>';

						$output .= '<td class="affiliate-id">';
						$output .= sprintf( '<select name="product-%d-facilitator-id">', $result->id );
						$output .= '<option value="">-</option>';
						foreach( $facilitators as $facilitator ) {
							$selected = $result->facilitator_id == $facilitator->ID ? ' selected="selected" ' : '';
							if ( $facilitator->ID ) {
								$output .= sprintf( '<option %s value="%d">%s [ID: %d]</option>', $selected, $facilitator->ID, wp_filter_nohtml_kses( $facilitator->display_name ), $facilitator->ID );
							} else if ( $selected != '' ) {
								$output .= sprintf( '<option %s value="%d" disabled="disabled">%s [ID: %d]</option>', $selected, $facilitator->ID, wp_filter_nohtml_kses($facilitator->display_name), $facilitator->ID );
							}
						}
						$output .= '</select>';
						$output .= '</td>';

						$output .= '<td class="facilitator_rate">';
						$output .= sprintf( '<input name="product-%d-facilitator-rate" type="text" value="%s" />', $result->id, $result->facilitator_rate );
						$output .= '</td>';

						$output .= '</tr>';
					}

					$output .=
						'<tr class="save">' .
						'<td colspan="' . count( $column_display_names ) . '">' .
						wp_nonce_field( 'admin', self::SAVE_NONCE, true, false ) .
						'<input class="button" type="submit" value="' . __( 'Save', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '" />' .
						'<input type="hidden" name="action" value="save" />' .
						'</td>' .
						'</tr>';

				} else {
					$output .= '<tr><td colspan="' . count( $column_display_names ) . '">' . __( 'There are no results.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</td></tr>';
				}

				$output .= '</tbody>';
				$output .= '</table>';

				$output .= '</form>';

				if ( $paginate ) {
					require_once( AFFILIATES_CORE_LIB . '/class-affiliates-pagination.php' );
					$pagination = new Affiliates_Pagination( $count, null, $row_count );
					$output .= '<div class="tablenav bottom">';
					$output .= $pagination->pagination( 'bottom' );
					$output .= '</div>';
				}

				$output .= '</div>';
				$output .= '</div>';
				echo $output;
				affiliates_footer();

		}

	}

	/**
	 * Store a referral (for Affiliates).
	 * @param int $affiliate_id
	 * @param int  $post_id
	 * @param string $description
	 * @param array $data
	 * @param string $amount
	 * @param string $currency_id
	 * @param string $status
	 * @return int
	 */
	public static function add_referral( $affiliate_id, $post_id, $description = '', $data = null, $amount = null, $currency_id = null, $status = null ) {
		global $wpdb;

		if ( $affiliate_id ) {

			$current_user = wp_get_current_user();
			$now = date('Y-m-d H:i:s', time() );
			$table = _affiliates_get_tablename( 'referrals' );

			$columns = "(affiliate_id, post_id, datetime, description";
			$formats = "(%d, %d, %s, %s";
			$values = array( $affiliate_id, $post_id, $now, $description );

			if ( !empty( $current_user ) ) {
				$columns .= ",user_id ";
				$formats .= ",%d ";
				$values[] = $current_user->ID;
			}

			// add ip
			$ip_address = $_SERVER['REMOTE_ADDR'];
			if ( PHP_INT_SIZE >= 8 ) {
				if ( $ip_int = ip2long( $ip_address ) ) {
					$columns .= ',ip ';
					$formats .= ',%d ';
					$values[] = $ip_int;
				}
			} else {
				if ( $ip_int = ip2long( $ip_address ) ) {
					$ip_int = sprintf( '%u', $ip_int );
					$columns .= ',ip';
					$formats .= ',%s';
					$values[] = $ip_int;
				}
			}

			if ( is_array( $data ) && !empty( $data ) ) {
				$columns .= ",data ";
				$formats .= ",%s ";
				$values[] = serialize( $data );
			}

			if ( !empty( $amount ) && !empty( $currency_id ) ) {
				if ( $amount = Affiliates_Utility::verify_referral_amount( $amount ) ) {
					if ( $currency_id =  Affiliates_Utility::verify_currency_id( $currency_id ) ) {
						$columns .= ",amount ";
						$formats .= ",%s ";
						$values[] = $amount;

						$columns .= ",currency_id ";
						$formats .= ",%s ";
						$values[] = $currency_id;
					}
				}
			}
			if ( !empty( $status ) && Affiliates_Utility::verify_referral_status_transition( $status, $status ) ) {
				$columns .= ',status ';
				$formats .= ',%s ';
				$values[] = $status;
			} else {
				$columns .= ',status ';
				$formats .= ',%s ';
				$values[] = get_option( 'aff_default_referral_status', AFFILIATES_REFERRAL_STATUS_ACCEPTED );
			}

			$columns .= ")";
			$formats .= ")";

			// add the referral
			$query = $wpdb->prepare( "INSERT INTO $table $columns VALUES $formats", $values );
			if ( $wpdb->query( $query ) !== false ) {
				if ( $referral_id = $wpdb->get_var( "SELECT LAST_INSERT_ID()" ) ) {
					do_action( 'affiliates_referral', $referral_id );
				}
			}
		}
		return $affiliate_id;
	}
}