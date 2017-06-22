<?php
/*
Copyright (c) 2016 Designs and Codes

Permission is hereby granted, free of charge, to any person obtaining a copy 
of this software and associated documentation files (the "Software"), to deal 
in the Software without restriction, including without limitation the rights 
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell 
copies of the Software, and to permit persons to whom the Software is 
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in 
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE 
SOFTWARE.
*/

/**
 * Enables manual ordering/reordering of post-types based on their built-in menu_order field, as-well-as the necessary admin controls to perform said reordering
 */
class DNC_PostTypeRank{
	const FORMAT_ACTION = '%s_dnc_rank_change';
	const FORMAT_NONCE_NAME = 'nonce-%s-dnc-rank';
	
	const RESPONSE_SUCCESS = 'success';
	const RESPONSE_NEEDS_REFRESH = 'needs-refresh';
	const RESPONSE_BAD_DATA = 'bad-data';
	
	private /* string */ $postType;
	private /* string */ $labelPromoteColumn;
	private /* string */ $labelDemoteColumn;
	private /* string */ $labelRankColumn;
	private /* string */ $labelPromoteButton;
	private /* string */ $labelDemoteButton;
	
	private /* string */ $action;
	private /* string */ $nonceName;
	private /* bool */ $needed = false;
	
	private static $gMainLabels = array(
		'promote' => 'labelPromoteColumn',
		'demote' => 'labelDemoteColumn',
		'rank' => 'labelRankColumn',
	);
	
	private static $gMinorLabels = array(
		'promote-button' => array(
			'prop' => 'labelPromoteButton',
			'default' => 'labelPromoteColumn',
		),
		'demote-button' => array(
			'prop' => 'labelDemoteButton',
			'default' => 'labelDemoteColumn',
		),
	);
	
	private function __construct( $postType, array $labels ){
		$this->postType = $postType;
		
		foreach( self::$gMainLabels as $key => $prop )
			$this->$prop = isset( $labels[ $key ] ) ? (string)$labels[ $key ] : mb_convert_case( $key, MB_CASE_TITLE );
		
		foreach( self::$gMinorLabels as $key => $tmp ){
			extract( $tmp, EXTR_OVERWRITE );
			$this->$prop = isset( $labels[ $key ] ) ? (string)$labels[ $key ] : $this->$default;
		} // foreach $key => $prop
		
		$this->action = sprintf( self::FORMAT_ACTION, $postType );
		$this->action = sprintf( self::FORMAT_NONCE_NAME, $postType );
	} // method DNC_PostTypeRank::__construct
	
	public function actionPreGetPosts( WP_Query $query ){
		if( !( $query->is_main_query() && ( $this->postType === $query->get( 'post_type' ) ) ) )
			return;
		
		if( '' === $query->get( 'orderby' ) ){
			$query->set( 'orderby', 'menu_order' );
			$query->set( 'order', ( ( 'ASC' === $query->get( 'order' ) ) ? 'DESC' : 'ASC' ) ); // Invert order so lowest menu_order is by default first
		} // endif '' === $query->get( 'orderby' )
	} // method DNC_PostTypeRank::actionPreGetPosts
	
	public function actionManagePostsCustomColumn( $columnID, $postID ){
		switch( $columnID ){
			default:
				return;
			case 'dnc-rank':
				$post = get_post( $postID );
?>
<span class="dnc-rank-value"><?php echo $post->menu_order; ?></span>
<?php
				return;
			case 'dnc-rank-promote':
				$title = $this->labelPromoteButton;
				$dashicon = 'dashicons-plus';
				break;
			case 'dnc-rank-demote':
				$title = $this->labelDemoteButton;
				$dashicon = 'dashicons-minus';
				break;
		} // switch $columnID
?>
<a href="#" class="<?php echo $columnID; ?>-link" title="<?php echo esc_attr( $title ); ?>"><span class="dashicons <?php echo $dashicon; ?>"></span></a>
<?php
	} // method DNC_PostTypeRank::actionManagePostsCustomColumn
	
