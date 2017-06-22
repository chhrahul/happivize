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

	
 interface I_Affiliates_Database { public function create_tables( $charset = null, $IXAP219 = null ); public function drop_tables(); public function start_transaction(); public function commit(); public function rollback(); public function get_tablename( $name ); public function get_value( $IXAP3 ); public function get_objects( $IXAP3 ); public function query( $IXAP3 ); } interface I_Affiliates_Affiliate { public static function get_affiliate( $affiliate_id ); public static function get_user_affiliate_id( $user_id = null ); } interface I_Affiliates_Affiliates { } interface I_Affiliates_Affiliate_Profile { } interface I_Affiliates_Attributes { } interface I_Affiliates_Referral { public function add_referrals( $affiliate_ids, $post_id, $IXAP72 = '', $data = null, $IXAP220 = null, $amount = null, $currency_id = null, $status = null, $type = null, $reference = null, $IXAP221 = false ); public function suggest( $post_id, $IXAP72 = '', $data = null, $amount = null, $currency_id = null, $status = null ); public function suggest_by_attribute( $IXAP222, $IXAP223, $post_id, $IXAP72 = '', $data = null, $IXAP220 = null, $amount = null, $currency_id = null, $status = null, $type = null, $IXAP221 = false ); public function update( $IXAP224 ); } interface I_Affiliates_Renderer { const IXAP174 = 'code'; const IXAP172 = 'html'; const TYPE_APPEND = 'append'; const TYPE_AUTO = 'auto'; const TYPE_PARAMETER = 'parameter'; const TYPE_PRETTY = 'pretty'; } interface I_Affiliates_Link_Renderer extends I_Affiliates_Renderer { static function render_affiliate_link( $IXAP24 = array(), $IXAP32 = null ); } interface I_Affiliates_Stats_Renderer extends I_Affiliates_Renderer { const AFFILIATES_STATS_PER_PAGE = 10; const IXAP225 = 3; const STATS_SUMMARY = 'stats-summary'; const STATS_REFERRALS = 'stats-referrals'; static function render_affiliate_stats( $IXAP24 = array() ); } interface I_Affiliates_Traffic_Renderer extends I_Affiliates_Renderer { const AFFILIATES_TRAFFIC_PER_PAGE = 10; const IXAP225 = 3; const IXAP226 = 'traffic-summary'; const IXAP227 = 'traffic-referrals'; static function render_affiliate_traffic( $IXAP24 = array() ); } interface I_Affiliates_Graph_Renderer extends I_Affiliates_Renderer { static function render_graph( $IXAP24 = array() ); static function render_hits( $IXAP24 = array() ); static function render_visits( $IXAP24 = array() ); static function render_referrals( $IXAP24 = array() ); static function render_totals( $IXAP24 = array() ); } interface I_Affiliates_Totals { } interface I_Affiliates_Url_Renderer extends I_Affiliates_Renderer { static function render_affiliate_url( $IXAP24 = array() ); } interface I_Affiliates_Affiliate_Stats_Renderer { const AFFILIATES_STATS_PER_PAGE = 10; } interface I_Affiliates_Validator { static function validate_amount( $amount ); static function validate_email( $IXAP184 ); }