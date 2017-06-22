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
 * Handles a general input (input, select) Metabox Field
 */
class DNC_MetaBoxField{
	private /* string */ $name;
	private /* string */ $type;
	private /* string */ $label;
	private /* bool */ $required;
	private /* bool */ $disabled;
	private /* array( DNC_MetaBoxFieldOption ) */ $options; // NYI
	private /* callable */ $emit;
	private /* callable */ $sanitize;
	
	private static /* array( string => array( string => mixed ) ) */ $propertyInfo = array(
		'name' => array(
			'validate' => 'DNC_MetaBoxField::isValidName',
		),
		'type' => array(
			'validate' => 'is_string',
			'default' => 'text',
		),
		'label' => array(
			'validate' => 'is_string',
			'default' => '',
		),
		'required' => array(
			'validate' => 'is_bool',
			'default' => false,
		),
		'disabled' => array(
			'validate' => 'is_bool',
			'default' => false,
		),
		'options' => array(
			'validate' => 'DNC_MetaBoxField::isValidOptions',
			'default' => array(),
		),
	);
	
	private static /* array( string => true ) */ $restrictedProperties = array();
	
	public function __construct( array $args ){
		foreach( array_keys( array_merge( self::$propertyInfo, $args ) ) as $propertyName ){
			if( isset( self::$restrictedProperties[ $propertyName ] ) )
				continue;
			
			$value = isset( $args[ $propertyName ] ) ? $args[ $propertyName ] : null;
			
			if( isset( self::$propertyInfo[ $propertyName ] ) ){
				// Perform some validation
				$info = self::$propertyInfo[ $propertyName ];
				$validator = $info[ 'validate' ];
				
				assert( 'is_callable( $validator )' );
				
				if( ( null === $value ) || !call_user_func( $validator, $value ) ){
					if( !isset( $info[ 'default' ] ) )
						throw new InvalidArgumentException( sprintf( '[%s] Argument required: %s', __METHOD__, $propertyName ) );
					
					$value = $info[ 'default' ];
				} // endif ( null === $value ) || !call_user_func( $validator, $value )
			} // endif isset( self::$propertyInfo[ $propertyName ] )
			
			$this->$propertyName = $value;
		} // foreach $propertyName
		
		$this->options = (array)$this->options;
	} // method DNC_MetaBoxField::__construct
	
	public function __get( $name ){
		if( isset( $this->$name ) )
			return $this->$name;
		
		return null;
	} // method DNC_MetaBox::__get
	
	public function getType(){
		return empty( $this->type ) ? 'text' : $this->type;
	} // method DNC_MetaBoxField::getType
	
	public static function isValidName( $arg ){
		return is_string( $arg ) && !empty( $arg );
	} // method DNC_MetaBoxField::isValidName
	
	public static function isValidOptions( $arg ){
		if( is_array( $arg ) )
			return count( array_filter( $arg, 'is_scalar' ) ) === count( $arg );
		
		return is_scalar( $arg );
	} // method DNC_MetaBoxField::isValidOptions
	
	protected function emit( $name, $value ){
		switch( $this->getType() ){
			case 'textarea':
				$this->emitTextarea0( $name, $value );
				break;
			case 'select':
				$this->emitSelect0( $name, $value );
				break;
			case 'radio':
				$this->emitRadio0( $name, $value );
				break;
			case 'checkbox':
				$this->emitCheckbox0( $name, $value );
				break;
			default:
				$this->emitDefault0( $name, $value );
				break;
		} // switch $this->getType()
	} // method DNC_MetaBoxField::emit
	
	protected function packageStatusToString(){
		$ret = '';
		
		foreach( array(
			'required',
			'disabled',
		) as $prop )
			if( $this->$prop )
				$ret .= sprintf( ' %1$s="%1$s"', $prop );
		
		return $ret;
	} // method DNC_MetaBoxField::packageStatusToString
	
	protected function sanitize( $name, $value ){
		switch( $this->getType() ){
			case 'checkbox':
				return $this->sanitizeCheckbox0( $name, $value );
			case 'select':
				return $this->sanitizeSelect0( $name, $value );
			case 'radio':
				return $this->sanitizeRadio0( $name, $value );
			case 'url':
				return $this->sanitizeURL0( $name, $value );
			case 'email':
				return $this->sanitizeEmail0( $name, $value );
			default:
				return $this->sanitizeDefault0( $name, $value );
		} // switch $this->getType()
		
		// SNBR
	} // method DNC_MetaBoxField::sanitize
	
	protected function getFieldValue( $postID, $fieldName ){
		return get_post_meta( $postID, $fieldName, true );
	} // method DNC_MetaBoxField::getFieldValue
	
	protected function setFieldValue( $postID, $fieldName, $value ){
		update_post_meta( $postID, $fieldName, $value );
	} // method DNC_MetaBoxField::setFieldValue
	
