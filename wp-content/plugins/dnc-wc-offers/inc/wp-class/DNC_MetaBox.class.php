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
 * Base class for simplifying metabox development
 */
abstract class DNC_MetaBox{
	const CONTEXT_NORMAL = 'normal';
	const CONTEXT_SIDE = 'side';
	const CONTEXT_ADVANCED = 'advanced';
	
	const PRIORITY_DEFAULT = 'default';
	const PRIORITY_HIGH = 'high';
	const PRIORITY_LOW = 'low';
	
	private static /* array( string => array( string => mixed ) ) */  $propertyInfo = array(
		'id' => array(
			'sanitize' => 'sanitize_title',
		),
		'label' => array(
			'sanitize' => 'sanitize_text_field',
		),
		'screen' => array(
			'sanitize' => 'DNC_MetaBox::sanitizeScreen',
			'default' => null,
		),
		'context' => array(
			'sanitize' => 'strval',
			'default' => 'advanced',
		),
		'priority' => array(
			'sanitize' => 'strval',
			'default' => 'default',
		),
	);
	
	private static /* array( string => true ) */ $restrictedProperties = array(
		'fields' => true,
		'postTypes' => true,
	);
	
	private /* string */ $id;
	private /* string */ $label;
	private /* array( string ) | WP_Screen | null */ $screen;
	private /* string */ $context;
	private /* string */ $priority;
	private /* string */ $nonceName;
	private /* string */ $fieldPrefix;
	
	public function __construct( array $properties ){
		// Setup properties
		foreach( array_merge( array_keys( self::$propertyInfo ), array_keys( $properties ) ) as $propertyName ){
			if( isset( self::$restrictedProperties[ $propertyName ] ) )
				continue;
			
			$value = isset( $properties[ $propertyName ] ) ? $properties[ $propertyName ] : null;
			
			if( isset( self::$propertyInfo[ $propertyName ] ) ){
				// Perform some validation
				$info = self::$propertyInfo[ $propertyName ];
				
				if( null === $value ){
					if( !isset( $info[ 'default' ] ) )
						throw new InvalidArgumentException( sprintf( '[%s] Argument required: %s', __METHOD__, $propertyName ) );
					
					$value = $info[ 'default' ];
				}else if( is_callable( $info[ 'sanitize' ] ) )
					$value = call_user_func( $info[ 'sanitize' ], $value );
			} // endif isset( self::$propertyInfo[ $propertyName ] )
			
			$this->$propertyName = $value;
		} // foreach $propertyName
		
		// Register hooks
		$screen = $this->screen;
		
		if( is_array( $screen ) ){
			assert( '!empty( $screen )' );
			
			if( version_compare( $GLOBALS[ 'wp_version' ], '3.7', '>=' ) ){
				$callback = array( $this, 'actionSavePostType' );
				
				foreach( $screen as $screenID )
					add_action( sprintf( 'save_post_%s', $screenID ), $callback );
			}else if( !empty( $postTypes ) )
				add_action( 'save_post', array( $this, 'actionSavePost' ) );
		} // endif is_array( $screen )
	} // method DNC_MetaBox::__construct
	
	public function __get( $name ){
		if( isset( $this->$name ) )
			return $this->$name;
		
		return null;
	} // method DNC_MetaBox::__get
	
	public function actionAddMetaBox(){
		// The trailing null is because DNC_MetaBox::actionEchoMetaBox does not require an extra parameter
		add_meta_box( $this->id, $this->label, array( $this, 'actionEchoMetaBox' ), $this->screen, $this->context, $this->priority, null );
	} // method DNC_MetaBox::actionAddMetaBox
	
	public function actionEchoMetaBox( WP_Post $post ){
		wp_nonce_field( $this->id, $this->getNonceName() );
		
		return true;
	} // method DNC_MetaBox::actionEchoMetaBox
	
	public function actionSavePost( $postID ){
		
		if( !isset( $_POST[ 'post_type' ] ) )
			return;
		
		if( !post_type_exists( $_POST[ 'post_type' ] ) )
			return;
		
		return $this->actionSavePostType( $postID );
	} // method DNC_MetaBox::actionSavePost
	
