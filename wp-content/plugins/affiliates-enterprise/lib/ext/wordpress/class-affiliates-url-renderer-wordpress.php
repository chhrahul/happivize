<?php
 class Affiliates_Url_Renderer_WordPress extends Affiliates_Url_Renderer 
  {
     const NONCE = 'affiliate-nonce';
     const NONCE_1 = 'affiliate-nonce-1'; 
     const NONCE_2 = 'affiliate-nonce-2'; 
     const NONCE_FILTERS = 'affiliate-nonce-filters'; 

     static function init() 
     { 
          self::$IXAP5 = get_option( 'aff_pname', AFFILIATES_PNAME ); 
          self::$IXAP6 = 'cmid'; 
          self::$IXAP29 = 'affiliates_encode_affiliate_id'; 
          add_shortcode( 'affiliates_affiliate_url', array( 'Affiliates_Url_Renderer_WordPress', 'url_shortcode' ) );
          add_shortcode( 'affiliates_generate_url', array( 'Affiliates_Url_Renderer_WordPress', 'generate_url_shortcode' ) );
     } 

     static function url_shortcode( $IXAP31, $IXAP32 = null ) 
     { 
          $IXAP24 = shortcode_atts( self::$IXAP191, $IXAP31 ); 
          return self::render_affiliate_url( $IXAP24 ); 
     } 

     static function render_affiliate_url( $IXAP24 = array() ) 
     { 
          global $wp_rewrite; $IXAP34 = '';
          if ( !isset( $IXAP24['url'] ) ) 
          { 
               $IXAP24['url'] = get_bloginfo( 'url' );
          }

          $IXAP24['pname'] = get_option( 'aff_pname', AFFILIATES_PNAME );
          $IXAP34 .= parent::render_affiliate_url( $IXAP24, array( 'Affiliates_Affiliate' => 'Affiliates_Affiliate_WordPress', 'affiliate_id_encoder' => 'affiliates_encode_affiliate_id', 'esc_attr' => 'esc_attr', 'use_parameter' => !$wp_rewrite->using_permalinks() ) ); 
          return $IXAP34; 
     } 

     public static function generate_url_shortcode( $IXAP31, $IXAP32 = null ) 
     { 
          $IXAP31 = shortcode_atts( array( 'campaign' => 'no' ), $IXAP31 );
          $IXAP329 = isset( $_POST['generate-url'] ) ? trim( $_POST['generate-url'] ) : '';
          if ( !empty( $IXAP329 ) ) 
          { 
               if ( ( stripos( $IXAP329, 'http://' ) !== 0 ) && ( stripos( $IXAP329, 'https://' ) !== 0 ) ) 
               { 
                    $IXAP329 = 'http://' . $IXAP329; 
               } 
          } 

          $IXAP330 = true;
          if ( !empty( $IXAP329 ) ) 
          { 
               if ( function_exists( 'filter_var' ) ) 
               { 
                    $IXAP330 = filter_var( $IXAP329, FILTER_VALIDATE_URL ) !== false; 
               } 
          } 

          $affiliate_url = !empty( $IXAP329 ) ? self::render_affiliate_url( array( 'url' => $IXAP329, 'type' => self::TYPE_APPEND ) ) : '';

          if ( class_exists( 'Affiliates_Campaign' ) ) 
          {
               if ( !empty( $IXAP329 ) ) 
               { 
                    $IXAP12 = !empty( $_POST['campaign_id'] ) ? intval( $_POST['campaign_id'] ) : null;
                    if ( $IXAP12 ) 
                    { 
	                    if ( $affiliate_ids = affiliates_get_user_affiliate( get_current_user_id() ) ) 
	                    {
	                        if ( $affiliate_id = array_shift( $affiliate_ids ) ) 
	                        { 
	                            if ( $IXAP10 = Affiliates_Campaign::get_affiliate_campaign( $affiliate_id, $IXAP12 ) ) 
	                            { 
	                                $affiliate_url = $IXAP10->get_url( array( 'url' => $IXAP329 ) );
	                            } 
	                        } 
	                    } 
                    } 
               } 
          }
          $IXAP34 = '';
          $style = apply_filters( 'affiliates_generate_url_style', 'div.generate-field span.field-label { display:block; }' . 'div.generate-field span.field-input { display:block; width:62%; }' . 'div.generate-field span.field-input input { width:100%; }' . 'div.generate-field span.error { display:block; color: #900; }' );

          if ( !empty( $style ) ) 
          {
               $IXAP34 .= '<style type="text/css">'; 
               $IXAP34 .= $style; 
               $IXAP34 .= '</style>';
          } 
          
          $IXAP34 .= '<div class="affiliates-generate-url check_exists">';
          $current_user = wp_get_current_user();
          $IXAP34 .= '<div class="table_alignment">';
		  $IXAP34 .= '<span class="field-label">Who is driving the traffic:</span>';
		  $IXAP34 .= '<select class="login_user" name="affiliate_log">';
			 $IXAP34 .= sprintf( '<option value="%s" />%s %s</option>', $current_user->user_login, $current_user->user_firstname,$current_user->user_lastname );
		  $IXAP34 .= '</select>';
		  $IXAP34 .= '</div>';

		  $params = array('posts_per_page' => 99, 'post_type' => 'product', 'post_status' => array('publish'));
		  $wc_query = new WP_Query($params);
		  if ($wc_query->have_posts()) {
		  $IXAP34 .= '<div class="select-urls-wrap pages-linkss table_alignment">';
		  $IXAP34 .= '<span class="field-label">Where are you driving traffic to:</span>';
		  $IXAP34 .= '<select id="posts_urlss" class="posts_urlss" name="posts_urlss" onchange="geturlvalue()">';
		  
		  /* menu Link */
		  $current_menu = 'primary';
			$array_menu = wp_get_nav_menu_items($current_menu);
		    $menu = array();				   
			 
		    foreach ($array_menu as $m) {
		        if (empty($m->menu_item_parent)) {

		            $menu[$m->ID] = array();
		            $menu[$m->ID]['ID']      =   $m->ID;
		            $menu[$m->ID]['title']   =   $m->title;
		            $menu[$m->ID]['url']     =   $m->url;

		            $IXAP34 .= sprintf( '<option value="%s" />%s</option>', $m->url, $m->title);

				}
		    }
            /* menu Link */
	   		while ($wc_query->have_posts()) {
            $wc_query->the_post();
            $permalinks = get_permalink( $post->ID );
            $posttitle = get_the_title( $post->ID );
		                 
			$IXAP34 .= sprintf( '<option value="%s" />%s</option>', $permalinks, $posttitle);

			}

			$IXAP34 .= '</select>';
			$IXAP34 .= '</div>'; 
		  wp_reset_postdata();
		  } else{  ?>
		  <p> <?php _e( 'No Products'); ?></p>
		  <?php } 


          $IXAP34 .= '<form action="" method="post">'; 
          $IXAP34 .= '<div>'; 
          $IXAP34 .= '<div class="generate-field generate-url">'; 
          $IXAP34 .= '<label>'; 
          $IXAP34 .= '<!--span class="field-label hiddenfield">'; 
          $IXAP34 .= __( 'Page URL', AFFILIATES_PRO_PLUGIN_DOMAIN ); 
          $IXAP34 .= '</span-->'; 
          $IXAP34 .= sprintf( '<span class="error" style="%s">', 
          	$IXAP330 ? 'display:none;' : '' );
          $IXAP34 .= __( 'Please enter a valid URL.', AFFILIATES_PRO_PLUGIN_DOMAIN ); 
          $IXAP34 .= '</span>'; 
          $IXAP34 .= '<span class="field-input">'; 
          $IXAP34 .= sprintf( '<input id="generated_url" type="hidden" name="generate-url" value="%s" />', $IXAP329 ); 
          $IXAP34 .= '</span>'; 
          $IXAP34 .= '</label>'; 
          $IXAP34 .= '</div>'; 
          if ( class_exists( 'Affiliates_Campaign' ) && isset( $IXAP31['campaign'] ) && strtolower( $IXAP31['campaign'] ) == 'yes' ) 
          { 
               if ( $affiliate_ids = affiliates_get_user_affiliate( get_current_user_id() ) ) 
               { 
          	    if ( $affiliate_id = array_shift( $affiliate_ids ) ) 
                    { 
                         $IXAP25 = Affiliates_Campaign::get_campaigns( $affiliate_id );
                         if ( !empty( $IXAP25 ) ) 
                         { 
                              $selected_campaign_id = null; 
                              $IXAP12 = !empty( $_POST['campaign_id'] ) ? intval( $_POST['campaign_id'] ) : null; 
          	              if ( $IXAP12 ) 
                             {
          	                    if ( $IXAP10 = Affiliates_Campaign::get_affiliate_campaign( $affiliate_id, $IXAP12 ) ) 
                                   {
               	                   $selected_campaign_id = $IXAP10->campaign_id; 
                                   } 
                              } 
     	                   $IXAP34 .= '<div class="generate-field campaign">';
     	                   $IXAP34 .= '<label>'; 
     	                   $IXAP34 .= '<span class="field-label">'; 
     	                   $IXAP34 .= __( 'Campaign', AFFILIATES_PRO_PLUGIN_DOMAIN ); 
     	                   $IXAP34 .= '</span>'; 
     	                   $IXAP34 .= '<select name="campaign_id">'; 
     	                   $IXAP34 .= '<option value="">&mdash;</option>'; 
     	                   foreach( $IXAP25 as $IXAP10 ) { 
     	                   	   $IXAP34 .= sprintf( '<option value="%d" %s>%s</option>', intval( $IXAP10->campaign_id ), $selected_campaign_id !== null && $IXAP10->campaign_id == $selected_campaign_id ? ' selected="selected" ' : '', esc_html( stripslashes( $IXAP10->name ) ) ); 
     	                   	} 
     	                   	   $IXAP34 .= '</select>'; 
     	                   	   $IXAP34 .= '</label>'; 
     	                   	   $IXAP34 .= '</div>'; 
                         }
                    } 
          	} 
          } 



          
          $IXAP34 .= '<div class="generate-button">'; 
          $IXAP34 .= sprintf( '<input class="generate-link-btn" type="submit" name="generate" value="%s" />', __( 'Generate link', AFFILIATES_PRO_PLUGIN_DOMAIN ) ); 
          $IXAP34 .= '</div>';
          $IXAP34 .= '<div class="generate-field affiliate-url">'; 
          $IXAP34 .= '<label>'; 
          $IXAP34 .= '<!--span class="field-label hiddenfield">'; 
          $IXAP34 .= __( 'Affiliate URL', AFFILIATES_PRO_PLUGIN_DOMAIN ); 
          $IXAP34 .= '</span-->'; 
          $IXAP34 .= '<span class="field-input">';
          $IXAP34 .= sprintf('<a href="%s" target="_blank">%s</a>',$affiliate_url, $affiliate_url); 
          $IXAP34 .= sprintf( '<input type="hidden" name="affiliate-url" value="%s" readonly="readonly" />', $affiliate_url ); 
          $IXAP34 .= '</span>'; 
          $IXAP34 .= '</label>'; 
          $IXAP34 .= '</div>';  
          $IXAP34 .= '</div>'; 
          $IXAP34 .= '</form>'; 
          $IXAP34 .= '</div>'; 
          return $IXAP34; 
     } 
} Affiliates_Url_Renderer_WordPress::init();