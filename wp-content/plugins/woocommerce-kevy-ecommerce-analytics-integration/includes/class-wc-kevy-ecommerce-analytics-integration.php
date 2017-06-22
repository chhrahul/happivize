<?php

/**
 * Enhanced Ecommerce for Woo-commerce stores
 *
 * Allows tracking code to be inserted into store pages.
 *
 * @class     WC_Kevy_Ecommerce_Analytics
 * @extends   WC_Integration
 * @author    Don Pottinger <don.pottinger@kevy.com>
 */
class WC_Kevy_Ecommerce_Analytics extends WC_Integration {

  /**
   * Init and hook in the integration.
   *
   * @access public
   * @return void
   */
  //set plugin version
  public $kevy_eeVer = '0.0.1';
  public function __construct() {

    //Set Global Variables
    global $homepage_json_fp,$homepage_json_ATC_link, $homepage_json_rp,$prodpage_json_relProd,$catpage_json,
      $prodpage_json_ATC_link,$catpage_json_ATC_link;

    //define plugin ID
    $this->id = "kevy_ecommerce_analytics";
    $this->method_title = __("Kevy eCommerce Marketing Platform", "kevy-ecommerce-marketing-for-woocommerce-store");
    $this->method_description = __("Kevy is an Email Marketing Automation platform built uniquely for online retailers. We help you increase conversions, transactions and loyalty through creating personalized experiences for every shopper.", "woocommerce");

    // Load the integration form
    $this->init_form_fields();
    //load all the settings
    $this->init_settings();

    // Define user set variables -- Always use short names
    $this->kevy_s_id = $this->get_option("kevy_s_id");

    //Save Changes action for admin settings
    add_action("woocommerce_update_options_integration_" . $this->id, array($this, "process_admin_options"));

    // Tracking code
    add_action("wp_footer", array($this, "kevy_tracking_code"));

    // Track identified customer
    add_action('wp_login', array($this, 'set_transient_for_user_login'));
    add_action('user_register', array($this, 'set_transient_for_user_login'));
    add_action("wp_footer", array($this, "track_login"));
    add_action('woocommerce_after_my_account', array($this, "track_customer"));

    // Track order
    add_action("woocommerce_thankyou", array($this, "track_order"));

    // Track product view
    add_action("woocommerce_after_single_product", array($this, "track_product_view"));

    // Track shopping cart
    add_action("woocommerce_after_cart", array($this, "track_shopping_cart"));
    add_action("woocommerce_after_add_to_cart_button", array($this, "track_shopping_cart"));

    // Add plugin details to footer
    add_action("wp_footer", array($this, "add_plugin_details"));

    // Include kevy_store_id in webhook payload
    add_action('woocommerce_webhook_payload', array($this, 'kevy_woocommerce_webhook_payload'));
  }

  /**
   * Display plugin details
   *
   * @access public
   * @return void
   */
  function add_plugin_details() {
    echo '<!--Kevy eCommerce Marketing Plugin for Woocommerce:'.$this->kevy_eeVer.'-->';
  }

  /**
   * Initialize Form Fields for Settings
   *
   * @access public
   * @return void
   */
  function init_form_fields() {
    $this->form_fields = array(
      "kevy_s_id" => array(
        "title" => __("Kevy Store ID", "woocommerce"),
        "description" => __("Enter your Kevy Store ID here. You can login into your Kevy account and find the ID in the Connectors -> Tracking Code section.", "woocommerce"),
        "type" => "text",
        "placeholder" => "1XXX",
        "desc_tip" => true,
        "default" => get_option("kevy_s_id") // Backwards compat
      )
    );
  }

  /**
   * Kevy tracking script tag
   *
   * @access public
   * @return void
   */
  function kevy_tracking_code() {
    global $woocommerce;

    if (is_admin() || current_user_can("manage_options")) {
      return;
    }

    $tracking_id = $this->kevy_s_id;

    if (!$tracking_id) {
      return;
    }

    $script_tag = '<script src="//cdn.kevy.co/' . esc_js($tracking_id) . '.js"></script>';

    echo $script_tag;
  }


