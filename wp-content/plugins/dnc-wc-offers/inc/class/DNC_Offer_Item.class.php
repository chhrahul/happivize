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
 * Helper class to track the data for a given Offer Item
 *
 * Note: Bonuses are tracked internally as items
 */
class DNC_Offer_Item{
	const DIVIDER_TYPE_NONE = -1;
	const DIVIDER_TYPE_DEFAULT = 0;
	const DIVIDER_TYPE_ITEM = 1;
	const DIVIDER_TYPE_BONUS = 2;
	
	private /* string */ $title = '';
	private /* string */ $format = '';
	private /* string */ $value = '';
	private /* string */ $content = '';
	private /* bool */ $bonus = false;
	private /* int */ $dividerType = 0;
	
	/**
	 * @param array $args Mapping of property values
	 */
	public function __construct( array $args ){
		foreach( $args as $key => $value )
			$this->__set( $key, $value );
	} // method DNC_Offer_Item::__construct
	
	/**
	 * Named constructor to ease creation of closures
	 * 
	 * @param array $args Mapping of property values
	 */
	public static function create( array $args ){
		return new self( $args );
	} // method DNC_Offer_Item::create
	
	/**
	 * Magic getter
	 *
	 * Will only allow reading from properties that are defined by the class.  If a getter method exists (as defined by {@MZ_Strings::propertyNameGetter}), said method will be used.  Else, the raw field will be returned.
	 *
	 * @param string $name
	 * @return mixed|null
	 */
	public function __get( $name ){
		if( !property_exists( $this, $name ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Property does not exist: %s', __CLASS__, $name ) );
			
			return;
		} // endif !property_exists( $this, $name )
		
		$methodName = MZ_Strings::propertyNameGetter( $name );
		
		return method_exists( $this, $methodName ) ? $this->$methodName() : $this->$name;
	} // method DNC_Offer_Item::__get
	
	/**
	 * Magic setter
	 *
	 * Will only allow writing to properties that are defined by the class.  If a setter method exists (as defined by {@link MZ_Strings::propertyNameSetter}), said method will be used.  Else, the raw field will be written.
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
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
	} // method DNC_Offer_Item::__set
	
	/**
	 * Sets this Item's title
	 *
	 * @param string $arg
	 * @return void
	 */
	public function setTitle( $arg ){
		$this->title = DNC_Post_Offer::normalizeString( $arg );
	} // method DNC_Offer_Item::setTitle
	
	/**
	 * Sets this Item's content
	 *
	 * @param string $arg
	 * @return void
	 */
	public function setContent( $arg ){
		$this->content = DNC_Post_Offer::normalizeString( $arg );
	} // method DNC_Offer_Item::setContent
	
	/**
	 * Sets whether this item is considered a bonus
	 *
	 * @param bool $arg
	 * @return void
	 */
	public function setBonus( $arg ){
		$this->bonus = (bool)$arg;
	} // method DNC_Offer_Item::setBonus
	
	/**
	 * Sets the prefered tail divider for this item
	 *
	 * @param int $dividerType
	 * @return void
	 */
	public function setDividerType( $arg ){
		$this->dividerType = max( ( is_numeric( $arg ) ? (int)$arg : 0 ), -1 ); // Extract a number, clamp to >= -1
	} // method DNC_Offer_Item::setDividerType
	
	/**
	 * Emits this item
	 *
	 * @param int The 0-based index of this item in its offer
	 * @return void
	 */
	public function emit( DNC_Emit_Counter $counter ){
		$bonus = $this->bonus;
		$singleton = 1 === ( $bonus ? $counter->bonusCount : $counter->itemCount );
		$index = $bonus ? $counter->bonusIndex++ : $counter->itemIndex++;
		$postType = DNC_PostType_Offer::POST_TYPE;
		$itemPrefix = $postType . '-item';
		$headerPrefix = $itemPrefix . '-header';
		$ordinal = $index + 1;
		
		if( $bonus ){
			foreach( DNC_Plugin_Offers::lookupResource( sprintf( 'images/bonus-icon-%d.png', $ordinal ), false ) as $icon )
				$iconURL = DNC_Plugin::resourceToVersionedURL( $icon );
			
			if( !isset( $iconURL ) || $singleton )
				foreach( DNC_Plugin_Offers::lookupResource( 'images/bonus-icon.png', false ) as $icon )
					$iconURL = DNC_Plugin::resourceToVersionedURL( $icon );
			
			$ordinalHeading = $singleton ? __( 'Bonus', 'dnc-wc-offers' ) : sprintf( _n( 'Bonus %d', 'Bonus %d', $ordinal, 'dnc-wc-offers' ), $ordinal );
		}else{
			foreach( DNC_Plugin_Offers::lookupResource( 'images/item-icon.png', false ) as $icon )
				$iconURL = DNC_Plugin::resourceToVersionedURL( $icon );
			
			$ordinalHeading = sprintf( _n( 'Item %d', 'Item %d', $ordinal, 'dnc-wc-offers' ), $ordinal );
		} // endif !$bonus
		
		$value = MZ_Strings::mb_trim( $this->value );
		
		if( '' !== $value )
			$value = sprintf( __( 'Value: %s', 'dnc-wc-offers' ), $value );
		
		$dividerType = $this->dividerType;
		$dividerInfo = self::getDividerTypesInfo();
		$dividerClass = isset( $dividerInfo[ $dividerType ] ) ? $dividerInfo[ $dividerType ][ 'class' ] : ( $itemPrefix . '-' . $dividerType );
?>
<section class="<?php echo $itemPrefix, ' ', $itemPrefix, ( $bonus ? '-bonus' : '-item' ), ' ', $dividerClass; ?>">
	<header class="<?php echo $headerPrefix; ?>">
		<h3 class="<?php echo $headerPrefix; ?>-index"><?php echo $ordinalHeading; ?></h3>
<?php
		if( !empty( $iconURL ) ){
?>
		<div class="row">
			<div class="col-sm-2"><img alt="" src="<?php echo esc_attr( $iconURL ); ?>" class="<?php echo $headerPrefix; ?>-icon" /></div>
			<div class="col-sm-10">
				<h2 class="<?php echo $headerPrefix; ?>-heading"><?php echo DNC_PostType::prepareTitle( $this->title ); ?></h3>
				<p class="<?php echo $headerPrefix; ?>-format"><?php echo DNC_PostType::prepareTitle( $this->format ); ?></p>
				<p class="<?php echo $headerPrefix; ?>-value"><?php echo DNC_PostType::prepareTitle( $value ); ?></p>
			</div>
		</div> <!-- .row -->
<?php
		}else{
?>
		<h2 class="<?php echo $headerPrefix; ?>-heading"><?php echo DNC_PostType::prepareTitle( $this->title ); ?></h3>
		<p class="<?php echo $headerPrefix; ?>-format"><?php echo DNC_PostType::prepareTitle( $this->format ); ?></p>
		<p class="<?php echo $headerPrefix; ?>-value"><?php echo DNC_PostType::prepareTitle( $value ); ?></p>
<?php
		} // endif empty( $iconURL )
?>
	</header> <!-- .<?php echo $headerPrefix; ?> -->
	
	<div class="<?php echo $itemPrefix; ?>-content <?php echo $postType; ?>-content">
<?php
		echo DNC_PostType::prepareContent( $this->content );
?>
	</div> <!-- .<?php echo $itemPrefix; ?>-content -->
</section> <!-- .<?php echo $itemPrefix; ?> -->
<?php
	} // method DNC_Offer_Item::emit
	
	/**
	 * Produces a version of the Item where its fields have been sanitized for a given Wordpress context
	 *
	 * @param string $context
	 * @return DNC_Offer_Package
	 */
	public function sanitize( $context ){
		return new self( array(
			'title' => DNC_Post_Offer::sanitizeString( $this->title, 'post_title', $context ),
			'format' => DNC_Post_Offer::sanitizeString( $this->format, 'post_title', $context ),
			'value' => DNC_Post_Offer::sanitizeString( $this->value, 'post_title', $context ),
			'content' => DNC_Post_Offer::sanitizeString( $this->content, 'post_content', $context ),
			'bonus' => $this->bonus,
			'dividerType' => $this->dividerType,
		) );
	} // method DNC_Offer_Item::sanitize
	
	/**
	 * Fetches information about the known divider types
	 *
	 * @return array[]
	 */
	public static function getDividerTypesInfo(){
		static $info = null;
		
		if( null === $info ){
			$postType = DNC_PostType_Offer::POST_TYPE;
			
			$info = array(
				self::DIVIDER_TYPE_NONE => array(
					'label' => __( 'No Divider', 'dnc-wc-offers' ),
					'class' => sprintf( '%s-item-divider-none', $postType ),
				),
				
				self::DIVIDER_TYPE_DEFAULT => array(
					'label' => __( 'Default', 'dnc-wc-offers' ),
					'class' => sprintf( '%s-item-divider-default', $postType ),
				),
				
				self::DIVIDER_TYPE_ITEM => array(
					'label' => __( 'Item Divider (Fancy)', 'dnc-wc-offers' ),
					'class' => sprintf( '%s-item-divider-item', $postType ),
				),
				
				self::DIVIDER_TYPE_BONUS => array(
					'label' => __( 'Bonus Divider (Simple)', 'dnc-wc-offers' ),
					'class' => sprintf( '%s-item-divider-bonus', $postType ),
				),
			);
		} // endif null === $info
		
		return $info;
	} // method DNC_Offer_item::getDividerTypesInfo
} // class DNC_Offer_Item
