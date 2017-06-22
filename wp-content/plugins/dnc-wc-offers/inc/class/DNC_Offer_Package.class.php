<?php
/*
Copyright (c) 2017 Designs and Codes

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
 * Helper class for tracking the data for a given Offer Package
 */
class DNC_Offer_Package{
	private /* int */ $product = 0;
	private /* string */ $introContent = '';
	private /* DNC_Offer_Item[] */ $items = array();
	private /* string */ $outroContent = '';
	private /* string */ $valueRegular = '';
	private /* string */ $valueCurrent = '';
	private /* WC_Product|null */ $wcProduct = null;
	
	public function __construct( array $args ){
		foreach( $args as $key => $value )
			$this->__set( $key, $value );
	} // method DNC_Offer_Package::__construct
	
	/**
	 * Named constructor to instantiate a Package from the given JSON
	 *
	 * @param string $json
	 * @return DNC_Offer_Package|null
	 */
	public static function fromJSON( $json ){
		$tmp = json_decode( $json, true );
		
		if( !is_array( $tmp ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Invalid json: %s', __METHOD__, var_export( $json, true ) ) );
			
			return null;
		} // endif !is_array( $tmp )
		
		return self::create( $tmp );
	} // method DNC_Offer_Package::fromJSON
	
	/**
	 * Named constructor to instantiate a Package from the given array
	 *
	 * @param array $args
	 * @return DNC_Offer_Package|null
	 */
	public static function create( array $args ){
		if( isset( $args[ 'items' ] ) && is_array( $args[ 'items' ] ) )
			$args[ 'items' ] = array_map( 'DNC_Offer_Item::create', $args[ 'items' ] );
		
		return new self( $args );
	} // method DNC_Offer_Package::create
	
	public function __get( $name ){
		if( !property_exists( $this, $name ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Property does not exist: %s', __CLASS__, $name ) );
			
			return;
		} // endif !property_exists( $this, $name )
		
		$methodName = MZ_Strings::propertyNameGetter( $name );
		
		return method_exists( $this, $methodName ) ? $this->$methodName() : $this->$name;
	} // method DNC_Offer_Package::__get
	
	public function __set( $name, $value ){
		if( !property_exists( $this, $name ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Property does not exist: %s', __CLASS__, $name ) );
			
			return;
		} // endif !property_exists( $this, $name )
		
		$methodName = MZ_Strings::propertyNameSetter( $name );
		
		if( method_exists( $this, $methodName ) )
			$this->$methodName( $value );
		else
			$this->$name = $value;
	} // method DNC_Offer_Package::__set
	
	/**
	 * Sets the WooCommerce Product that is associated with this Package
	 *
	 * @param WP_Post|int $product
	 * @return void
	 */
	public function setProduct( $product ){
		if( is_numeric( $product ) )
			$product = absint( $product );
		
		if( 0 === $product ){
			$this->product = 0;
			
			return;
		} // endif 0 === $product
		
		$post = get_post( $product );
		
		if( !( $post instanceof WP_Post ) || ( 'product' !== $post->post_type ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Invalid product id: %s', __METHOD__, var_export( $product, true ) ) );
			
			return;
		} // endif !( $post instanceof WP_Post ) || ( 'product' !== $post->post_type )
		
		$this->product = $post->ID;
	} // method DNC_Offer_Package::setProductID
	
	/**
	 * Sets the intro content for this Package
	 *
	 * @param string $content
	 * @return void
	 */
	public function setIntroContent( $content ){
		$this->introContent = DNC_Post_Offer::normalizeString( $content );
	} // method DNC_Offer_Package::setIntroContent
	
	/**
	 * Sets the items array for this Package
	 *
	 * @param DNC_Offer_Item[] $items
	 * @return void
	 */
	public function setItems( array $items ){
		if( count( array_filter( $items, array( __CLASS__, 'isOfferItem' ) ) ) !== count( $items ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Invalid DNC_Offer_Item[]: %s', __METHOD__, var_export( $items, true ) ) );
			
			return;
		} // endif count( array_filter( $items, array( __CLASS__, 'isOfferItem' ) ) ) !== count( $items )
		
		$this->items = $items;
	} // method DNC_Offer_Package::setItems
	
	/**
	 * Sets the outro for this Package
	 * 
	 * @param string $content
	 * @return void
	 */
	public function setOutroContent( $content ){
		$this->outroContent = MZ_Strings::mb_trim( MZ_Strings::toStringQuiet( $content ) );
	} // method DNC_Offer_Package::setOutroContent
	
	/**
	 * Fetches the WC_Product associated with this package (if any)
	 *
	 * @return WC_Product|null
	 */
	public function getWCProduct(){
		static /* WC_Product_Factory */ $factory = null;
		
		$ret = $this->wcProduct;
		
		if( null === $ret ){
			if( null === $factory )
				$factory = new WC_Product_Factory;
			
			$ret = ( 0 < $this->product ) ? $factory->get_product( $this->product ) : null;
			
			if( empty( $ret ) )
				$ret = null; // Re-normalize
			
			$this->wcProduct = $ret;
		} // endif null === $ret
		
		return $ret;
	} // method DNC_Offer_Package::getWCProduct
	
	/**
	 * Prevents setting of this instance's WC_Product
	 *
	 * @param WC_Product $product
	 * @return void
	 * @throws LogicException
	 */
	public function setWCProduct( WC_Product $wcProduct ){
		throw new LogicException( 'Unsupported Operation' );
	} // method DNC_Offer_Package::setWCProduct
	
	/**
	 * Converts this Package to JSON
	 *
	 * @return string|false
	 */
	public function toJSON(){
		return wp_json_encode( $this, 0 );
	} // method DNC_Offer_Package::toJSON
	
	/**
	 * Produces a version of the Package where its fields have been sanitized for a given Wordpress context
	 *
	 * @param string $context
	 * @return DNC_Offer_Package
	 */
	public function sanitize( $context ){
		$product = absint( $this->product );
		
		$introContent = DNC_Post_Offer::sanitizeString( $this->introContent, 'post_content', $context );
		
		$outroContent = DNC_Post_Offer::sanitizeString( $this->outroContent, 'post_content', $context );
		
		$items = array_map( function( DNC_Offer_Item $item ) use ( $context ){
			return $item->sanitize( $context );
		}, $this->items );
		
		return new self( array(
			'product' => absint( $this->product ),
			'introContent' => DNC_Post_Offer::sanitizeString( $this->introContent, 'post_content', $context ),
			'outroContent' => DNC_Post_Offer::sanitizeString( $this->outroContent, 'post_content', $context ),
			'items' => array_map( function( DNC_Offer_Item $item ) use ( $context ){
				return $item->sanitize( $context );
			}, $this->items ),
			'valueRegular' => $this->valueRegular,
			'valueCurrent' => $this->valueCurrent,
		) );
	} // method DNC_Offer_Package::sanitize
	
	/**
	 * Returns the number of normal items (non-bonus) held by this package
	 *
	 * @param DNC_Offer_Package $instance
	 * @return int
	 */
	public static function getItemCount( DNC_Offer_Package $instance ){
		return $instance->getItemCount0( false );
	} // method DNC_Offer_Package::getItemCount
	
	/**
	 * Returns the number of bonus items held by this package
	 *
	 * @param DNC_Offer_Package $instance
	 * @return int
	 */
	public static function getBonusCount( DNC_Offer_Package $instance ){
		return $instance->getItemCount0( true );
	} // method DNC_Offer_Package::getBonusCount
	
	/**
	 * Emits this package
	 *
	 * @param DNC_Emit_Counter $counter The counter that we'll reference for indicies/ordinals
	 * @return void
	 */
	public function emit( DNC_Emit_Counter $counter ){
		$postType = DNC_PostType_Offer::POST_TYPE;
		$packagePrefix = $postType . '-package';
		$headerPrefix = $packagePrefix . '-header';
		$contentPrefix = $packagePrefix . '-content';
		$headingText = $this->buildHeadingText0( $counter->packageIndex++, $counter->packageCount )
?>
<section class="<?php echo $packagePrefix; ?>">
	<header class="<?php echo $headerPrefix; ?>">
		<h2 class="<?php echo $headerPrefix; ?>-heading"><?php echo $headingText; ?></h2>
	</header> <!-- .<?php echo $headerPrefix; ?> -->
<?php
		if( '' !== $this->introContent ){
?>
	<div class="<?php echo $contentPrefix; ?>-intro <?php echo $contentPrefix, ' ', $postType; ?>-content">
<?php
			echo DNC_PostType::prepareContent( $this->introContent );
?>
	</div> <!-- .<?php echo $contentPrefix; ?>-intro -->
<?php
		} // endif '' !== $this->introContent
		
		$items = $this->items;
		
		if( !empty( $items ) ){
?>
	<div class="<?php echo $packagePrefix; ?>-items">
<?php
			foreach( $this->items as $item )
				$item->emit( $counter );
?>
	</div> <!-- .<?php echo $packagePrefix; ?>-items -->
<?php
		} // endif !empty( $items )
		
		if( '' !== $this->outroContent ){
?>
	<div class="<?php echo $contentPrefix; ?>-outro <?php echo $contentPrefix, ' ', $postType; ?>-content">
<?php
			echo DNC_PostType::prepareContent( $this->outroContent );
?>
	</div> <!-- .<?php echo $contentPrefix; ?>-outro -->
<?php
		} // endif '' !== $this->outroContent
		
		$wcProduct = $this->getWCProduct();
		
		if( $wcProduct instanceof WC_Product ){
?>
	<div class="<?php echo $postType; ?>-purchase-widgets">
<?php
			$this->emitPurchaseWidget0( $headingText, $counter->offerTitle );
?>
	</div> <!-- .<?php echo $postType; ?>-purchase-widgets -->
<?php
		} // endif $wcProduct instanceof WC_Product
?>
</section> <!-- .<?php echo $packagePrefix; ?> -->
<?php
	} // method DNC_Offer_Package::emit
	
	/**
	 * Emits a purchase widget for this package
	 *
	 * @param DNC_Emit_Counter $counter
	 * @return void
	 */
	public function emitPurchaseWidget( DNC_Emit_Counter $counter ){
		$this->emitPurchaseWidget0( $this->buildHeadingText0( $counter->packageIndex++, $counter->packageCount ), $counter->offerTitle );
	} // method DNC_Offer_Package::emitPurchaseWidget
	
	/* package-private */ static function isOfferItem( $item ){
		return $item instanceof DNC_Offer_Item;
	} // method DNC_Offer_Package::isOfferItem
	
	private static function formatPrice0( $price ){
		return mb_ereg_replace( '[,\.]00<', '<', wc_price( $price ) );
	} // method DNC_Offer_Package::formatPrice0
	
	/**
	 * Emits the actual purchase widget
	 *
	 * @param string $headingText
	 * @return void
	 */
	private function emitPurchaseWidget0( $headingText, $offerTitle ){
		$wcProduct = $this->getWCProduct();
		
		if( !( $wcProduct instanceof WC_Product ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Offer Package hold no reference to a WC_Product', __CLASS__ ) );
			
			return;
		} // endif !( $wcProduct instanceof WC_Product )
		
		$description = MZ_Strings::mb_trim( apply_filters( 'the_excerpt', get_the_excerpt( $wcProduct->post ) ) );
		$valueRegular = $this->valueRegular;
		$valueCurrent = $this->valueCurrent;
		$cartURL = $wcProduct->add_to_cart_url();
		
		if( empty( $valueCurrent ) )
			$valueCurrent = $wcProduct->get_price();
		
		if( empty( $valueRegular ) )
			$valueRegular = $valueCurrent;
		
		foreach( array(
			'valueCurrent',
			'valueRegular',
		) as $valueVar )
			if( is_numeric( $$valueVar ) )
				$$valueVar = '$' . $$valueVar;
		
		foreach( DNC_Plugin_Offers::lookupResource( 'images/cc.png', false ) as $paymentIcon )
			$paymentIconURL = DNC_Plugin::resourceToVersionedURL( $paymentIcon );
		
		$postType = DNC_PostType_Offer::POST_TYPE;
		$widgetPrefix = $postType . '-purchase-widget';
		$headerPrefix = $widgetPrefix . '-header';
		$bodyPrefix = $widgetPrefix . '-body';
		$pricePrefix = $widgetPrefix . '-price';
		$buttonPrefix = $widgetPrefix . '-button';
?>
<aside class="<?php echo $widgetPrefix; ?>">
	<header class="<?php echo $headerPrefix; ?>">
		<h2 class="<?php echo $headerPrefix; ?>-heading"><?php echo $headingText; ?></h2>
	</header> <!-- .<?php echo $headerPrefix; ?> -->
	
	<div class="<?php echo $bodyPrefix; ?>-outer">
		<div class="<?php echo $bodyPrefix; ?>-inner">
<?php
		if( '' !== $description ){
?>
			<div class="<?php echo $widgetPrefix; ?>-description"><?php echo $description; ?></div>
<?php
		} // endif '' !== $description
    
    //Code by Rahul
     global $wpdb;
     global $post;
     $myrows = $wpdb->get_row( "select * from hp_offer_data where offer_post_id = '".$post->ID."' and package_id = '".$wcProduct->post->ID."'" ); 
     $cou = count($myrows);
?>
			<div class="<?php echo $pricePrefix; ?>-normal"><?php printf( __( 'Total Package Value %s for %s', 'dnc-wc-offers' ), $valueRegular, 'Happivize' ); ?></div>
			<div class="<?php echo $pricePrefix; ?>-discounted"><?php printf( __( 'Special Offer %s', 'dnc-wc-offers' ), $valueCurrent ); ?></div>
			<div class="<?php echo $buttonPrefix; ?>s"><a target="_blank" href="<?php echo $cartURL; ?>" class="<?php echo $buttonPrefix; ?> <?php echo $buttonPrefix; ?>-add-to-cart"><?php _e( 'Buy Now', 'dnc-wc-offers' ); ?></a></div>
      
      <div class="<?php echo $widgetPrefix; ?>-suffixes">
<?php
		if( isset( $paymentIconURL ) ){
?>
				<p><img alt="" src="<?php echo esc_attr( $paymentIconURL ); ?>" class="<?php echo $widgetPrefix; ?>-suffix-payment-options" /></p>
<?php
		} // endif isset( $paymentIconURL )
?>
			</div> 
     <?php
       if($cou > 0 && !empty($myrows->emi))
       {
       		if(!empty($myrows->url)){
	         ?>
	              <div class="<?php echo $buttonPrefix; ?>s"><a style="font-size:22px;text-transform:lowercase;" target="_top" href="<?php echo $myrows->url; ?>" class="<?php echo $buttonPrefix; ?> <?php echo $buttonPrefix; ?>-add-to-cart"><?php echo $myrows->emi;//_e( 'Buy Now', 'dnc-wc-offers' ); ?></a></div>
				
	         <?php 
	       	}
	       	else{ ?>
	       		<div class="<?php echo $buttonPrefix; ?>s"><a style="font-size:22px;text-transform:lowercase;background-color: #f36;" class="<?php echo $buttonPrefix; ?> <?php echo $buttonPrefix; ?>-add-to-cart"><?php echo $myrows->emi;//_e( 'Buy Now', 'dnc-wc-offers' ); ?></a></div>
	       	<?php
	       	}
       }
      ?> 
      <!-- .<?php echo $widgetPrefix; ?>-suffixes -->
		</div> <!-- .<?php echo $bodyPrefix; ?>-inner -->
	</div> <!-- .<?php echo $bodyPrefix; ?>-outer -->
</aside> <!-- .<?php echo $widgetPrefix; ?> -->
<?php
	} // method DNC_Offer_Package::emitPurchaseWidget0
	
	/**
	 * Generates an appropriate heading for this package
	 *
	 * @param int $packageIndex
	 * @param int $packageCount
	 * @return string
	 */
	private function buildHeadingText0( $packageIndex, $packageCount ){
		static /* array( int => string ) */ $packageIndexMap = null;
		static /* int */ $packageIndexMapCount = null;
		
		$singleton = 1 === $packageCount;
	
		if( $singleton )
			return __( 'Special Offer', 'dnc-wc-offers' ); // Changed at request of customer | __( 'This Offer Includes', 'dnc-wc-offers' );
		
		if( null === $packageIndexMap ){
			$packageIndexMap = range( _x( 'A', 'Starting Package "Index"', 'dnc-wc-offers' ), _x( 'Z', 'Ending Package "Index"', 'dnc-wc-offers' ) );
			$packageIndexMapCount = count( $packageIndexMap );
		} // endif null === $packageIndexMap
		
		$headingText = '';
		$index = $packageIndex;
		
		do{
			$headingText = $packageIndexMap[ $index % $packageIndexMapCount ] . $headingText;
			$index = (int)( $index / $packageIndexMapCount );
		}while( 0 !== $index );
		
		return sprintf( __( 'Package %s', 'dnc-wc-offers' ), $headingText );
	} // method DNC_Offer_Package::buildHeadingText0
	
	private function getItemCount0( $bonus ){
		$ret = 0;
		
		foreach( $this->items as $item )
			if( $bonus === $item->bonus )
				++$ret; // Not worrying about overflow
		
		return $ret;
	} // method DNC_Offer_Package::getItemCount0
} // class DNC_Offer_Package
?>

<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var windows =$(window);
		windowHeight = $(window).innerHeight();		
		if(screen.width >= 1224){

			//alert("Hello");
			lastval = jQuery('#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside').length;
			//alert(lastval);
			if(lastval == 3){
				//alert("Yes");
				$("#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget").css({
					"width": "33%",
					"padding": "0px 15px"
				});
				$("#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget .dnc-wc-offer-purchase-widget-header-heading").css({
					"font-size": "2rem"
				});			
				$("#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget .dnc-wc-offer-purchase-widget-price-discounted").css({
					"font-size": "1.5em"
				});
				$("#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget .dnc-wc-offer-purchase-widget-description p").css({
					"font-size": "0.9em"
				});
				$("#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget .dnc-wc-offer-purchase-widget-price-normal").css({
					"font-size": "1.2em"
				});
				$("#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget .dnc-wc-offer-purchase-widget-button").css({
					"font-size": "1.8em",
					"padding": "14px 20px"
				});	
				$("#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget .dnc-wc-offer-purchase-widget-buttons:last-child").addClass("last-purchase-button");
				$("#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget .dnc-wc-offer-purchase-widget-buttons.last-purchase-button a").css({
					"font-size": "1em"
				});		

			
			   var maxHeight = -1;

			   $('#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget .dnc-wc-offer-purchase-widget-description').each(function() {
			     maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
			   });

			   $('#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget .dnc-wc-offer-purchase-widget-description').each(function() {
			     $(this).height(maxHeight);
			   });

			}
			else{
				var maxHeight = -1;

			   $('#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget .dnc-wc-offer-purchase-widget-description').each(function() {
			     maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
			   });

			   $('#dnc-wc-offer-finalize .dnc-wc-offer-purchase-widgets aside.dnc-wc-offer-purchase-widget .dnc-wc-offer-purchase-widget-description').each(function() {
			     $(this).height(maxHeight);
			   });
				//alert("No");
			}
		}

	});
</script>