  /**
   * Adding tracking id to webhook payload
   *
   * @access public
   * @param mixed $payload
   * @param mixed $resource
   * @param mixed $resource_id
   * @param mixed $id
   * @return void
   */
  function kevy_woocommerce_webhook_payload($payload, $resource, $resource_id, $this_id) {
    global $woocommerce;

    $tracking_id = $this->kevy_s_id;

    if (!$tracking_id)
      return;

    $payload["kevy_s_id"] = $tracking_id;

    return $payload;
  }

  /**
   * Set transient for user login
   *
   * @access public
   * @param mixed $user_login
   * @return void
   */
  function set_transient_for_user_login($user_login) {
    set_transient($user_login, '1', 0);
  }

  /**
   * Track login
   *
   * @access public
   * @return void
   */
  function track_login() {
    global $current_user;

    $tracking_id = $this->kevy_s_id;

    if (!$tracking_id)
      return;

    $user = wp_get_current_user();

    if (!is_user_logged_in())
      return;

    if (!get_transient($user->user_login))
      return;

    $code = <<<EOT
      <!-- Kevy Script -->
      <script type="text/javascript">
        var _k = _k || [];
        _k.push(['identify',
          "$user->user_email",
          "$user->user_firstname",
          "$user->user_lastname"
        ]);
      </script>
      <!-- End Kevy Script -->
EOT;

    echo $code;
    delete_transient($user->user_login);
  }

  /**
   * Track customer
   *
   * @access public
   * @return void
   */
  function track_customer() {
    global $current_user;

    $tracking_id = $this->kevy_s_id;

    if (!$tracking_id)
      return;

    // return if user_login transient present
    if (get_transient($user->user_login))
      return;

    $user = wp_get_current_user();

    if (!is_user_logged_in())
      return;

    $code = <<<EOT
      <!-- Kevy Script -->
      <script type="text/javascript">
        var _k = _k || [];
        _k.push(['identify',
          "$user->user_email",
          "$user->user_firstname",
          "$user->user_lastname"
        ]);
      </script>
      <!-- End Kevy Script -->
EOT;

    echo $code;
  }

  /**
   * Tracking orders
   *
   * @access public
   * @param mixed $order_id
   * @return void
   */
  function track_order($order_id) {
    global $woocommerce;

    $tracking_id = $this->kevy_s_id;

    if (!$tracking_id)
      return;

    // Get the order and output tracking code
    $order = new WC_Order($order_id);
    $code = <<<EOT
      <!-- Kevy Script -->
      <script type="text/javascript">
EOT;

    // Order items
    if ($order->get_items()) {
      foreach ($order->get_items() as $item) {
        $_product = $order->get_product_from_item($item);

        if (isset($_product->variation_data)) {
          $categories=esc_js(woocommerce_get_formatted_variation($_product->variation_data, true));
        } else {
          $out = array();
          $categories = get_the_terms($_product->id, "product_cat");
          if ($categories) {
            foreach ($categories as $category) {
              $out[] = $category->name;
            }
          }
          $categories=esc_js(join(",", $out));
        }

        $_product_sku = esc_js($_product->get_sku() ? $_product->get_sku() : $_product->id);
        $_item_name = $item["name"];
        $_product_price = $_product->price;
        $_item_quantity = $item["qty"];

        $code .= <<<EOT
            var _k = _k || [];
            _k.push(['addOrderItem',
                "$_product_sku",
                "$_item_name",
                [],
                "$_product_price",
                "$_item_quantity"
              ]);

EOT;
      }
    }

    //get shipping cost based on version >2.1 get_total_shipping() < get_shipping
    if (version_compare($woocommerce->version, "2.1", ">=")) {
      $kevy_sc = $order->get_total_shipping();
    } else {
      $kevy_sc = $order->get_shipping();
    }

    $order_number = $order->get_order_number();
    $order_total = $order->get_total();
    $order_subtotal = $order->get_subtotal();
    $order_tax = $order->get_total_tax();
    $order_discount = $order->get_total_discount();
    $order_email = $order->billing_email;
    $order_first_name = $order->billing_first_name;
    $order_last_name = $order->billing_last_name;
    $order_phone = $order->billing_phone;
    $order_company = $order->billing_company;
    $order_address_1 = $order->billing_address_1;
    $order_address_2 = $order->billing_address_2;
    $order_city = $order->billing_city;
    $order_state = $order->billing_state;
    $order_postcode = $order->billing_postcode;
    $order_country = $order->billing_country;

    $code .= <<<EOT
        _k.push(['trackOrder',
          "$order_number",
          "$order_total",
          "$order_subtotal",
          "$order_tax",
          "$kevy_sc",
          "$order_discount",
          "$order_email",
          "$order_first_name",
          "$order_last_name",
          "$order_phone",
          "", // Birthday
          "$order_company",
          "$order_address_1",
          "$order_address_2",
          "$order_city",
          "$order_state",
          "$order_postcode",
          "$order_country"
        ]);
      </script>
      <!-- End Kevy Script -->
EOT;

    echo $code;
  }