	/* package-private */ function emit0( $postID, $fieldName, $echo ){
		$name = esc_attr( $fieldName );
		$value = $this->getFieldValue( $postID, $fieldName );
		
		if( $echo ){
			$this->emit( $name, $value );
			return;
		} // endif $echo
		
		if( !ob_start() ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Unable to start output buffering', __CLASS__ ) );
			
			return false;
		} // endif !ob_start()
		
		$this->emit( $name, $value );
		
		return ob_get_clean();
	} // method DNC_MetaBoxField::emit0
	
	/* private-static */ function save0( $postID, $fieldName ){
		$name = esc_attr( $fieldName );
		$value = MZ_Arrays::isget( $fieldName, $_POST, null );
		
		$this->setFieldValue( $postID, $fieldName, $this->sanitize( $name, $value ) );
	} // method DNC_MetaBoxField::save0
	
	private function emitDefault0( $name, $value ){
?>
<p><label><?php echo $this->label; ?><br />
	<input type="<?php echo esc_attr( $this->getType() ); ?>" name="<?php echo $name; ?>" value="<?php echo esc_attr( $value ); ?>"<?php echo $this->packageStatusToString(); ?> class="widefat" /></label></p>
<?php
	} // method DNC_MetaBoxField::emitDefault0
	
	private function sanitizeDefault0( $name, $value ){
		return MZ_Strings::mb_trim( wp_check_invalid_utf8( $value ) );
	} // method DNC_MetaBoxField::sanitizeDefault0
	
	private function sanitizeURL0( $name, $value ){
		return esc_url_raw( $value );
	} // method DNC_MetaBoxField::sanitizeURL0
	
	private function sanitizeEmail0( $name, $value ){
		return sanitize_email( $value );
	} // method DNC_MetaBoxField::sanitizeEmail0
	
	private function emitSelect0( $name, $value ){
		$options = $this->options;
		if( empty( $options ) )
			return;
		
?>
<p><label><?php echo $this->label; ?></br />
	<select name="<?php echo $name; ?>"<?php echo $this->packageStatusToString(); ?> class="widefat">
<?php
		foreach( $options as $v => $label ){
?>
		<option value="<?php echo esc_attr( $v ); ?>"<?php echo selected( $value, $v ); ?>><?php echo $label; ?></option>
<?php
		} // foreach $v => $label
?>
	</select>
<?php
	} // method DNC_MetaBoxField::emitSelect0
	
	private function sanitizeSelect0( $name, $value ){
		$options = $this->options;
		if( !isset( $options[ $value ] ) ){
			reset( $options );
			$value = key( $options );
		} // endif !isset( $options[ $value ] )
		
		return $value;
	} // method DNC_MetaBoxField::sanitizeSelect0
	
	private function emitRadio0( $name, $value ){
		if( empty( $options ) )
			return;
		
		// TODO Implement
		// For now, falls through
		$this->emitDefault0( $name, $value );
	} // method DNC_MetaBoxField::emitRadio0
	
	private function sanitizeRadio0( $name, $value ){
		// For now, falls through
		$this->sanitizeDefault0( $name, $value );
	} // method DNC_MetaBoxField::sanitizeRadio0
	
	private function emitTextarea0( $name, $value ){
?>
<p><label><?php echo $this->label; ?><br />
	<textarea name="<?php echo $name; ?>"<?php echo $this->packageStatusToString(); ?> class="widefat"><?php echo esc_textarea( $value ); ?></textarea></label></p>
<?php
		return; // For clarity
	} // method DNC_MetaBoxField::emitTextarea0
	
	private function emitCheckbox0( $name, $value ){
		$options = $this->options;
		$options = empty( $options ) ? array( '' => 'value' ) : (array)$options;
		
		if( !is_array( $value ) ) // Handles boolean->array conversion
			$value = $value ? array( reset( $options ) ) : array();
		
		$format = sprintf( '%%s<label>%%%%s</label> <input type="checkbox" name="%s[%%%%s]" value="1"%s%%%%s /></label>%%s', $name, $this->packageStatusToString() );
		
		if( count( $options ) === 1 ){
			$option = reset( $options );
			$format = sprintf( $format, '<p>', '</p>' );
			printf( $format, esc_html( $this->label ), '', checked( in_array( $option, $value ), true, false ) );
			return;
		} // endif count( $options ) === 1
		
		$format = sprintf( $format, '<br />', '' );
?>
<p>
	<span><?php echo esc_html( $this->label ); ?></span>
<?php
		foreach( $options as $label => $option )
			printf( $format, esc_html( $label ), esc_attr( $option ), checked( in_array( $option, $value ), true, false ) );
?>
</p>
<?php
		return; // For clarity
	} // method DNC_MetaBoxField::emitCheckbox0
	
	private function sanitizeCheckbox0( $name, $value ){
		$options = $this->options;
		$options = empty( $options ) ? array( '' => 'value' ) : (array)$options;
		
		if( count( $options ) === 1 )
			return !empty( $value );
		
		if( !is_array( $value ) ) // Handles boolean->array conversion
			$value = $value ? array( reset( $options ) => 1 ) : array();
		
		return array_filter( array_map( 'absint', $value ) );
	} // method DNC_MetaBoxField::sanitizeCheckbox0
} // class DNC_MetaBoxField