	public function actionAdminHead(){
?>
<style type="text/css">
	.fixed .column-dnc-rank-demote,
	.fixed .column-dnc-rank-promote {
		width: 6%;
	}
	
	.fixed .column-dnc-rank {
		width: 4%;
	}
	
	.hentry.type-<?php echo $this->postType; ?>:last-child .dnc-rank-demote-link,
	.hentry.type-<?php echo $this->postType; ?>:first-child .dnc-rank-promote-link {
		display: none;
	}
	
	#wpwrap.dnc-disabled:before {
		content: ' ';
		position: absolute;
		z-index: 99999;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: #888;
		opacity: 0.5;
	}
</style>
<?php
	} // method DNC_PostTypeRank::actionAdminHead
	
	public function actionAdminFooter(){
		if( !( $this->needed && wp_script_is( 'jquery', 'done' ) ) )
			return;
		
		$nonceValue = wp_create_nonce( $this->nonceName );
?>
<script type="text/javascript">
	/* <![CDATA[ */
	;
	if( 'function' === typeof window.jQuery ){
		window.jQuery( function( $ ){
			"use strict";
			
			var DEFAULTS = {
				'action': '<?php echo $this->action; ?>',
				'nonce': '<?php echo $nonceValue; ?>',
			};
			
			var ROW_SELECTOR = '.type-<?php echo $this->postType; ?>';
			
			var DIRECTIONS = [ 'next', 'prev' ];
			
			var $root = $( '#wpwrap' );
			
			function $rankOf( $row ){
				return $row.find( '.dnc-rank-value' );
			} // function $rankOf
			
			function rankOf( $rank ){
				return parseInt( $rank.text() );
			} // function rankOf
			
			function idOf( $row ){
				var regs = /post-(\d+)/.exec( $row.attr( 'id' ) );
				
				return ( null === regs ) ? null : regs[ 1 ];
			} // function idOf
			
			function doSwap( $aRow, $bRow ){
				var $aRank = $rankOf( $aRow );
				var aRank = rankOf( $aRank );
				var $bRank = $rankOf( $bRow );
				var bRank = rankOf( $bRank );
				
				$aRank.text( bRank );
				$bRank.text( aRank );
				$aRow[ ( 0 !== ( $aRow.get( 0 ).compareDocumentPosition( $bRow.get( 0 ) ) & Node.DOCUMENT_POSITION_PRECEDING ) ) ? 'insertBefore' : 'insertAfter' ]( $bRow );
			} // function doSwap
			
			function findThatRow( $row, rank, desiredSignum ){
				var arr = $.map( DIRECTIONS, function( prop ){
					var $testRow = $row[ prop ]( ROW_SELECTOR );
					
					if( 0 === $testRow.length )
						return false;
					
					return ( Math.sign( rankOf( $rankOf( $testRow ) ) - rank ) === desiredSignum ) ? $testRow : false;
				} );
				
				// arr will have at-most-one non-false element
				for( var i = arr.length - 1; i >= 0; --i )
					if( arr[ i ] )
						return arr[ i ];
				
				return false;
			} // function findThatRow
			
			function removeDisabled(){
				$root.removeClass( 'dnc-disabled' );
			} // function removeDisabled
			
			function createHandler( verb ){
				var desiredSignum = ( 'promote' === verb ) ? -1 : 1;
				
				return function( e ){
					e.preventDefault();
					
					var $thisRow = $( e.target ).parents( ROW_SELECTOR ).first();
					var thisRank = rankOf( $rankOf( $thisRow ) );
					var thisID = idOf( $thisRow );
					
					if( null === thisID )
						return;
					
					var $thatRow = findThatRow( $thisRow, thisRank, desiredSignum );
					if( !$thatRow )
						return;
					
					var thatID = idOf( $thatRow );
					if( null === thatID )
						return;
					
					$root.addClass( 'dnc-disabled' );
					
					$.post( ajaxurl, $.extend( {
						'thisID': thisID,
						'thatID': thatID,
						'signum': desiredSignum,
					}, DEFAULTS ), function( response ){
						switch( response ){
							case '<?php echo self::RESPONSE_SUCCESS; ?>':
								doSwap( $thisRow, $thatRow );
								break;
							case '<?php echo self::RESPONSE_NEEDS_REFRESH; ?>':
							case '<?php echo self::RESPONSE_BAD_DATA; ?>':
							default:
								console.log( response );
								// TODO Signal to user that they need to refresh their page
						} // switch response
					} ).always( removeDisabled );
				};
			} // function createHandler
			
			$root.on( 'click', '*', function( e ){
				if( !$root.hasClass( 'dnc-disabled' ) )
					return;
				
				e.preventDefault();
				e.stopImmediatePropagation();
				return false;
			} );
			
			$( document )
				.on( 'click', '.dnc-rank-promote-link', createHandler( 'promote' ) )
				.on( 'click', '.dnc-rank-demote-link', createHandler( 'demote' ) )
			;
		} );
	} // endif 'function' === typeof window.jQuery
	/* ]]> */
</script>
<?php
	} // method DNC_PostTypeRank::actionAdminFooter
	
	public function actionAjaxRankChange(){
		if( !check_ajax_referer( $this->nonceName, 'nonce', false ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Nonce failure', __CLASS__ ) );
			
			wp_die( self::RESPONSE_BAD_DATA );
		} // endif !check_ajax_referer( $this->nonceName, 'nonce', false )
		
		foreach( array(
			'thisID',
			'thatID',
			'signum',
		) as $var ){
			if( !isset( $_POST[ $var ] ) ){
				if( WP_DEBUG )
					error_log( sprintf( '[%s] Unspecified argument: %s', __CLASS__, $var ) );
				
				wp_die( '0' );
			} // endif !isset( $_POST[ $var ] )
			
			$tmp = $_POST[ $var ];
			if( !is_numeric( $tmp ) ){
				if( WP_DEBUG )
					error_log( sprintf( '[%s] Argument is non-numeric {%s}: %s', __CLASS__, $var, var_export( $tmp, true ) ) );
				
				wp_die( self::RESPONSE_BAD_DATA );
			} // endif !is_numeric( $tmp )
			
			$$var = (int)$tmp;
		} // foreach $var
		
		foreach( array(
			'thisID' => 'thisPost',
			'thatID' => 'thatPost',
		) as $var => $post ){
			$tmp = get_post( $$var );
			if( !( $tmp && ( $this->postType === $tmp->post_type ) ) ){
				if( WP_DEBUG )
					error_log( sprintf( '[%s] Post does not exist, or is of wrong type {%s}: %s', __CLASS__, $this->postType, $$var ) );
				
				wp_die( self::RESPONSE_NEEDS_REFRESH );
			} // endif !( $tmp && ( $this->postType === $tmp->post_type ) )
			
			$$post = $tmp;
		} // foreach $var => $post
		
		$diff = $thatPost->menu_order - $thisPost->menu_order;
		$diff = ( $diff > 0 ) - ( $diff < 0 );
		
		if( $diff !== $signum ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Mis-matched signum: %s; %s; %s', __CLASS__, $thisPost->ID, $thatPost->ID, $signum ) );
			
			wp_die( self::RESPONSE_NEEDS_REFRESH );
		} // endif ( $thatPost->menu_order - $thisPost->menu_order ) !== $signum
		
		wp_update_post( array(
			'ID' => $thisPost->ID,
			'menu_order' => $thatPost->menu_order,
		) );
		
		wp_update_post( array(
			'ID' => $thatPost->ID,
			'menu_order' => $thisPost->menu_order,
		) );
		
		wp_die( self::RESPONSE_SUCCESS );
	} // method DNC_PostTypeRank::actionAjaxRankChange
	
	public function filterManageProjectPostsColumns( array $columns ){
		$this->needed = true;
		
		return array_merge( $columns, array(
			'dnc-rank-promote' => $this->labelPromoteColumn,
			'dnc-rank-demote' => $this->labelDemoteColumn,
			'dnc-rank' => $this->labelRankColumn,
		) );
	} // method DNC_PostTypeRank::filterManageProjectPostsColumns
	
	public function filterInsertPostData( array $slashed, array $sanitized ){
		$postType = $this->postType;
		
		if( isset( $slashed[ 'post_type' ] ) && ( $postType === $slashed[ 'post_type' ] ) && empty( $sanitized[ 'ID' ] ) ){
			global $wpdb;
			$slashed[ 'menu_order' ] = $wpdb->get_var( sprintf( 'select max( menu_order ) + 1 as menu_order from %s where post_type="%s"', $wpdb->posts, $postType ) );
		} // endif isset( $slashed[ 'post_type' ] ) && ( $postType === $slashed[ 'post_type' ] ) && empty( $sanitized[ 'ID' ] )
		
		return $slashed;
	} // method DNC_PostTypeRank::filterInsertPostData
	
	public static function create( $postType, array $labels ){
		static $instances = array();
		
		$postType = (string)$postType;
		
		if( isset( $instances[ $postType ] ) )
			return $instances[ $postType ];
		
		$ret = new self( $postType, $labels );
		
		add_action( 'pre_get_posts', array( $ret, 'actionPreGetPosts' ), 9 );
		add_action( sprintf( 'manage_%s_posts_custom_column', $postType ), array( $ret, 'actionManagePostsCustomColumn' ), 10, 2 );
		add_action( 'admin_head', array( $ret, 'actionAdminHead' ) );
		add_action( 'admin_footer', array( $ret, 'actionAdminFooter' ), 99 );
		add_action( sprintf( 'wp_ajax_%s', $ret->action ), array( $ret, 'actionAjaxRankChange' ) );
		
		add_filter( sprintf( 'manage_%s_posts_columns', $postType ), array( $ret, 'filterManageProjectPostsColumns' ) );
		add_filter( 'wp_insert_post_data', array( $ret, 'filterInsertPostData' ), 10, 2 );
		
		$instances[ $postType ] = $ret;
		
		return $ret;
	} // method DNC_PostTypeRank::create
} // class DNC_PostTypeRank