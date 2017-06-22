<table class="shop_table order_details" style="margin-bottom: 50px; ">
    <thead>
        <tr>
            <th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
            <th class="product-name"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
            <th class="product-total"><?php _e( 'Price', 'woocommerce' ); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ( sizeof( $order->get_items() ) > 0 ) {

            foreach( $order->get_items() as $item ) {
                $_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
                $item_meta    = new WC_Order_Item_Meta( $item['item_meta'], $_product );

                ?>
                <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
                    <td class="product-name">
                        <?php
                            if ( $_product && ! $_product->is_visible() )
                                echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
                            else
                                echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
                                echo '<br/>' . $_product->post->post_excerpt; 
                                // echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );

                          

                            $item_meta->display();

                            if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

                                $download_files = $order->get_item_downloads( $item );
                                $i              = 0;
                                $links          = array();

                                foreach ( $download_files as $download_id => $file ) {
                                    $i++;

                                    $links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
                                }

                                echo '<br/>' . implode( '<br/>', $links );
                            }
                        ?>
                    </td>
                    <td class="product-qunt">
                        <?php   echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item ); ?>
                    </td>
                    <td class="product-total">
                        <?php echo $order->get_formatted_line_subtotal( $item ); ?>
                    </td>
                </tr>
                <?php

                if ( $order->has_status( array( 'completed', 'processing' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
                    ?>
                    <tr class="product-purchase-note">
                        <td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
                    </tr>
                    <?php
                }
            }
        }

        do_action( 'woocommerce_order_items_table', $order );
        ?>
    </tbody>
       <tfoot>
    <?php 

$output_mthd = "";
$payment_method = get_post_meta( $order->id, '_payment_method', true );
if($payment_method == "authorize_net_cim_credit_card"){
    $output_mthd_digits = get_post_meta( $order->id, '_wc_authorize_net_cim_credit_card_account_four', true );
    $output_mthd = "Card ending in - ".$output_mthd_digits;
}
elseif($payment_method == "paypal"){
    $output_mthd = "PayPal";
}

       if ( $totals = $order->get_order_item_totals() ) {
                 $countval = count($totals);
                 if($countval === 3){
                  $i = 0; 
                  foreach ( $totals as $total ) {         
                    $i++;
                    ?>
                    <tr>
                      <th class="td" scope="row" colspan="2" style="text-align:left; "><?php echo $total['label']; ?></th>
                      <td class="td" style="text-align:left; width:33%;"><?php if ( $i === 2 ) { echo $output_mthd; }else{ echo $total['value']; }?></td>
                    </tr>
                    <?php                  
                  } 
                }
                elseif($countval === 4){
                  $i = 0; 
                  foreach ( $totals as $total ) {
                   $label_val =  $total['label'];
                    $i++;
                    ?>
                    <tr>
                      <th class="td" scope="row" colspan="2" style="text-align:left; "><?php echo $total['label']; ?></th>
                      <td class="td" style="text-align:left; width:33%;">
                      <?php
                        if ( $i === 2 ) { echo $total['value']; 
                        }
                        elseif ( $i === 3 ) { echo $output_mthd; 
                        }
                        else{ echo $total['value']; }
                        ?>              
                      </td>
                    </tr>
                    <?php
                 }
                }
            
              }
    ?>
    </tfoot>
</table>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
