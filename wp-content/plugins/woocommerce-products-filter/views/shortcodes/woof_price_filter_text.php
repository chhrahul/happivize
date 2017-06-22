<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$request_data = $this->get_request_data();
$min_price = 1;
$max_price = WOOF_HELPER::get_max_price();

$min_price_txt = __('min price', 'woocommerce-products-filter');
$max_price_txt = __('max price', 'woocommerce-products-filter');



if (isset($request_data['min_price']))
{
    $min_price = $request_data['min_price'];
}

if (isset($request_data['max_price']))
{
    $max_price = $request_data['max_price'];
}

//+++
$min_price_data = $min_price;
$max_price_data = $max_price;
//WOOCS compatibility
if (class_exists('WOOCS'))
{
    $min_price_data = apply_filters('woocs_exchange_value', $min_price_data);
    $max_price_data = apply_filters('woocs_exchange_value', $max_price_data);
}
?>


<div class="woof_price_filter_txt_container woof_block_html_items">

  <p><a href="<?php echo site_url();?>/shop/?swoof=1&min_price=1&max_price=100">$1 to $100</a>		</p>
  <p><a href="<?php echo site_url();?>/shop/?swoof=100&min_price=1&max_price=200">$100 to $200</a></p>
  <p><a href="<?php echo site_url();?>/shop/?swoof=200&min_price=1&max_price=300">$200 to $300</a></p>
  <p><a href="<?php echo site_url();?>/shop/?swoof=300&min_price=1&max_price=400">$300 to $400</a></p>
  <p><a href="<?php echo site_url();?>/shop/?swoof=1&min_price=1&max_price=">$400 and above</a></p>

    $<input type="text" class="woof_price_filter_txt woof_price_filter_txt_from" placeholder="<?php echo $min_price_txt ?>" data-value="<?php echo $min_price_data ?>" value="<?php echo $min_price ?>" />&nbsp; To &nbsp; $<input type="text" class="woof_price_filter_txt woof_price_filter_txt_to" placeholder="<?php echo $max_price_txt ?>" name="max_price" data-value="<?php echo $max_price_data ?>" value="<?php echo $max_price ?>" /><button id="prfil">Go</button>
    <?php if (class_exists('WOOCS')): ?>
        &nbsp;(<?php echo get_woocommerce_currency_symbol() ?>)
    <?php endif; ?>

</div>
<style type="text/css">
.woof_price_filter_txt {
    width: 65px !important;
}
#prfil{
	margin-left: 3%;
	border-radius: 50%;
	border: none;
	padding: 3%;
}
</style>

<?php
