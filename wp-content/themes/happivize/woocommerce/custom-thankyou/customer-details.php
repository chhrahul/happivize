
    <p class="order" style="margin-bottom: 0 !important; color: #000 !important;    font-family: arial,sans-serif !important;font-size: 13px;">
        <?php _e( 'Order ID#:', 'woocommerce' ); ?>
      <span style=" margin-left: 8px;"> <?php echo $order->get_order_number(); ?></span>
    </p>
    <p class="date" style=" color: #000 !important;    font-family: arial,sans-serif !important; font-size: 13px;">
        <?php _e( 'Order Date:', 'woocommerce' ); ?>
        <?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?>
    </p>
   
<dl class="customer_details">
<?php
  //  if ( $order->billing_email ) echo '<dt>' . __( 'Email:', 'woocommerce' ) . '</dt><dd>' . $order->billing_email . '</dd>';
  //  if ( $order->billing_phone ) echo '<dt>' . __( 'Telephone:', 'woocommerce' ) . '</dt><dd>' . $order->billing_phone . '</dd>';

    // Additional customer details hook
   // do_action( 'woocommerce_order_details_after_customer_details', $order );
?>
</dl>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

<div class="col2-set addresses">

    <div class="col-1">

<?php endif; ?>

        <header class="title">
            <p style=" color: #000 !important; font-family: arial,sans-serif !important; font-size: 13px;margin: 0;"><?php _e( 'Billing Information:', 'woocommerce' ); ?></p>
        </header>
        <p style="margin-bottom: 0 !important;color: #000 !important; font-family: arial,sans-serif !important; font-size: 13px;">
            <?php
                if ( ! $order->get_formatted_billing_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_billing_address();
            ?>
        </p>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

    </div><!-- /.col-1 -->

    <div class="col-2">

        <header class="title">
            <p><?php _e( 'Shipping Address', 'woocommerce' ); ?></p>
        </header>
        <address>
            <?php
                 if ( ! $order->get_formatted_shipping_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_shipping_address();

            ?>
        </address>

    </div><!-- /.col-2 -->

</div><!-- /.col2-set -->
 
<?php endif; ?>
<?php if ( $order->billing_email ) echo '<p style="margin-bottom: 0 !important;font-family: arial,sans-serif !important; color: #000 !important;font-size: 13px;">' . __( '', 'woocommerce' ).$order->billing_email . '</p>';
      if ( $order->billing_phone ) echo '<p style="font-family: arial,sans-serif !important;color: #000 !important; font-size: 13px;">' . __( '', 'woocommerce' ). $order->billing_phone . '</p>'; 
     do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
<div class="clear"></div>

<p><a href="https://happivize.com/refund-policy" target="_blank" style="color:#15c; margin-bottom:30px!important; font-weight:normal; text-decoration:underline">Refund Policy</a></p>
<p style="margin-bottom: 70px !important; "><span style="color: #000 !important;font-family: arial,sans-serif !important; font-size: 13px; ">For customer service, please contact:</span> <a href="mailto:support@happivize.com" target="_blank" style="color:#15c; font-weight:normal; text-decoration:underline">support@happivize.com</a></p>


</div>