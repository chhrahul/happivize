<?php
 class Affiliates_Stats_Renderer_WordPress extends Affiliates_Stats_Renderer 
 { 
 	const NONCE = 'affiliate-nonce';
 	const NONCE_1 = 'affiliate-nonce-1';
 	const NONCE_2 = 'affiliate-nonce-2'; 
 	const NONCE_FILTERS = 'affiliate-nonce-filters'; 
 	static function init() 
 	{ 
 		add_shortcode( 'affiliates_affiliate_stats', array( 'Affiliates_Stats_Renderer_WordPress', 'stats_shortcode' ) );
 	} 
 	static function stats_shortcode( $IXAP31, $IXAP32 = null ) 
 	{ 
 		$IXAP11 = null;
 		wp_enqueue_script( 'datepicker' ); 
 		wp_enqueue_script( 'datepickers' ); 
 		wp_enqueue_style( 'smoothness' ); 
 		wp_enqueue_style( 'affiliates-pro' ); 
 		$IXAP24 = shortcode_atts( self::$stats_defaults, $IXAP31 ); 
 		switch ( $IXAP24['type'] ) 
 		{ 
 			case self::STATS_REFERRALS : $IXAP11 = Affiliates_Affiliate_Stats_Renderer_WordPress::render_referrals( $IXAP24 ); 
 			break;
 			case self::STATS_SUMMARY : $IXAP11 = self::render_affiliate_stats( $IXAP24 );
 			break; 
 		} 
 		return $IXAP11;
 	}
 	static function render_affiliate_stats( $IXAP24 = array() ) 
 	{ 
 		global $affiliates_options, $affiliates_db;
 		$IXAP34 = '';
 		$affiliate_id = Affiliates_Affiliate_WordPress::get_user_affiliate_id();

 		if ( $affiliate_id === false ) 
 		{ 
 			return $IXAP34; 
 		} 
 		$IXAP15 = $affiliates_options->get_option( 'affiliate_stats_from_date', null ); 
 		$IXAP16 = $affiliates_options->get_option( 'affiliate_stats_thru_date', null ); 
 		$IXAP15 = date('d-m-Y',(strtotime('this month',strtotime(date('Y-m-01'))))); 
 		$IXAP16 = date('d-m-Y');

 		if ( isset( $_POST[self::NONCE_FILTERS] ) ) 
 		{ 
 			if ( !wp_verify_nonce( $_POST[self::NONCE_FILTERS], plugin_basename( __FILE__ ) ) ) 
 			{ 
 				wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) );
 			} 
 			if ( isset( $_POST['clear_filters'] ) ) 
 			{ 
 				$affiliates_options->delete_option( 'affiliate_stats_from_date' ); 
 				$affiliates_options->delete_option( 'affiliate_stats_thru_date' ); 
 				$IXAP15 = null; 
 				$IXAP16 = null;
 			} 
 			else 
 			{ 
 				if ( !empty( $_POST['from_date'] ) ) 
 				{ 
 					$IXAP15 = date( 'd-m-Y', strtotime( $_POST['from_date'] ) ); 
 					$affiliates_options->update_option( 'affiliate_stats_from_date', $IXAP15 ); 
 				} 

 				if ( !empty( $_POST['thru_date'] ) ) 
 				{ 
 					$IXAP16 = date( 'd-m-Y', strtotime( $_POST['thru_date'] ) ); 
 					$affiliates_options->update_option( 'affiliate_stats_thru_date', $IXAP16 ); 
 				} 

 				if ( $IXAP15 && $IXAP16 ) 
 				{ 
 					if ( strtotime( $IXAP15 ) > strtotime( $IXAP16 ) ) 
 					{ 
 						$IXAP16 = null; 
 						$affiliates_options->delete_option( 'affiliate_stats_thru_date' ); 
 					} 
 				} 
 			} 
 		} 
 		if ( $IXAP15 ) 
 		{ 
 			$IXAP20 = DateHelper::u2s( $IXAP15 ); 
 		} 
 		if ( $IXAP16 ) 
 		{ 
 			$IXAP21 = DateHelper::u2s( $IXAP16, 24*3600 ); 
 		} 
 		$affiliates_table = $affiliates_db->get_tablename( 'affiliates' ); 
 		$referrals_table = $affiliates_db->get_tablename( 'referrals' ); 
 		$IXAP18 = $affiliates_db->get_tablename( 'hits' ); 
 		if ( $IXAP15 || $IXAP16 || $affiliate_id ) 
 		{ 
 			$IXAP179 = " WHERE "; 
 		} 
 		else 
 		{ 
 			$IXAP179 = ''; 
 		} 
 		$IXAP180 = array(); 
 		if ( $IXAP15 && $IXAP16 ) 
 		{ 
 			$IXAP179 .= " datetime >= %s AND datetime < %s "; 
 			$IXAP180[] = $IXAP20; 
 			$IXAP180[] = $IXAP21; 
 		} 
 		else if ( $IXAP15 ) 
 		{ 
 			$IXAP179 .= " datetime >= %s "; 
 			$IXAP180[] = $IXAP20; 
 		} 
 		else if ( $IXAP16 ) 
 		{
 			$IXAP179 .= " datetime < %s "; 
 			$IXAP180[] = $IXAP21; 
 		} 
 		if ( $affiliate_id ) 
 		{ 
 			if ( $IXAP15 || $IXAP16 ) 
 			{ 
 				$IXAP179 .= " AND "; 
 			} 
 			$IXAP179 .= " h.affiliate_id = %d "; 
 			$IXAP180[] = $affiliate_id; 

	 	 } 
	 	 $IXAP105 = array( 'visits' => __( 'Visits', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'hits' => __( 'Hits', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'referrals' => __( 'Referrals', AFFILIATES_PRO_PLUGIN_DOMAIN ), 'ratio' => __( 'Ratio', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); 

 			$IXAP145 = affiliates_get_affiliate_visits( $affiliate_id, $IXAP15, $IXAP16 ); 
 			$IXAP142 = affiliates_get_affiliate_hits( $affiliate_id, $IXAP15, $IXAP16 ); 
 			$referrals = affiliates_get_affiliate_referrals( $affiliate_id, $IXAP15, $IXAP16 ); 

			$IXAP34 .= '<div class="filters">' . '<label class="description" for="setfilters">' . __( 'Filters', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label>' . '<form id="setfilters" action="" method="post">' . '<div class="from-date">' . '<!--label class="from-date-filter" for="from_date">' . __('From', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label-->' . '<noscript><span class="description mini">' . __( 'Format: YYYY-MM-DD', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</span></noscript>' . '<input id="datepicker" class="datefield from-date-filter" name="from_date" type="text" value="' . esc_attr( $IXAP15 ) . '"/>'. '</div>' . '<div class="thru-date">' . '<!--label class="thru-date-filter" for="thru_date">' . __('Until', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</label-->' . '<noscript><span class="description mini">' . __( 'Format: YYYY-MM-DD', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</span></noscript>' . '<input id="datefield_until" class="datefield thru-date-filter" name="thru_date" type="text" class="datefield" value="' . esc_attr( $IXAP16 ) . '"/>'. '</div>' . '<div class="submit">' . wp_nonce_field( plugin_basename( __FILE__ ), self::NONCE_FILTERS, true, false ) . '<input class="default-input button-reload" type="submit" value="' . __( 'Refresh Ledger', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' . '<input style="display:none;" class="default-input button-clear" type="submit" name="clear_filters" value="' . __( 'Clear', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' . '<input type="hidden" value="submitted" name="submitted"/>' . '</div>' . '</form>' . '</div>';

			$show_totals = isset( $IXAP24['show_totals'] ) ? ( $IXAP24['show_totals'] !== 'false' ) : true;
			$show_totals_accepted = isset( $IXAP24['show_totals_accepted'] ) ? ( $IXAP24['show_totals_accepted'] === true || $IXAP24['show_totals_accepted'] === 'true' ) : false; 
			$show_totals_pending = isset( $IXAP24['show_totals_pending'] ) ? ( $IXAP24['show_totals_pending'] === true || $IXAP24['show_totals_pending'] === 'true' ) : false; 
			$show_totals_closed = isset( $IXAP24['show_totals_closed'] ) ? ( $IXAP24['show_totals_closed'] === true || $IXAP24['show_totals_closed'] === 'true' ) : false; 
			$show_totals_rejected = isset( $IXAP24['show_totals_rejected'] ) ? ( $IXAP24['show_totals_rejected'] === true || $IXAP24['show_totals_rejected'] === 'true' ) : false;

			 

			if ( $show_totals && ( $show_totals_accepted || $show_totals_pending || $show_totals_closed || $show_totals_rejected ) ) 
			{ 
				$IXAP324 = ''; 	
				$j_from_date = date( 'Y-m-d', strtotime( $_POST['from_date'] ));

				$j_thru_date = date( 'Y-m-d', strtotime( $_POST['thru_date'] ) ); 

				

				if ( $IXAP15 && $IXAP16 ) 
				{ 					
					$IXAP324 = " AND datetime >= '$IXAP20' AND datetime < '$IXAP21' ";

					$IXAP34j = "For Date Range ( ".$IXAP15." - ".$IXAP16." )";
					
				} 
				else if ( $IXAP15 ) 
				{ 
					$IXAP324 = " AND datetime >= '$IXAP20' "; 
				} 
				else if ( $IXAP16 ) 
				{ 
					$IXAP324 = " AND datetime < '$IXAP21' "; 
				} 
				elseif ( !($IXAP15) && !($IXAP16)) {
					$startfrom = date('Y-m-d',(strtotime('this month',strtotime(date('Y-m-01')))));
			  		$startuntil = date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d'))));

					$IXAP324 = " AND datetime >= '$startfrom' AND datetime < '$startuntil' "; 
					$IXAP34j = "For Date Range ( ".date('d-m-Y',(strtotime('this month',strtotime(date('01-m-Y')))))." - ".date('m-d-Y' ).")";
				}
				$IXAP257 = $affiliates_db->get_objects( "SELECT SUM(amount) AS total, currency_id FROM $referrals_table WHERE affiliate_id = %d $IXAP324 AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL GROUP BY currency_id", $affiliate_id, AFFILIATES_REFERRAL_STATUS_ACCEPTED ); 

				$IXAP258 = $affiliates_db->get_objects( "SELECT SUM(amount) AS total, currency_id FROM $referrals_table WHERE affiliate_id = %d $IXAP324 AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL GROUP BY currency_id", $affiliate_id, AFFILIATES_REFERRAL_STATUS_PENDING ); 

				$IXAP259 = $affiliates_db->get_objects( "SELECT SUM(amount) AS total, currency_id FROM $referrals_table WHERE affiliate_id = %d $IXAP324 AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL GROUP BY currency_id", $affiliate_id, AFFILIATES_REFERRAL_STATUS_CLOSED ); 

				$IXAP260 = $affiliates_db->get_objects( "SELECT SUM(amount) AS total, currency_id FROM $referrals_table WHERE affiliate_id = %d $IXAP324 AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL GROUP BY currency_id", $affiliate_id, AFFILIATES_REFERRAL_STATUS_REJECTED ); 



				$acceptedrecord = $affiliates_db->get_objects( "SELECT amount, currency_id, description, post_id ,datetime,data FROM $referrals_table WHERE affiliate_id = %d $IXAP324 AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL", $affiliate_id, AFFILIATES_REFERRAL_STATUS_ACCEPTED );				

				$acceptedpending = $affiliates_db->get_objects( "SELECT amount, currency_id, description, post_id ,datetime,data FROM $referrals_table WHERE affiliate_id = %d $IXAP324 AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL", $affiliate_id, AFFILIATES_REFERRAL_STATUS_PENDING );

				$acceptedpendingtotal = $affiliates_db->get_objects( "SELECT SUM(amount) AS total, currency_id FROM $referrals_table WHERE affiliate_id = %d $IXAP324 AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL GROUP BY currency_id", $affiliate_id, AFFILIATES_REFERRAL_STATUS_PENDING );

				$acceptedclosed = $affiliates_db->get_objects( "SELECT amount, currency_id, description, post_id ,datetime,data FROM $referrals_table WHERE affiliate_id = %d $IXAP324 AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL", $affiliate_id, AFFILIATES_REFERRAL_STATUS_CLOSED );

				$acceptedrejected = $affiliates_db->get_objects( "SELECT amount, currency_id, description, post_id ,datetime,data FROM $referrals_table WHERE affiliate_id = %d $IXAP324 AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL", $affiliate_id, AFFILIATES_REFERRAL_STATUS_REJECTED );

				$acceptedrejectedtotal = $affiliates_db->get_objects( "SELECT SUM(amount) AS total, currency_id FROM $referrals_table WHERE affiliate_id = %d $IXAP324 AND status = %s AND amount IS NOT NULL AND currency_id IS NOT NULL GROUP BY currency_id", $affiliate_id, AFFILIATES_REFERRAL_STATUS_REJECTED );

				

				//print_r($acceptedrecord);
				$IXAP34 .= '<div class="accepted_payments"><p class="heading_tables">Accepted Referrals Payment '.$IXAP34j.'</p>';
				$IXAP34 .= '<div class="table-responsive Accepted_comission">';				
				$IXAP34 .= '<table class="table tabular table-striped" cellspacing="0">'; 
				$IXAP34 .= '<thead>'; 
				$IXAP34 .= '<tr>'; 

				$IXAP34 .= "<th scope='col' class='Order'>" . __( 'Order No.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Date'>" . __( 'Date', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Item'>" . __( 'Item', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Amount'>" . __( 'Amount', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Currency'>" . __( 'Currency', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>";
				$IXAP34 .= "<th scope='col' class='Status'>" . __( 'Status', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= '</tr>'; 
				$IXAP34 .= '</thead>'; 
				$IXAP34 .= '<tbody>'; 
				if ( $acceptedrecord ) 
				{
					foreach ( $acceptedrecord as $jss ) 
					{ 
						$IXAP34 .= '<tr>'; 
						$IXAP34 .= "<td class='total accepted'>#$jss->post_id</td>";
						$order_id  = $jss->post_id;
						global $wpdb;
			            $result = $wpdb->get_results('SELECT order_item_name FROM hp_woocommerce_order_items where order_id='.$order_id);

						$dted = new DateTime($jss->datetime);
						$datedd = $dted->format('d/m/Y');
						$IXAP34 .= "<td class='amount'>$datedd</td>"; 
						$IXAP34 .= "<td class='currency'>".$result[0]->order_item_name."</td>";
						$IXAP34 .= "<td class='currency'>$jss->amount</td>";
						$IXAP34 .= "<td class='currency'>$jss->currency_id</td>";
						$IXAP34 .= "<td class='total accepted'>" . __( 'Accepted', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; 
						$IXAP34 .= '</tr>'; 
					} 				
				}
				else
				{
					$IXAP34 .= '<tr class="center">'; 
					$IXAP34 .= "<td colspan='6' style='text-align:center;'>No results to display.</td>"; 
					$IXAP34 .= '</tr>'; 
				}

				$IXAP34 .= '</tbody>'; 
				$IXAP34 .= '</table>';
				$IXAP34 .= '</div>'; 

				if ( $show_totals_accepted ) 
				{ 
					if ( count( $IXAP257 ) == 0 )
					{ 
						$IXAP257[] = (object) array( 'total' => '--', 'currency_id' => '--' ); 
					} 
					foreach ( $IXAP257 as $IXAP23 ) 
					{ 
						$IXAP34 .= '<div>'; 
						$IXAP34 .= "<div class='total_count'>"; 
						$IXAP34 .= "<div class='get_total'>";
						$IXAP34 .= "<p>TOTAL</p>";
						$IXAP34 .= "</div>";
						$IXAP34 .= "<p>$IXAP23->total $IXAP23->currency_id</p>"; 
						$IXAP34 .= "</div>"; 
						$IXAP34 .= '</div>'; 
					} 
				}
				else{
					$IXAP34 .= '<div>'; 
					$IXAP34 .= "<div class='total_count'>"; 
					$IXAP34 .= "<div class='get_total'>";
					$IXAP34 .= "<p>TOTAL</p>";
					$IXAP34 .= "</div>";
					$IXAP34 .= "<p>-- --</p>"; 
					$IXAP34 .= "</div>"; 
					$IXAP34 .= '</div>'; 
				}
				$IXAP34 .= '</div>';				

				//print_r($acceptedpending);

				$IXAP34 .= '<div class="pending_payments"> <p class="heading_tables">Pending Referrals Payment '.$IXAP34j.'</p>';
				$IXAP34 .= '<div class="table-responsive closed_comission">';				
				$IXAP34 .= '<table class="table tabular table-striped" cellspacing="0">'; 
				$IXAP34 .= '<thead>'; 
				$IXAP34 .= '<tr>'; 

				$IXAP34 .= "<th scope='col' class='Order'>" . __( 'Order No.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Date'>" . __( 'Date', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Item'>" . __( 'Item', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Amount'>" . __( 'Amount', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Currency'>" . __( 'Currency', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>";
				$IXAP34 .= "<th scope='col' class='Status'>" . __( 'Status', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= '</tr>'; 
				$IXAP34 .= '</thead>'; 
				$IXAP34 .= '<tbody>'; 
				if ( $acceptedpending ) 
				{ 	
					foreach ( $acceptedpending as $jsspending ) 
					{ 
						$IXAP34 .= '<tr>'; 
						$IXAP34 .= "<td class='total closed'>#$jsspending->post_id</td>";
						$order_id  = $jsspending->post_id;
						global $wpdb;
			            $result = $wpdb->get_results('SELECT order_item_name FROM hp_woocommerce_order_items where order_id='.$order_id);

						$dted = new DateTime($jsspending->datetime);
						$datedd = $dted->format('d/m/Y');
						$IXAP34 .= "<td class='amount'>$datedd</td>"; 
						$IXAP34 .= "<td class='currency'>".$result[0]->order_item_name."</td>";
						$IXAP34 .= "<td class='currency'>$jsspending->amount</td>";
						$IXAP34 .= "<td class='currency'>$jsspending->currency_id</td>";
						$IXAP34 .= "<td class='total closed'>" . __( 'Pending', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; 
						$IXAP34 .= '</tr>'; 
					} 				
				}			
				else
				{ 					
					$IXAP34 .= '<tr>'; 
					$IXAP34 .= "<td colspan='6' style='text-align:center;'>No results to display.</td>"; 
					$IXAP34 .= '</tr>';  
				} 

				$IXAP34 .= '</tbody>'; 
				$IXAP34 .= '</table>';
				$IXAP34 .= '</div>'; 

				if ( $acceptedpendingtotal ) 
				{ 
					if ( count( $acceptedpendingtotal ) == 0 ) 
					{ 
						$acceptedpendingtotal[] = (object) array( 'total' => '--', 'currency_id' => '--' ); 
					} 
					foreach ( $acceptedpendingtotal as $IXAP23 ) 
					{ 
						$IXAP34 .= '<div>'; 
						$IXAP34 .= "<div class='total_count'>"; 
						$IXAP34 .= "<div class='get_total'>";
						$IXAP34 .= "<p>TOTAL</p>";
						$IXAP34 .= "</div>";
						$IXAP34 .= "<p>$IXAP23->total $IXAP23->currency_id</p>"; 
						$IXAP34 .= "</div>"; 
						$IXAP34 .= '</div>'; 
					} 
				}
				else{
					$IXAP34 .= '<div>'; 
					$IXAP34 .= "<div class='total_count'>"; 
					$IXAP34 .= "<div class='get_total'>";
					$IXAP34 .= "<p>TOTAL</p>";
					$IXAP34 .= "</div>";
					$IXAP34 .= "<p>-- --</p>"; 
					$IXAP34 .= "</div>"; 
					$IXAP34 .= '</div>'; 
				}
				$IXAP34 .= '</div>';

				//print_r($acceptedrejected);
				$IXAP34 .= '<div class="rejected_payments"> <p class="heading_tables">Rejected Referrals Payment '.$IXAP34j.'</p>';
				$IXAP34 .= '<div class="table-responsive closed_comission">';				
				$IXAP34 .= '<table class="table tabular table-striped" cellspacing="0">'; 
				$IXAP34 .= '<thead>'; 
				$IXAP34 .= '<tr>'; 

				$IXAP34 .= "<th scope='col' class='Order'>" . __( 'Order No.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Date'>" . __( 'Date', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Item'>" . __( 'Item', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Amount'>" . __( 'Amount', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Currency'>" . __( 'Currency', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>";
				$IXAP34 .= "<th scope='col' class='Status'>" . __( 'Status', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= '</tr>'; 
				$IXAP34 .= '</thead>'; 
				$IXAP34 .= '<tbody>'; 
				if ( $acceptedrejected ) 
				{ 	
					foreach ( $acceptedrejected as $jssrejected ) 
					{ 
						$IXAP34 .= '<tr>'; 
						$IXAP34 .= "<td class='total rejected'>#$rejected->post_id</td>";
						$order_id  = $rejected->post_id;
						global $wpdb;
			            $result = $wpdb->get_results('SELECT order_item_name FROM hp_woocommerce_order_items where order_id='.$order_id);

						$dted = new DateTime($rejected->datetime);
						$datedd = $dted->format('d/m/Y');
						$IXAP34 .= "<td class='amount'>$datedd</td>"; 
						$IXAP34 .= "<td class='currency'>".$result[0]->order_item_name."</td>";
						$IXAP34 .= "<td class='currency'>$rejected->amount</td>";
						$IXAP34 .= "<td class='currency'>$rejected->currency_id</td>";
						$IXAP34 .= "<td class='total rejected'>" . __( 'Rejected', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; 
						$IXAP34 .= '</tr>'; 
					} 				
				}			
				else
				{ 					
					$IXAP34 .= '<tr>'; 
					$IXAP34 .= "<td colspan='6' style='text-align:center;'>No results to display.</td>"; 
					$IXAP34 .= '</tr>';  
				} 

				$IXAP34 .= '</tbody>'; 
				$IXAP34 .= '</table>';
				$IXAP34 .= '</div>'; 

				if ( $acceptedrejectedtotal ) 
				{ 
					if ( count( $acceptedrejectedtotal ) == 0 ) 
					{ 
						$acceptedrejectedtotal[] = (object) array( 'total' => '--', 'currency_id' => '--' ); 
					} 
					foreach ( $acceptedrejectedtotal as $IXAP23 ) 
					{ 
						$IXAP34 .= '<div>'; 
						$IXAP34 .= "<div class='total_count'>"; 
						$IXAP34 .= "<div class='get_total'>";
						$IXAP34 .= "<p>TOTAL</p>";
						$IXAP34 .= "</div>";
						$IXAP34 .= "<p>$IXAP23->total $IXAP23->currency_id</p>"; 
						$IXAP34 .= "</div>"; 
						$IXAP34 .= '</div>'; 
					} 
				}
				else{
					$IXAP34 .= '<div>'; 
					$IXAP34 .= "<div class='total_count'>"; 
					$IXAP34 .= "<div class='get_total'>";
					$IXAP34 .= "<p>TOTAL</p>";
					$IXAP34 .= "</div>";
					$IXAP34 .= "<p>-- --</p>"; 
					$IXAP34 .= "</div>"; 
					$IXAP34 .= '</div>'; 
				}
				$IXAP34 .= '</div>';

				//print_r($acceptedclosed);

				$IXAP34 .= '<div class="closed_payments"> <p class="heading_tables">Closed Referrals Payment '.$IXAP34j.'</p>';
				$IXAP34 .= '<div class="table-responsive closed_comission">';				
				$IXAP34 .= '<table class="table tabular table-striped" cellspacing="0">'; 
				$IXAP34 .= '<thead>'; 
				$IXAP34 .= '<tr>'; 

				$IXAP34 .= "<th scope='col' class='Order'>" . __( 'Order No.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Date'>" . __( 'Date', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Item'>" . __( 'Item', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Amount'>" . __( 'Amount', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='Currency'>" . __( 'Currency', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>";
				$IXAP34 .= "<th scope='col' class='Status'>" . __( 'Status', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= '</tr>'; 
				$IXAP34 .= '</thead>'; 
				$IXAP34 .= '<tbody>'; 
				if ( $acceptedclosed ) 
				{ 	
					foreach ( $acceptedclosed as $jssclosed ) 
					{ 
						$IXAP34 .= '<tr>'; 
						$IXAP34 .= "<td class='total closed'>#$jssclosed->post_id</td>";
						$order_id  = $jssclosed->post_id;
						global $wpdb;
			            $result = $wpdb->get_results('SELECT order_item_name FROM hp_woocommerce_order_items where order_id='.$order_id);

						$dted = new DateTime($jssclosed->datetime);
						$datedd = $dted->format('d/m/Y');
						$IXAP34 .= "<td class='amount'>$datedd</td>"; 
						$IXAP34 .= "<td class='currency'>".$result[0]->order_item_name."</td>";
						$IXAP34 .= "<td class='currency'>$jssclosed->amount</td>";
						$IXAP34 .= "<td class='currency'>$jssclosed->currency_id</td>";
						$IXAP34 .= "<td class='total closed'>" . __( 'Closed', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; 
						$IXAP34 .= '</tr>'; 
					} 				
				}			
				else
				{ 					
					$IXAP34 .= '<tr>'; 
					$IXAP34 .= "<td colspan='6' style='text-align:center;'>No results to display.</td>"; 
					$IXAP34 .= '</tr>';  
				} 

				$IXAP34 .= '</tbody>'; 
				$IXAP34 .= '</table>';
				$IXAP34 .= '</div>'; 

				if ( $show_totals_closed ) 
				{ 
					if ( count( $IXAP259 ) == 0 ) 
					{ 
						$IXAP259[] = (object) array( 'total' => '--', 'currency_id' => '--' ); 
					} 
					foreach ( $IXAP259 as $IXAP23 )
					{ 
						$IXAP34 .= '<div>'; 
						$IXAP34 .= "<div class='total_count'>"; 
						$IXAP34 .= "<div class='get_total'>";
						$IXAP34 .= "<p>TOTAL</p>";
						$IXAP34 .= "</div>";
						$IXAP34 .= "<p>$IXAP23->total $IXAP23->currency_id</p>"; 
						$IXAP34 .= "</div>"; 
						$IXAP34 .= '</div>'; 
					} 
				}
				else{
					$IXAP34 .= '<div>'; 
					$IXAP34 .= "<div class='total_count'>"; 
					$IXAP34 .= "<div class='get_total'>";
					$IXAP34 .= "<p>TOTAL</p>";
					$IXAP34 .= "</div>";
					$IXAP34 .= "<p>-- --</p>"; 
					$IXAP34 .= "</div>"; 
					$IXAP34 .= '</div>'; 
				}
				$IXAP34 .= '</div>'; 


				$IXAP34 .= '<div class="summary_of_result">'; 
				$IXAP34 .= "<div class='total_results'>";
				$IXAP34 .= "<div class='summary_head'>SUMMARY ".$IXAP34j."</div>";				
				
				

				

				$IXAP34 .= '<table class="wp-list-table widefat fixed" cellspacing="0">'; 
				$IXAP34 .= '<thead>'; 
				$IXAP34 .= '<tr>'; 
				$IXAP34 .= "<th scope='col' class='total'>" . __( 'Status', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='amount'>" . __( 'Total amount', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= "<th scope='col' class='currency'>" . __( 'Currency', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</th>"; 
				$IXAP34 .= '</tr>'; 
				$IXAP34 .= '</thead>'; 
				$IXAP34 .= '<tbody>'; 

				if ( $show_totals_accepted ) 
				{ 
					if ( count( $IXAP257 ) == 0 )
					{ 
						$IXAP257[] = (object) array( 'total' => '--', 'currency_id' => '--' ); 
					} 
					foreach ( $IXAP257 as $IXAP23 ) 
					{ 
						$IXAP34 .= '<tr>'; 
						$IXAP34 .= "<td class='total accepted'>" . __( 'Accepted', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; 
						$IXAP34 .= "<td class='amount'>$IXAP23->total</td>"; 
						$IXAP34 .= "<td class='currency'>$IXAP23->currency_id</td>"; 
						$IXAP34 .= '</tr>'; 
					} 
				} 	
				

				if ( $acceptedpendingtotal ) 
				{ 
					if ( count( $acceptedpendingtotal ) == 0 ) 
					{ 
						$acceptedpendingtotal[] = (object) array( 'total' => '--', 'currency_id' => '--' ); 
					} 
					foreach ( $acceptedpendingtotal as $IXAP23 )
					{ 
						$IXAP34 .= '<tr>'; 
						$IXAP34 .= "<td class='total pending'>" . __( 'Pending', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; 
						$IXAP34 .= "<td class='amount'>$IXAP23->total</td>"; 
						$IXAP34 .= "<td class='currency'>$IXAP23->currency_id</td>"; 
						$IXAP34 .= '</tr>'; 
					} 
				}
				else{
					$IXAP34 .= '<tr>'; 
						$IXAP34 .= "<td class='total pending'>" . __( 'Pending', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; 
						$IXAP34 .= "<td class='amount'>--</td>"; 
						$IXAP34 .= "<td class='currency'>--</td>"; 
						$IXAP34 .= '</tr>';
				} 			

				if ( $acceptedrejectedtotal ) 
				{ 
					if ( count( $acceptedrejectedtotal ) == 0 ) 
					{ 
						$acceptedrejectedtotal[] = (object) array( 'total' => '--', 'currency_id' => '--' ); 
					} 
					foreach ( $acceptedrejectedtotal as $IXAP23 ) 
					{ 
						$IXAP34 .= '<tr>'; 
						$IXAP34 .= "<td class='total rejected'>" . __( 'Rejected', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; 
						$IXAP34 .= "<td class='amount'>$IXAP23->total</td>"; 
						$IXAP34 .= "<td class='currency'>$IXAP23->currency_id</td>"; 
						$IXAP34 .= '</tr>'; 
					} 
				} 
				else{
					$IXAP34 .= '<tr>'; 
						$IXAP34 .= "<td class='total pending'>" . __( 'Rejected', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; 
						$IXAP34 .= "<td class='amount'>--</td>"; 
						$IXAP34 .= "<td class='currency'>--</td>"; 
						$IXAP34 .= '</tr>';
				} 

				if ( $show_totals_closed ) 
				{ 
					if ( count( $IXAP259 ) == 0 ) 
					{ 
						$IXAP259[] = (object) array( 'total' => '--', 'currency_id' => '--' ); 
					} 
					foreach ( $IXAP259 as $IXAP23 ) 
					{ 
						$IXAP34 .= '<tr>'; 
						$IXAP34 .= "<td class='total closed'>" . __( 'Closed', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</td>"; 
						$IXAP34 .= "<td class='amount'>$IXAP23->total</td>"; 
						$IXAP34 .= "<td class='currency'>$IXAP23->currency_id</td>"; 
						$IXAP34 .= '</tr>'; 
					} 
				} 

				$IXAP34 .= '</tbody>'; 
				$IXAP34 .= '</table>'; 
				$IXAP34 .= "</div>"; 
				$IXAP34 .= '</div>'; 
			} 

			 

			$IXAP34 .= '</div>'; 

			return $IXAP34; 
		} 
} Affiliates_Stats_Renderer_WordPress::init();