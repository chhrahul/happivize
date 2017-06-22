<?php
if (!defined('ABSPATH'))
    die('No direct access allowed');

global $WOOF;
 $condition = 'closed';
        $toggle_type = ((isset($WOOF->settings['toggle_type']) AND ! empty($WOOF->settings['toggle_type'])) ? $WOOF->settings['toggle_type'] : 'text'); 
if (isset($WOOF->settings['by_rating']) AND $WOOF->settings['by_rating']['show'])
{
    ?>
    <div data-css-class="woof_by_rating_container" class="woof_by_rating_container woof_container">
        <div class="woof_container_overlay_item"></div>
        <div class="woof_container_inner">
            
            <h4>Filter by rating            
               <?php
               if ($block_is_closed)
                    {
                        $toggle_text = ((isset($WOOF->settings['toggle_closed_text']) AND ! empty($WOOF->settings['toggle_closed_text'])) ? self::wpml_translate(null, $WOOF->settings['toggle_closed_text']) : '-');
                        $toggle_image = ((isset($WOOF->settings['toggle_closed_image']) AND ! empty($WOOF->settings['toggle_closed_image'])) ? $WOOF->settings['toggle_closed_image'] : WOOF_LINK . 'img/plus3.png');
                    } else
                    {
                        $toggle_text = ((isset($WOOF->settings['toggle_opened_text']) AND ! empty($WOOF->settings['toggle_opened_text'])) ? self::wpml_translate(null, $WOOF->settings['toggle_opened_text']) : '+');
                        $toggle_image = ((isset($WOOF->settings['toggle_opened_image']) AND ! empty($WOOF->settings['toggle_opened_image'])) ? $WOOF->settings['toggle_opened_image'] : WOOF_LINK . 'img/minus3.png');
                        $condition = 'opened';
                    }



                    if ($toggle_type == 'text' OR empty($toggle_image))
                    {
                        ?>
                        <a href="javascript: void(0);" title="<?php _e('toggle', 'woocommerce-products-filter') ?>" class="woof_front_toggle woof_front_toggle_<?php echo $condition ?>" data-condition="<?php echo $condition ?>"><?php echo $toggle_text ?></a>
                        <?php
                    } else
                    {
                        ?>
                        <a href="javascript: void(0);" title="<?php _e('toggle', 'woocommerce-products-filter') ?>" class="woof_front_toggle woof_front_toggle_<?php echo $condition ?>" data-condition="<?php echo $condition ?>">
                            <img src="<?php echo $toggle_image ?>" alt="<?php _e('toggle', 'woocommerce-products-filter') ?>" />
                        </a>
                        <?php
                    }
               ?>
            </h4>
            <div class="woof_block_html_items">
                <ul class="woof_by_rating_dropdown woof_select" name="min_rating">
                <!--?php $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; echo $url; ?-->
                    <?php
                    $vals = array(
                        // 0 => __('Filter by rating', 'woocommerce-products-filter'),
                        4 => __('4 Star', 'woocommerce-products-filter'),
                        3 => __('3 Star', 'woocommerce-products-filter'),
                        2 => __('2 Star', 'woocommerce-products-filter'),
                        1 => __('1 Star', 'woocommerce-products-filter')
                    );
                    $request = $WOOF->get_request_data();
                    $selected = $WOOF->is_isset_in_request_data('min_rating') ? $request['min_rating'] : 0;
                    ?>
                    <?php foreach ($vals as $key => $value): ?>
                        <li class="refinementImage" style="margin-left: -2px">
                            <a href="<?php echo site_url(); ?>/shop/?swoof=1&paged=1&min_rating=<?php echo $key ?>">
                                <i class="a-icon a-icon-star a-star-<?php echo $key ?>">
                                    <span class="a-icon-alt">
                                        <?php echo $value ?>
                                    </span>
                                </i>
                                <span class="refinementLink"> 
                                    & Up
                                </span>
                            </a>
                        </li>
                        <!--option class="rating<?php echo $key ?>" <?php echo selected($selected, $key); ?> value="<?php echo $key ?>"><?php echo $value ?></option--> 

                    <?php endforeach; ?>
                </ul>
            </div>
            
           <!-- https://happivize.com/shop/?swoof=1&min_rating=3&paged=1
            https://happivize.com/shop/?swoof=1&paged=1&min_rating=2
            https://happivize.com/shop/?swoof=1&paged=1&min_rating=1
            https://happivize.com/shop/?swoof=1&paged=1&min_rating=4 -->
        </div>
    </div>
    <!--style>
        ul.woof_by_rating_dropdown.woof_select {
            padding-left: 10px;
        }
        li.refinementImage {
            height: 25px;
        }
        [class*="a-icon-star"] > .a-icon-alt {
            font-size: inherit;
            height: 100%;
            left: auto;
            line-height: normal;
            opacity: 0;
            width: 100%;
        }
        .a-icon-alt {
            display: block;
            overflow: hidden;
            position: absolute;
            top: auto;
        }
        .a-star-4 {
            background-position: -21px -368px;
        }
        .a-star-3 {
            background-position: -37px -368px;
        }
        .a-star-2 {
            background-position: -53px -368px;
        }
        .a-star-1 {
            background-position: -69px -368px;
        }
        .a-icon-star {
            height: 18px;
            width: 80px;
        }
        .a-icon-star, .a-icon-star-medium, .a-icon-star-mini, .a-icon-star-small {
            position: relative;
            vertical-align: text-top;
        }
        .a-icon, .a-link-emphasis::after {
            background-image: url("https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIBaseCSS-sprite_1x-28bd59af93d9b1c745bb0aca4de58763b54df7cf._V2_.png");
            background-repeat: no-repeat;
            background-size: 400px 670px;
            display: inline-block;
        }
    </style-->
    <?php
}