	public function actionSavePostType( $postID ){
		foreach( array(
			'DOING_AUTOSAVE',
			'DOING_AJAX',
			'DOING_CRON',
		) as $constant ){
			if( defined( $constant ) && constant( $constant ) ){
				MZ_Debug::log_if( MZ_Debug::LEVEL_DEBUG, '[%s] Aborting due to constant: %s', __CLASS__, $constant );
				
				return false;
			} // endif defined( $constant ) && constant( $constant )
		} // foreach $constant
		
		$nonceName = $this->getNonceName();
		if( empty( $_POST[ $nonceName ] ) || !wp_verify_nonce( $_POST[ $nonceName ], $this->id ) ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_DEBUG, '[%s] Nonce failed: %s', __CLASS__, $postID );
			
			return false;
		} // endif empty( $_POST[ $nonceName ] ) || !wp_verify_nonce( $_POST[ $nonceName ], $this->id )
		
		// TODO Expand this to snag the actual name of the cap based on the current post_type
		if( !current_user_can( 'edit_post', $postID ) ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_DEBUG, '[%s] User cannot edit: %s', __CLASS__, $postID );
			
			return false;
		} // endif !current_user_can( 'edit_post', $postID )
		
		if( is_multisite() && ms_is_switched() )
			return false;
		
		return true;
	} // method DNC_MetaBox::actionSavePostType
	
	public static function create(){
		$args = func_get_args();
		
		$reflect = new ReflectionClass( get_called_class() );
		
		return array(
			$reflect->newInstanceArgs( $args ),
			'actionAddMetaBox',
		);
	} // method DNC_MetaBox::create
	
	public static function sanitizeScreen( $arg ){
		if( $arg instanceof WP_Screen )
			return $arg;
		
		if( is_array( $arg ) ){
			$arg = array_filter( $arg, 'DNC_MetaBox::isValidScreenID' );
			return empty( $arg ) ? null : $arg;
		} // endif is_array( $arg )
		
		return self::isValidScreenID( $arg ) ? array( $arg ) : null;
	} // method DNC_MetaBox::sanitizeScreen
	
	public static function isValidScreenID( $arg ){
		return is_string( $arg ) && ( 0 < mb_strlen( $arg ) );
	} // method DNC_MetaBox::isValidScreenID
	
	protected final function getNonceName(){
		if( !isset( $this->nonceName ) )
			$this->nonceName = sprintf( '%s-nonce', $this->id );
		
		return $this->nonceName;
	} // method DNC_MetaBox::getNonceName
	
	protected final function getPostValue( $name ){
		$fullName = $this->getFieldName( $name );
		
		return isset( $_POST[ $fullName ] ) ? $_POST[ $fullName ] : null;
	} // method DNC_MetaBox::getPostValue
	
	protected final function getFieldPrefix(){
		if( !isset( $this->fieldPrefix ) )
			$this->fieldPrefix = sprintf( '%s-', $this->id );
		
		return $this->fieldPrefix;
	} // method DNC_MetaBox::getFieldPrefix
	
	public final function getFieldName( $name ){
		return $this->getFieldPrefix() . $name;
	} // method DNC_MetaBox::getFieldName
	
	/**
	 * Gets the value for the given meta name
	 *
	 * @param string $name
	 * @param WP_Post|int|null $post
	 * @return mixed|false
	 */
	public final function getFieldValue( $name, $post = null ){
		$realPost = get_post( $post );
		
		if( !( $realPost instanceof WP_Post ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Could not locate post: %s', __METHOD__, var_export( $post, true ) ) );
			
			return false;
		} // endif !( $realPost instanceof WP_Post )
		
		return get_post_meta( $realPost->ID, $this->getFieldName( $name ), true );
	} // method DNC_MetaBox::getFieldValue
	
	/**
	 * Sets the value for the given meta name
	 *
	 * @param string $name
	 * @param mixed $value
	 * @param WP_Post|int|null $post
	 * @return void
	 */
	public final function setFieldValue( $name, $value, $post = null ){
		$realPost = get_post( $post );
		
		if( !( $realPost instanceof WP_Post ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Could not locate post: %s', __METHOD__, var_export( $post, true ) ) );
			
			return;
		} // endif !( $realPost instanceof WP_Post )
		
		update_post_meta( $realPost->ID, $this->getFieldName( $name ), $value );
	} // method DNC_MetaBox::setFieldValue
} // class DNC_MetaBox