  /**
   * Tracking product views
   *
   * @access public
   * @return void
   */
  function track_product_view() {
    global $product;

    $tracking_id = $this->kevy_s_id;

    if (!$tracking_id)
      return;

    $product_sku = $product->get_sku() ? $product->get_sku() : $product->id;
    $product_name = $product->get_title();
    $product_price = $product->price;

    if (isset($product->variation_data)) {
      $categories=esc_js(woocommerce_get_formatted_variation($product->variation_data, true));
    } else {
      $out = array();
      $categories = get_the_terms($product->id, "product_cat");
      if ($categories) {
        foreach ($categories as $category) {
          $out[] = $category->name;
        }
      }
      $categories= json_encode($out);
    }

    $product_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($product->ID))[0];


  $code = <<<EOT
    <!-- Kevy Script -->
    <script type="text/javascript">
      var _k = _k || [];
      _k.push(['trackProductView',
               "$product_sku",
               "$product_name",
               "",
               "$product_image_url",
               "",
               $product_price,
               $categories]);
    </script>
    <!-- End Kevy Script -->
EOT;

    // if on product page
    if(is_product()){
      echo $code;
    }
  }

  /**
   * Tracking shopping cart and shopping cart items
   *
   * @access public
   * @return void
   */
  function track_shopping_cart() {
    global $woocommerce;

    $tracking_id = $this->kevy_s_id;

    if (!$tracking_id) {
      return;
    }

    $cart = $woocommerce->cart;
    $cart_items = $cart->get_cart();

    if (!sizeof($cart_items)>0) {
      return;
    }

    $code = <<<EOT
      <!-- Kevy Script -->
      <script type="text/javascript">
EOT;

    foreach($cart_items as $cart_item_key => $values) {
      $_product = $values['data'];
      $_product_sku = $_product->get_sku() ? $_product->get_sku() : $_product->id;
      $_product_title = $_product->get_title();
      //$_product_price = $_product->price;
      // Required for The Outdoor Insiders but may not be for all other customers
      $_product_price = $_product->get_price_including_tax();
      $_product_quantity = $values['quantity'];

      $code .= <<<EOT
        var _k = _k || [];
        _k.push(['addOrderItem',
            "$_product_sku",
            "$_product_title",
            [],
            "$_product_price",
            "$_product_quantity"
          ]);

EOT;
    }

    $amount = $cart->cart_contents_total + $cart->tax_total;
    // track shopping cart update
    $code .= <<<EOT
        _k.push(['trackCartUpdate',
                 "$amount"]);
      </script>
      <!-- End Kevy Script -->
EOT;

    echo $code;
  }

  /**
   * Check if tracking is disabled
   *
   * @access private
   * @param mixed $type
   * @return bool
   */
  function tracking_disabled() {
    if (is_admin() || current_user_can("manage_options") || (!$this->kevy_s_id )) {
      return true;
    }
  }

  /**
   * woocommerce version compare
   *
   * @access public
   * @return void
   */
  function wc_version_compare($codeSnippet) {
    global $woocommerce;
    if (version_compare($woocommerce->version, "2.1", ">=")) {
      wc_enqueue_js($codeSnippet);
    } else {
      $woocommerce->add_inline_js($codeSnippet);
    }
  }

}

?>
