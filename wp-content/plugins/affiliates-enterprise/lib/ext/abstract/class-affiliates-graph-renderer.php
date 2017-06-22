<?php
	
/**
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 * 
 * This code is provided subject to the license granted.
 *
 * UNAUTHORIZED USE AND DISTRIBUTION IS PROHIBITED.
 *
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * This header and all notices must be kept intact.
 */

	
 abstract class Affiliates_Graph_Renderer implements I_Affiliates_Graph_Renderer { protected static $IXAP134 = array( 'from_date' => null, 'thru_date' => null, 'days_back' => null, 'interval' => null, 'legend' => true, 'render' => 'graph' ); protected static $IXAP83; protected static $IXAP135 = 7; protected static $IXAP136 = 7; protected static $IXAP137 = 1100; public static function init() { self::$IXAP83 = date( 'Y-m-d', time() ); } static function render_graph( $IXAP24 = array() ) { global $affiliates_db, $affiliate_graph_count; $affiliate_graph_count++; self::init(); $IXAP34 = ''; $affiliate_id = Affiliates_Affiliate_WordPress::get_user_affiliate_id(); if ( $affiliate_id === false ) { return $IXAP34; } $interval = isset( $IXAP24['interval'] ) && ( $IXAP24['interval'] !== null ) ? $IXAP24['interval'] : null; $IXAP138 = isset( $IXAP24['render'] ) ? $IXAP24['render'] : self::$IXAP134['render']; switch( $IXAP138 ) { case 'graph' : case 'hits' : case 'visits' : case 'referrals' : case 'accepted' : case 'closed' : case 'pending' : case 'rejected' : break; default : $IXAP138 = self::$IXAP134['render']; } $IXAP139 = isset( $IXAP24['legend'] ) && ( ( $IXAP24['legend'] === true ) || ( $IXAP24['legend'] === 'true' ) ); if ( $IXAP139 ) { $show_legend = 'true'; } else { $show_legend = 'false'; } $IXAP140 = isset( $IXAP24['days_back'] ) && ( $IXAP24['days_back'] !== null ) ? $IXAP24['days_back'] : self::$IXAP136; if ( $IXAP140 < self::$IXAP136 ) { $IXAP140 = self::$IXAP136; } if ( $IXAP140 > self::$IXAP137 ) { $IXAP140 = self::$IXAP137; } $IXAP15 = isset( $IXAP24['from_date'] ) && ( $IXAP24['from_date'] !== null ) ? $IXAP24['from_date'] : null; $IXAP16 = isset( $IXAP24['thru_date'] ) && ( $IXAP24['thru_date'] !== null ) ? $IXAP24['thru_date'] : null; switch( $interval ) { case 'month' : $IXAP15 = date( 'Y-m-d', strtotime( 'first day of' ) ); $IXAP16 = date( 'Y-m-d', strtotime( 'last day of' ) ); $IXAP140 = 1 + ( strtotime( $IXAP16 ) - strtotime( $IXAP15 ) ) / ( 3600 * 24 ); break; case 'year' : $IXAP15 = date( 'Y-m-d', strtotime( 'first day of January' ) ); $IXAP16 = date( 'Y-m-d', strtotime( 'last day of December' ) ); $IXAP140 = 1 + ( strtotime( $IXAP16 ) - strtotime( $IXAP15 ) ) / ( 3600 * 24 ); break; } if ( empty( $IXAP16 ) ) { $IXAP16 = self::$IXAP83; } if ( empty( $IXAP15 ) ) { $IXAP15 = date( 'Y-m-d', strtotime( $IXAP16 ) - $IXAP140 * 3600 * 24 ); } $affiliates_table = $affiliates_db->get_tablename( 'affiliates' ); $IXAP18 = $affiliates_db->get_tablename( 'hits' ); $referrals_table = $affiliates_db->get_tablename( 'referrals' ); $IXAP3 = "SELECT date, sum(count) as hits FROM $IXAP18 WHERE date >= %s AND date <= %s AND affiliate_id = %d GROUP BY date"; $IXAP141 = $affiliates_db->get_objects( $IXAP3, $IXAP15, $IXAP16, intval( $affiliate_id ) ); $IXAP142 = array(); foreach( $IXAP141 as $IXAP143 ) { $IXAP142[$IXAP143->date] = $IXAP143->hits; } $IXAP3 = "SELECT count(DISTINCT IP) visits, date FROM $IXAP18 WHERE date >= %s AND date <= %s AND affiliate_id = %d GROUP BY date"; $IXAP144 = $affiliates_db->get_objects( $IXAP3, $IXAP15, $IXAP16, intval( $affiliate_id ) ); $IXAP145 = array(); foreach( $IXAP144 as $IXAP146 ) { $IXAP145[$IXAP146->date] = $IXAP146->visits; } $IXAP3 = "SELECT count(referral_id) referrals, date(datetime) date FROM $referrals_table WHERE status = %s AND date(datetime) >= %s AND date(datetime) <= %s AND affiliate_id = %d GROUP BY date"; $IXAP26 = $affiliates_db->get_objects( $IXAP3, AFFILIATES_REFERRAL_STATUS_ACCEPTED, $IXAP15, $IXAP16, intval( $affiliate_id ) ); $IXAP147 = array(); foreach( $IXAP26 as $IXAP11 ) { $IXAP147[$IXAP11->date] = $IXAP11->referrals; } $IXAP26 = $affiliates_db->get_objects( $IXAP3, AFFILIATES_REFERRAL_STATUS_CLOSED, $IXAP15, $IXAP16, intval( $affiliate_id ) ); $IXAP148 = array(); foreach( $IXAP26 as $IXAP11 ) { $IXAP148[$IXAP11->date] = $IXAP11->referrals; } $IXAP26 = $affiliates_db->get_objects( $IXAP3, AFFILIATES_REFERRAL_STATUS_PENDING, $IXAP15, $IXAP16, intval( $affiliate_id ) ); $IXAP149 = array(); foreach( $IXAP26 as $IXAP11 ) { $IXAP149[$IXAP11->date] = $IXAP11->referrals; } $IXAP26 = $affiliates_db->get_objects( $IXAP3, AFFILIATES_REFERRAL_STATUS_REJECTED, $IXAP15, $IXAP16, intval( $affiliate_id ) ); $IXAP150 = array(); foreach( $IXAP26 as $IXAP11 ) { $IXAP150[$IXAP11->date] = $IXAP11->referrals; } $IXAP151 = array(); $IXAP152 = array(); $IXAP153 = array(); $IXAP154 = array(); $IXAP155 = array(); $IXAP156 = array(); $IXAP157 = array(); $IXAP158 = array(); for ( $IXAP159 = -$IXAP140; $IXAP159 <= 0; $IXAP159++ ) { $IXAP160 = date( 'Y-m-d', strtotime( $IXAP16 ) + $IXAP159 * 3600 * 24 ); $IXAP158[$IXAP159] = $IXAP160; if ( isset( $IXAP147[$IXAP160] ) ) { $IXAP151[] = array( $IXAP159, intval( $IXAP147[$IXAP160] ) ); } if ( isset( $IXAP149[$IXAP160] ) ) { $IXAP152[] = array( $IXAP159, intval( $IXAP149[$IXAP160] ) ); } if ( isset( $IXAP150[$IXAP160] ) ) { $IXAP153[] = array( $IXAP159, intval( $IXAP150[$IXAP160] ) ); } if ( isset( $IXAP148[$IXAP160] ) ) { $IXAP154[] = array( $IXAP159, intval( $IXAP148[$IXAP160] ) ); } if ( isset( $IXAP142[$IXAP160] ) ) { $IXAP155[] = array( $IXAP159, intval( $IXAP142[$IXAP160] ) ); } if ( isset( $IXAP145[$IXAP160] ) ) { $IXAP156[] = array( $IXAP159, intval( $IXAP145[$IXAP160] ) ); } if ( $IXAP140 <= ( self::$IXAP135 + self::$IXAP136 ) ) { $IXAP161 = date( 'm-d', strtotime( $IXAP160 ) ); $IXAP157[] = array( $IXAP159, $IXAP161 ); } else if ( $IXAP140 <= 91 ) { $IXAP162 = date( 'd', strtotime( $IXAP160 ) ); if ( $IXAP162 == '1' || $IXAP162 == '15' ) { $IXAP161 = date( 'm-d', strtotime( $IXAP160 ) ); $IXAP157[] = array( $IXAP159, $IXAP161 ); } } else { if ( date( 'd', strtotime( $IXAP160 ) ) == '1' ) { if ( date( 'm', strtotime( $IXAP160 ) ) == '1' ) { $IXAP161 = '<strong>' . date( 'Y', strtotime( $IXAP160 ) ) . '</strong>'; } else { $IXAP161 = date( 'm-d', strtotime( $IXAP160 ) ); } $IXAP157[] = array( $IXAP159, $IXAP161 ); } } } $IXAP163 = json_encode( $IXAP151 ); $IXAP164 = json_encode( $IXAP152 ); $IXAP165 = json_encode( $IXAP153 ); $IXAP166 = json_encode( $IXAP154 ); $IXAP167 = json_encode( $IXAP155 ); $IXAP168 = json_encode( $IXAP156 ); $span_series_json = json_encode( array( array( intval( -$IXAP140 ), 0 ), array( 0, 0 ) ) ); $IXAP169 = json_encode( $IXAP157 ); $IXAP170 = json_encode( $IXAP158 ); $IXAP107 = isset( $IXAP24['class'] ) ? $IXAP24['class'] : 'affiliate-graph'; $id = isset( $IXAP24['id'] ) ? $IXAP24['id'] : 'affiliate-graph-' . $affiliate_graph_count; $style = isset( $IXAP24['style'] ) ? $IXAP24['style'] : ''; ob_start(); $show_points = $IXAP140 <= 61 ? 'true' : 'false'; ?>
		<div id="<?php echo $id; ?>" class="<?php echo $IXAP107; ?>" style="<?php echo $style; ?>"></div>
		<script type="text/javascript">
			(function($){
				$(document).ready(function(){
					var data = [
						<?php if ( $IXAP138 == 'graph' || $IXAP138 == 'hits' ) : ?>
						{
							label : "<?php _e( 'Hits', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP167; ?>,
							lines : { show : true },
							points : { show : <?php echo $show_points; ?> },
							yaxis : 2,
							color : '#ccddff'
						},
						<?php endif; ?>
						<?php if ( $IXAP138 == 'graph' || $IXAP138 == 'visits' ) : ?>
						{
							label : "<?php _e( 'Visits', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP168; ?>,
							lines : { show : true },
							points : { show : <?php echo $show_points; ?> },
							yaxis : 2,
							color : '#ffddcc'
						},
						<?php endif; ?>
						<?php if ( $IXAP138 == 'graph' || $IXAP138 == 'accepted' || $IXAP138 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Accepted', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP163; ?>,
							color : '#009900',
							bars : { align : "center", show : true, barWidth : 1 },
							hoverable : true,
							yaxis : 1
						},
						<?php endif; ?>
						<?php if ( $IXAP138 == 'graph' || $IXAP138 == 'pending' || $IXAP138 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Pending', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP164; ?>,
							color : '#0000ff',
							bars : { align : "center", show : true, barWidth : 0.6 },
							yaxis : 1
						},
						<?php endif; ?>
						<?php if ( $IXAP138 == 'graph' || $IXAP138 == 'rejected' || $IXAP138 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Rejected', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP165; ?>,
							color : '#ff0000',
							bars : { align : "center", show : true, barWidth : .3 },
							yaxis : 1
						},
						<?php endif; ?>
						<?php if ( $IXAP138 == 'graph' || $IXAP138 == 'closed' || $IXAP138 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Closed', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP166; ?>,
							color : '#333333',
							points : { show : true },
							yaxis : 1
						},
						<?php endif; ?>
						{
							data : <?php echo $span_series_json; ?>,
							lines : { show : false },
							yaxis : 1
						}
					];
	
					var options = {
						xaxis : {
							ticks : <?php echo $IXAP169; ?>
						},
						yaxis : {
							min : 0,
							tickDecimals : 0
						},
						yaxes : [
							{},
							{ position : 'right' }
						],
						grid : {
							hoverable : true
						},
						legend : {
							show : <?php echo $show_legend; ?>,
							position : 'nw'
						}
					};
	
					$.plot($("#<?php echo $id; ?>"),data,options);
	
					function statsTooltip(x, y, contents) {
						var tooltip = $('<div id="<?php echo $id; ?>-tooltip">' + contents + '</div>').css( {
							position: 'absolute',
							display: 'none',
							top: y + 5,
							left: x + 5,
							border: '1px solid #333',
							'border-radius' : '4px',
							padding: '6px',
							'background-color': '#ccc',
							opacity: 0.90
						}).appendTo("body").fadeIn(200);
						if ( tooltip.position().left >= tooltip.parent().width() / 2 ) {
							tooltip.css({left:x-tooltip.outerWidth()});
						}
					}
	
					var tooltipItem = null;
					var statsDates = <?php echo $IXAP170; ?>;
					$("#<?php echo $id; ?>").bind("plothover", function (event, pos, item) {
						if (item) {
							if (tooltipItem === null || item.dataIndex != tooltipItem.dataIndex || item.seriesIndex != tooltipItem.seriesIndex) {
								tooltipItem = item;
								$("#<?php echo $id; ?>-tooltip").remove();
								var x = item.datapoint[0];
									y = item.datapoint[1];
								statsTooltip(
									item.pageX,
									item.pageY,
									item.series.label + " : " + y +  '<br/>' + statsDates[x] 
								);
							}
						} else {
							$("#<?php echo $id;?>-tooltip").remove();
							tooltipItem = null;
						}
					});
				});
			})(jQuery);
		</script>
		<?php
 $IXAP34 .= ob_get_contents(); ob_end_clean(); return $IXAP34; } static function render_hits( $IXAP24 = array() ) { self::init(); $IXAP24['render'] = 'hits'; return self::render_graph( $IXAP24 ); } static function render_visits( $IXAP24 = array() ) { self::init(); $IXAP24['render'] = 'visits'; return self::render_graph( $IXAP24 ); } static function render_referrals( $IXAP24 = array() ) { self::init(); $IXAP24['render'] = 'referrals'; return self::render_graph( $IXAP24 ); } static function render_totals( $IXAP24 = array() ) { self::init(); } } 