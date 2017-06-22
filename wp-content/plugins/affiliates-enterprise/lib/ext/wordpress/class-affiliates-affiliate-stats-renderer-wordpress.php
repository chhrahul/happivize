<?php
 class Affiliates_Affiliate_Stats_Renderer_WordPress extends Affiliates_Affiliate_Stats_Renderer { const NONCE = 'affiliate-stats-nonce'; const NONCE_1 = 'affiliate-stats-nonce-1'; const NONCE_2 = 'affiliate-stats-nonce-2'; const NONCE_FILTERS = 'affiliate-stats-nonce-filters'; static function render_referrals( $IXAP24 = array() ) { global $wpdb, $affiliates_options, $affiliates_db; $IXAP34 = ''; $affiliate_id = Affiliates_Affiliate_WordPress::get_user_affiliate_id(); if ( $affiliate_id === false ) { return $IXAP34; } $IXAP15 = $affiliates_options->get_option( 'affiliate_stats_referrals_from_date', null ); $IXAP16 = $affiliates_options->get_option( 'affiliate_stats_referrals_thru_date', null ); if ( isset( $_POST[self::NONCE_FILTERS] ) ) { if ( !wp_verify_nonce( $_POST[self::NONCE_FILTERS], plugin_basename( __FILE__ ) ) ) { wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } if ( isset( $_POST['clear_filters'] ) ) { $affiliates_options->delete_option( 'affiliate_stats_referrals_from_date' ); $affiliates_options->delete_option( 'affiliate_stats_referrals_thru_date' ); $IXAP15 = null; $IXAP16 = null; } else { if ( !empty( $_POST['from_date'] ) ) { $IXAP15 = date( 'Y-m-d', strtotime( $_POST['from_date'] ) ); $affiliates_options->update_option( 'affiliate_stats_referrals_from_date', $IXAP15 ); } if ( !empty( $_POST['thru_date'] ) ) { $IXAP16 = date( 'Y-m-d', strtotime( $_POST['thru_date'] ) ); $affiliates_options->update_option( 'affiliate_stats_referrals_thru_date', $IXAP16 ); } if ( $IXAP15 && $IXAP16 ) { if ( strtotime( $IXAP15 ) > strtotime( $IXAP16 ) ) { $IXAP16 = null; $affiliates_options->delete_option( 'affiliate_stats_referrals_thru_date' ); } } } } if ( $IXAP15 ) { $IXAP20 = DateHelper::u2s( $IXAP15 ); } if ( $IXAP16 ) { $IXAP21 = DateHelper::u2s( $IXAP16, 24*3600 ); } if ( isset( $_POST['row_count'] ) ) { if ( !wp_verify_nonce( $_POST[self::NONCE_1], plugin_basename( __FILE__ ) ) ) { wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } } if ( isset( $_POST['paged'] ) ) { if ( !wp_verify_nonce( $_POST[self::NONCE_2], plugin_basename( __FILE__ ) ) ) { wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); } } $IXAP59 = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; $IXAP59 = remove_query_arg( 'paged', $IXAP59 ); $affiliates_table = $affiliates_db->get_tablename( 'affiliates' ); $referrals_table = $affiliates_db->get_tablename( 'referrals' ); $IXAP18 = $affiliates_db->get_tablename( 'hits' ); $posts_table = $wpdb->prefix . 'posts'; $IXAP247 = isset( $_POST['row_count'] ) ? intval( $_POST['row_count'] ) : 0; if ($IXAP247 <= 0) { $IXAP247 = $affiliates_options->get_option( 'affiliate_stats_referrals_per_page', self::AFFILIATES_STATS_PER_PAGE ); } else { $affiliates_options->update_option( 'affiliate_stats_referrals_per_page', $IXAP247 ); } $IXAP248 = isset( $_GET['offset'] ) ? intval( $_GET['offset'] ) : 0; if ( $IXAP248 < 0 ) { $IXAP248 = 0; } $IXAP249 = isset( $_REQUEST['paged'] ) ? intval( $_REQUEST['paged'] ) : 0; if ( !isset( $_REQUEST['paged'] ) ) { $IXAP249 = intval( get_query_var( 'paged' ) ); } if ( $IXAP249 < 0 ) { $IXAP249 = 0; } $IXAP68 = isset( $_GET['orderby'] ) ? $_GET['orderby'] : null; switch ( $IXAP68 ) { case 'referral_id' : case 'reference' : case 'datetime' : case 'post_title' : case 'amount' : case 'currency_id' : case 'status' : break; default : $IXAP68 = 'datetime'; } $IXAP69 = isset( $_GET['order'] ) ? $_GET['order'] : null; switch ( $IXAP69 ) { case 'asc' : case 'ASC' : $switch_order = 'DESC'; break; case 'desc' : case 'DESC' : $switch_order = 'ASC'; break; default: $IXAP69 = 'DESC'; $switch_order = 'ASC'; } if ( $IXAP15 || $IXAP16 || $affiliate_id ) { $IXAP179 = " WHERE "; } else { $IXAP179 = ''; } $IXAP180 = array(); if ( $IXAP15 && $IXAP16 ) { $IXAP179 .= " datetime >= %s AND datetime < %s "; $IXAP180[] = $IXAP20; $IXAP180[] = $IXAP21; } else if ( $IXAP15 ) { $IXAP179 .= " datetime >= %s "; $IXAP180[] = $IXAP20; } else if ( $IXAP16 ) { $IXAP179 .= " datetime < %s "; $IXAP180[] = $IXAP21; } if ( $affiliate_id ) { if ( $IXAP15 || $IXAP16 ) { $IXAP179 .= " AND "; } $IXAP179 .= " r.affiliate_id = %d "; $IXAP180[] = $affiliate_id; } $show_accepted = isset( $IXAP24['show_accepted'] ) && ( ( $IXAP24['show_accepted'] === true ) || ( $IXAP24['show_accepted'] == 'true' ) ); $show_pending = isset( $IXAP24['show_pending'] ) && ( ( $IXAP24['show_pending'] === true ) || ( $IXAP24['show_pending'] == 'true' ) ); $show_closed = isset( $IXAP24['show_closed'] ) && ( ( $IXAP24['show_closed'] === true ) || ( $IXAP24['show_closed'] == 'true' ) ); $show_rejected = isset( $IXAP24['show_rejected'] ) && ( ( $IXAP24['show_rejected'] === true ) || ( $IXAP24['show_rejected'] == 'true' ) ); $statuses = 0; if ( $show_accepted ) { $statuses++; $IXAP180[] = AFFILIATES_REFERRAL_STATUS_ACCEPTED; } if ( $show_pending ) { $statuses++; $IXAP180[] = AFFILIATES_REFERRAL_STATUS_PENDING; } if ( $show_closed ) { $statuses++; $IXAP180[] = AFFILIATES_REFERRAL_STATUS_CLOSED; } if ( $show_rejected ) { $statuses++; $IXAP180[] = AFFILIATES_REFERRAL_STATUS_REJECTED; } if ( $IXAP15 || $IXAP16 || $affiliate_id ) { $IXAP179 .= " AND "; } switch ( $statuses ) { case 1 : $IXAP179 .= " r.status = %s "; break; case 2 : $IXAP179 .= " r.status IN ( %s, %s ) "; break; case 3 : $IXAP179 .= " r.status IN ( %s, %s, %s ) "; break; case 4 : $IXAP179 .= " r.status IN ( %s, %s, %s, %s ) "; break; default : $IXAP179 .= " r.status = '' "; } $IXAP250 = $wpdb->prepare( "SELECT count(*) FROM $referrals_table r
			$IXAP179
			", $IXAP180 ); $IXAP251 = $wpdb->get_var( $IXAP250 ); if ( $IXAP251 > $IXAP247 ) { $IXAP252 = true; } else { $IXAP252 = false; } $IXAP75 = ceil ( $IXAP251 / $IXAP247 ); if ( $IXAP249 > $IXAP75 ) { $IXAP249 = $IXAP75; } if ( $IXAP249 != 0 ) { $IXAP248 = ( $IXAP249 - 1 ) * $IXAP247; } $IXAP3 = $wpdb->prepare("
			SELECT r.*
			FROM $referrals_table r
			LEFT JOIN $affiliates_table a ON r.affiliate_id = a.affiliate_id
			LEFT JOIN $posts_table p ON r.post_id = p.ID
			$IXAP179
			ORDER BY $IXAP68 $IXAP69
			LIMIT $IXAP247 OFFSET $IXAP248
			", $IXAP180 ); $IXAP26 = $wpdb->get_results( $IXAP3, OBJECT ); $IXAP34 .= '<div class="affiliate-stats referrals">'; $IXAP34 .= '
			<div class="page-options">
				<form id="setrowcount" action="" method="post">
					<div>
						<label for="row_count">' . __('Results per page', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<input name="row_count" type="text" size="2" value="' . esc_attr( $IXAP247 ) .'" />
						' . wp_nonce_field( plugin_basename( __FILE__ ), self::NONCE_1, true, false ) . '
						<input type="submit" value="' . __( 'Apply', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>
					</div>
				</form>
			</div>
			'; if ( $IXAP252 ) { $IXAP253 = new Affiliates_Pagination( $IXAP251, null, $IXAP247 ); $IXAP34 .= '<form id="posts-filter" method="post" action="">'; $IXAP34 .= '<div>'; $IXAP34 .= wp_nonce_field( plugin_basename( __FILE__ ), self::NONCE_2, true, false ); $IXAP34 .= '</div>'; $IXAP34 .= '<div class="tablenav top">'; $IXAP34 .= $IXAP253->pagination( 'top' ); $IXAP34 .= '</div>'; $IXAP34 .= '</form>'; } $show_post = isset( $IXAP24['show_post'] ) && ( ( $IXAP24['show_post'] === true ) || ( $IXAP24['show_post'] == 'true' ) ); $show_referral_id = isset( $IXAP24['show_referral_id'] ) && ( ( $IXAP24['show_referral_id'] === true ) || ( $IXAP24['show_referral_id'] == 'true' ) ); $show_reference = isset( $IXAP24['show_reference'] ) && ( ( $IXAP24['show_reference'] === true ) || ( $IXAP24['show_reference'] == 'true' ) ); $IXAP105 = array( 'datetime' => __( 'Date', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); if ( $show_referral_id ) { $IXAP105['referral_id'] = __( 'ID', AFFILIATES_PRO_PLUGIN_DOMAIN ); } if ( $show_reference ) { $IXAP105['reference'] = __( 'Reference', AFFILIATES_PRO_PLUGIN_DOMAIN ); } if ( $show_post ) { $IXAP105['post_title'] = __( 'Post', AFFILIATES_PRO_PLUGIN_DOMAIN ); } $show_amount = isset( $IXAP24['show_amount'] ) && ( ( $IXAP24['show_amount'] === true ) || ( $IXAP24['show_amount'] == 'true' ) ); if ( $show_amount ) { $IXAP105['amount'] = __( 'Amount', AFFILIATES_PRO_PLUGIN_DOMAIN ); } $show_currency_id = isset( $IXAP24['show_currency_id'] ) && ( ( $IXAP24['show_currency_id'] === true ) || ( $IXAP24['show_currency_id'] == 'true' ) ); if ( $show_currency_id ) { $IXAP105['currency_id'] = __( 'Currency', AFFILIATES_PRO_PLUGIN_DOMAIN ); } $show_status = isset( $IXAP24['show_status'] ) && ( ( $IXAP24['show_status'] === true ) || ( $IXAP24['show_status'] == 'true' ) ); if ( $show_status ) { $IXAP105['status'] = __( 'Status', AFFILIATES_PRO_PLUGIN_DOMAIN ); } if ( !empty( $IXAP24['data'] ) ) { $IXAP105['data'] = __( 'Details', AFFILIATES_PRO_PLUGIN_DOMAIN ); } $IXAP105 = apply_filters( 'affiliates_affiliate_stats_renderer_column_display_names', $IXAP105 ); $IXAP254 = count( $IXAP105 ); $IXAP34 .= '<table class="referrals" cellspacing="0" cellpadding="0">'; $IXAP34 .= '<thead>'; $IXAP34 .= '<tr>'; foreach ( $IXAP105 as $key => $IXAP106 ) { $sort_options = array( 'orderby' => $key, 'order' => $switch_order ); if ( in_array( $key, array( 'referral_id', 'reference', 'datetime', 'post_title', 'amount', 'currency_id', 'status' ) ) ) { $IXAP107 = ""; if ( strcmp( $key, $IXAP68 ) == 0 ) { $IXAP108 = strtolower( $IXAP69 ); $IXAP107 = "$key manage-column sorted $IXAP108"; } else { $IXAP107 = "$key manage-column sortable"; } $IXAP106 = '<a href="' . esc_url( add_query_arg( $sort_options, $IXAP59 ) ) . '"><span>' . $IXAP106 . '</span><span class="sorting-indicator"></span></a>'; $IXAP34 .= "<th scope='col' class='$IXAP107'>$IXAP106</th>"; } else { $IXAP34 .= "<th scope='col' class='$key'>$IXAP106</th>"; } } $IXAP34 .= '</tr>'; $IXAP34 .= '</thead>'; $IXAP34 .= '<tbody>'; if ( count( $IXAP26 ) > 0 ) { $data_fields = array(); if ( !empty( $IXAP24['data'] ) ) { $fields = explode(",", $IXAP24['data'] ); if ( !empty( $fields ) ) { foreach( $fields as $field ) { $data_fields[] = trim( $field ); } } } $status_descriptions = array( AFFILIATES_REFERRAL_STATUS_ACCEPTED => __( 'Accepted', AFFILIATES_PLUGIN_DOMAIN ), AFFILIATES_REFERRAL_STATUS_CLOSED => __( 'Closed', AFFILIATES_PLUGIN_DOMAIN ), AFFILIATES_REFERRAL_STATUS_PENDING => __( 'Pending', AFFILIATES_PLUGIN_DOMAIN ), AFFILIATES_REFERRAL_STATUS_REJECTED => __( 'Rejected', AFFILIATES_PLUGIN_DOMAIN ), ); for ( $i = 0; $i < count( $IXAP26 ); $i++ ) { $IXAP11 = $IXAP26[$i]; $IXAP34 .= '<tr class="details-referrals ' . ( $i % 2 == 0 ? 'even' : 'odd' ) . '">'; foreach( $IXAP105 as $key => $IXAP106 ) { switch( $key ) { case 'referral_id' : $IXAP34 .= '<td class="referral_id">' . wp_filter_nohtml_kses( $IXAP11->referral_id ) . '</td>'; break; case 'reference' : $IXAP34 .= '<td class="reference">' . wp_filter_nohtml_kses( $IXAP11->reference ) . '</td>'; break; case 'datetime' : $IXAP34 .= '<td class="datetime">' . DateHelper::s2u( $IXAP11->datetime ) . '</td>'; break; case 'post_title' : if ( $show_post ) { if ( !empty( $IXAP11->post_id ) ) { $IXAP255 = get_permalink( $IXAP11->post_id ); $post_title = get_the_title( $IXAP11->post_id ); $IXAP34 .= '<td class="post_title"><a href="' . esc_attr( $IXAP255 ) . '" target="_blank">' . wp_filter_nohtml_kses( $post_title ) . '</a></td>'; } else { $IXAP34 .= '<td class="post_title"></td>'; } } break; case 'amount' : if ( $show_amount ) { $IXAP34 .= '<td class="amount">' . esc_attr( $IXAP11->amount ) . '</td>'; } break; case 'currency_id' : if ( $show_currency_id ) { $IXAP34 .= '<td class="currency_id">' . esc_attr( $IXAP11->currency_id ) . '</td>'; } break; case 'status' : if ( $show_status ) { $IXAP34 .= '<td class="status">' . ( isset( $status_descriptions[$IXAP11->status] ) ? $status_descriptions[$IXAP11->status] : esc_attr( $IXAP11->status ) ) . '</td>'; } break; case 'data' : if ( !empty( $data_fields ) ) { $data = $IXAP11->data; if ( !empty( $data ) ) { $data = unserialize( $data ); } else { $data = array(); } $data = apply_filters( 'affiliates_affiliate_stats_renderer_data', $data, $IXAP11 ); $IXAP34 .= '<td>'; if ( $data ) { $data_output = ''; if ( is_array( $data ) ) { foreach ( $data_fields as $key ) { if ( isset( $data[$key] ) ) { $info = $data[$key]; $IXAP190 = __( $info['title'], $info['domain'] ); $value = $info['value']; $data_output .= '<div class="referral-data-title">'; $data_output .= stripslashes( wp_filter_nohtml_kses( $IXAP190 ) ); $data_output .= '</div>'; $data_output .= '<div class="referral-data-value">'; $data_output .= stripslashes( wp_filter_nohtml_kses( $value ) ); $data_output .= '</div>'; } } } else { if ( !empty( $data_fields ) && ( $data_fields[0] == 'data' ) ) { $data_output .= '<div class="referral-data-value">'; $data_output .= stripslashes( wp_filter_nohtml_kses( $data ) ); $data_output .= '</div>'; } } $IXAP34 .= apply_filters( 'affiliates_affiliate_stats_renderer_data_output', $data_output, $IXAP11 ); } $IXAP34 .= '</td>'; } break; default : $IXAP34 .= sprintf( '<td class="%s">', esc_attr( $key ) ); $IXAP34 .= apply_filters( 'affiliates_affiliate_stats_renderer_column_output', '', $key, $IXAP11 ); $IXAP34 .= '</td>'; } } $IXAP34 .= '</tr>'; } } else { $IXAP34 .= '<tr><td colspan="' . $IXAP254 . '">' . __('There are no results.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</td></tr>'; } $IXAP34 .= '</tbody>'; $IXAP34 .= '</table>'; if ( $IXAP252 ) { $IXAP253 = new Affiliates_Pagination( $IXAP251, null, $IXAP247 ); $IXAP34 .= '<div class="tablenav bottom">'; $IXAP34 .= $IXAP253->pagination( 'bottom' ); $IXAP34 .= '</div>'; } $IXAP34 .= '<div class="filters">' . '<label class="description" for="setfilters">' . __( 'Filters', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<form id="setfilters" action="" method="post">' . '<div class="from-date">' . '<label class="from-date-filter" for="from_date">' . __('From', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<input class="datefield from-date-filter" name="from_date" type="text" value="' . esc_attr( $IXAP15 ) . '"/>'. '</div>' . '<div class="thru-date">' . '<label class="thru-date-filter" for="thru_date">' . __('Until', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<input class="datefield thru-date-filter" name="thru_date" type="text" class="datefield" value="' . esc_attr( $IXAP16 ) . '"/>'. '</div>' . '<div class="submit">' . wp_nonce_field( plugin_basename( __FILE__ ), self::NONCE_FILTERS, true, false ) . '<input type="submit" value="' . __( 'Apply', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' . '<input type="submit" name="clear_filters" value="' . __( 'Clear', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' . '<input type="hidden" value="submitted" name="submitted"/>' . '</div>' . '</form>' . '</div>'; $IXAP34 .= '</div>'; return $IXAP34; } } 