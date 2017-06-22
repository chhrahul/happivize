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
 * Setup and control for the dnc-wc-offer post type
 */
class DNC_PostType_Offer extends DNC_PostType{
	const POST_TYPE = 'dnc-wc-offer';
	
	const META_BOX_PACKAGE_MANAGER = 'dnc-wc-offer-meta-box-package-manager';
	const META_BOX_PACKAGE_EDITOR = 'dnc-wc-offer-meta-box-package-editor';
	const META_BOX_OUTRO_EDITOR = 'dnc-wc-offer-meta-box-outro-editor';
	const META_BOX_SPEAKER_EDITOR = 'dnc-wc-offer-meta-box-speaker-editor';
	
	const FIELD_NAME_PACKAGE_MANAGER = 'dnc-wc-offer-package-associations';
	const FIELD_NAME_PACKAGE_EDITOR = 'dnc-wc-offer-package-data';
	const FIELD_NAME_OUTRO_EDITOR = 'dnc-wc-offer-outro';
	
	const FIELD_NAME_PACKAGE_MANAGER_PRODUCT_ID = 'dnc-wc-offer-package-associations';
	const FIELD_NAME_PACKAGE_MANAGER_VALUE_REGULAR = 'dnc-wc-offer-package-value-regular';
	const FIELD_NAME_PACKAGE_MANAGER_VALUE_CURRENT = 'dnc-wc-offer-package-value-current';
  
  const FIELD_NAME_PACKAGE_MANAGER_VALUE_EMI  = 'dnc-wc-offer-package-value-emi';
  
  const FIELD_NAME_PACKAGE_MANAGER_VALUE_URL = 'dnc-wc-offer-package-value-url';
	
	const NONCE_NAME = 'dnc-wc-offer-nonce';
	const NONCE_ACTION = 'dnc-wc-offer-edit';
	
	const META_SPEAKER_NAME = 'speaker-name';
	const META_SPEAKER_TITLE = 'speaker-title';
	const META_SPEAKER_MUGSHOT = 'speaker-mugshot';
	const META_SPEAKER_BIO = 'speaker-bio';
	
	const FORMAT_RESOURCE = '%1$s%2$s/%3$s.%2$s';
	
	private /* DNC_FieldedMetaBox */ $metaboxSpeaker;
	
	protected function __construct(){
		parent::__construct( self::POST_TYPE );
		
		$this->metaboxSpeaker = new DNC_FieldedMetaBox( array(
			// Properties
			'id' => self::META_BOX_SPEAKER_EDITOR,
			'label' => __( 'Speaker Information', 'dnc-wc-offers' ),
			'screen' => self::POST_TYPE,
			'context' => DNC_MetaBox::CONTEXT_NORMAL,
			'priority' => DNC_MetaBox::PRIORITY_HIGH,
		), array(
			// Fields
			self::META_SPEAKER_MUGSHOT => new DNC_MetaBoxField_Image( array(
				'name' => self::META_SPEAKER_MUGSHOT,
				'label' => __( 'Headshot', 'dnc-wc-offers' ),
				'labels' => array(
				),
			) ),
			self::META_SPEAKER_NAME => array(
				'label' => __( 'Name', 'dnc-wc-offers' ),
			),
			self::META_SPEAKER_TITLE => array(
				'label' => __( 'Title', 'dnc-wc-offers' ),
			),
			self::META_SPEAKER_BIO => array(
				'type' => 'textarea',
				'label' => __( 'Biography', 'dnc-wc-offers' ),
			),
		) );
	} // method DNC_PostType_Offer::__construct
	
	/**
	 * Magic isset for our otherwise-hidden properties
	 *
	 * @param string $name
	 * @return bool
	 */
	public function __isset( $name ){
		if( property_exists( $this, $name ) )
			return !is_null( $this->get0( $name ) );
		
		return parent::__isset( $name );
	} // method DNC_Post_Offer::__isset
	
	/**
	 * Magic getter for our otherwise-hidden properties
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function __get( $name ){
		if( property_exists( $this, $name ) )
			return $this->get0( $name );
		
		return parent::__get( $name );
	} // method DNC_Post_Offer::__get
	
	/**
	 * Magic setter for our otherwise-hidden properties
	 *
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function __set( $name, $value ){
		if( property_exists( $this, $name ) ){
			$methodName = MZ_Strings::propertyNameSetter( $name );
			
			if( method_exists( $this, $methodName ) )
				$this->$methodName( $value );
			else
				$this->$name = $value;
			
			return;
		} // endif property_exists( $this, $name )
		
		parent::__set( $name, $value );
	} // method DNC_Post_Offer::__set
	
	protected function wrapPost( WP_Post $post ){
		return new DNC_Post_Offer( $post );
	} // method DNC_PostType_Offer::wrapPost
	
	/**
	 * Enqueues scripts/styles associated with our post type
	 *
	 * @return void
	 */
	public function actionEnqueueScripts(){
		$idPrefix = self::POST_TYPE . '-';
		$googleID = $idPrefix . 'google-fonts';
		$bootstrapID = $idPrefix . 'bootstrap';
		$fontawesomeID = $idPrefix . 'fontawesome';
		$styleDepends = array(
			$googleID,
			$bootstrapID,
			$fontawesomeID,
		);
		
		wp_enqueue_style( $googleID, 'https://fonts.googleapis.com/css?family=Roboto:300,400,500|Shadows+Into+Light&amp;subset=latin-ext', array(), null );
		wp_enqueue_style( $bootstrapID, 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), null );
		wp_enqueue_style( $fontawesomeID, 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), null );
		
		wp_deregister_style( 'twentysixteen-style' );
		
		foreach( array_reverse( DNC_Plugin_Offers::lookupResource( sprintf( 'css/%s.css', self::POST_TYPE ), true ) ) as $index => $css )
			wp_enqueue_style( ( $idPrefix . $index ), $css[ 'url' ], $styleDepends, $css[ 'mtime' ] );
		
		wp_enqueue_script( 'imagesloaded', 'https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js', array( 'jquery' ), null, true );
		
		$scriptDepends = array(
			'jquery-masonry',
			'imagesloaded',
		);
		
		foreach( array_reverse( DNC_Plugin_Offers::lookupResource( sprintf( 'js/%s.js', self::POST_TYPE ), false ) ) as $index => $js )
			wp_enqueue_script( ( $idPrefix . $index ), $js[ 'url' ], $scriptDepends, $js[ 'mtime' ], true );
	} // method DNC_PostType_Offer::actionEnqueueScripts
	
	/* protected */ function actionRegister(){
		if( !parent::actionRegister() )
			return false;
		
		register_post_type( self::POST_TYPE, array(
			'labels' => array(
				'name' => __( 'Offers', 'dnc-wc-offers' ),
				'singular_name' => __( 'Offer', 'dnc-wc-offers' ),
				'add_new' => _x( 'Add New', 'offer', 'dnc-wc-offers' ),
				'add_new_item' => __( 'Add New Offer', 'dnc-wc-offers' ),
				'edit_item' => __( 'Edit Offer', 'dnc-wc-offers' ),
				'new_item' => __( 'New Offer', 'dnc-wc-offers' ),
				'view_item' => __( 'View Offer', 'dnc-wc-offers' ),
				'view_items' => __( 'View Offers', 'dnc-wc-offers' ),
				'search_items' => __( 'Search Offers', 'dnc-wc-offers' ),
				'not_found' => __( 'No offers found', 'dnc-wc-offers' ),
				'not_found_in_trash' => __( 'No offers found in trash', 'dnc-wc-offers' ),
				'parent_item_colon' => __( 'Parent Offer:', 'dnc-wc-offers' ),
				'all_items' => __( 'All Offers', 'dnc-wc-offers' ),
				'archives' => __( 'Offer Archives', 'dnc-wc-offers' ),
				'attributes' => __( 'Offer Attributes', 'dnc-wc-offers' ),
				'insert_into_item' => __( 'Insert into offer', 'dnc-wc-offers' ),
				'uploaded_to_this_item' => __( 'Uploaded to this offer', 'dnc-wc-offers' ),
				'filter_items_list' => __( 'Filter offers list', 'dnc-wc-offers' ),
				'items_list_navigation' => __( 'Offers list navigation', 'dnc-wc-offers' ),
				'items_list' => __( 'Offers list', 'dnc-wc-offers' ),
				
				// Using default inheritance
				// 'menu_name'
				
				// Using default Wordpress strings
				'featured_image' => __( 'Featured Image' ),
				'set_featured_image' => __( 'Set featured image' ),
				'remove_featured_image' => __( 'Remove featured image' ),
				'use_featured_image' => __( 'Use as featured image' ),
			),
			'description' => __( 'A rapidly buildable offer page that integrates with WooCommerce products', 'dnc-wc-offers' ),
			'public' => true,
			'hierarchical' => false,
			'exclude_from_search' => false, // Really, I'm not sure on this one -- extend to feed from a full-on get_option?
			'menu_icon' => 'dashicons-megaphone',
			//'supports' => array( 'title', 'editor', 'thumbnail' ),
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes', 'custom-fields', 'comments', 'revisions' ),
			'register_meta_box_cb' => array( $this, 'actionRegisterMetaBox' ),
			'has_archive' => false,
			'rewrite' => array(
				'slug' => 'offers',
				'with_front' => false,
			),
			'delete_with_user' => false,
		) );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'actionAdminEnqueue' ) );
		add_action( sprintf( 'save_post_%s', self::POST_TYPE ), array( $this, 'actionSavePost' ), 10, 3 );
		
		add_filter( 'single_template', array( $this, 'filterSingleTemplate' ) );
		add_filter( 'archive_template', array( $this, 'filterArchiveTemplate' ) );
		
		return true;
	} // method DNC_PostType_Offer::actionRegister
	
	/**
	 * Saves this post type's metadata
	 *
	 * @param int $postID
	 * @param WP_Post $post
	 * @param bool $update
	 * @return void
	 */
	/* protected */ function actionSavePost( $postID, WP_Post $post, $update ){ 
		
		
	

	

		foreach( array(
			'DOING_AUTOSAVE',
			'DOING_AJAX',
			'DOING_CRON',
		) as $constant ){
			if( defined( $constant ) && constant( $constant ) ){
				if( WP_DEBUG )
					error_log( sprintf( '[%s] Aborting save due to editor state: %s', __CLASS__, $constant ) );
				
				return;
			} // endif defined( $constant ) && constant( $constant )
		} // foreach $constant
		
		if( !isset( $_REQUEST[ self::NONCE_NAME ] ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Aborting save due to missing nonce', __CLASS__ ) );
			
			return;
		} // endif !isset( $_REQUEST[ self::NONCE_NAME ] )
		
		if( !wp_verify_nonce( $_REQUEST[ self::NONCE_NAME ], self::NONCE_ACTION ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Aborting save due to invalid nonce', __CLASS__ ) );
			
			return;
		} // endif !wp_verify_nonce( $_REQUEST[ self::NONCE_NAME ], self::NONCE_ACTION )
		
		if( !current_user_can( 'edit_post', $postID ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Aborting save due to insufficient permissions', __CLASS__ ) );
			
			return;
		} // endif !current_user_can( 'edit_post', $postID )
		
		if( is_multisite() && ms_is_switched() ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Aborting save due to multisite switch', __CLASS__ ) );
			
			return;
		} // endif is_multisite() && ms_is_switched()
		
		$offer = $this->wrapPost( $post );
		
		if( !( $offer instanceof DNC_Post ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Aborting save due to post-type mismatch: %s', __CLASS__, $post->post_type ) );
			
			return;
		} // endif !( $offer instanceof DNC_Post )
		
		foreach( array(
			'outroContent' => self::FIELD_NAME_OUTRO_EDITOR,
			'rawPackages' => self::FIELD_NAME_PACKAGE_EDITOR,
		) as $var => $key )
			$$var = stripslashes( MZ_Strings::toStringQuiet( MZ_Arrays::isget( $key, $_REQUEST, '' ) ) );
		
		$offer->outroContent = DNC_Post_Offer::sanitizeString( $outroContent, 'post_content', 'db' );
		$packages = json_decode( $rawPackages, true );
		
		if( !is_array( $packages ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Malformed packages information: %s', __CLASS__, var_export( $rawPackages, true ) ) );
			
			$packages = array();
			
		} // endif !is_array( $packages )
		//echo '<pre>';print_r($packages);die; 
		$k = count($packages);
		
		global $wpdb;

			//$qry = "select * from hp_offer_data where offer_post_id = '".$postID."'";
			 $myrows = $wpdb->get_results( "select * from hp_offer_data where offer_post_id = '".$postID."'" ); 

			 	$j = 0;
			
		foreach ($packages as $key => $value) {
			$j++;
			//echo $value['product'];
			
			if(empty($myrows)){
           echo $wpdb->insert('hp_offer_data', array(
			    'offer_post_id' => $postID,
			    'package_id' => $value['product'],
          'emi' => $value['valueEmi'],
          'url' => $value['valueUrl'],
			    )); 
	     }else{
            if( $j == 1){
	     	$wpdb->delete( 'hp_offer_data', array( 'offer_post_id' => $postID ) );
	     }
	     	$wpdb->insert('hp_offer_data', array(
			    'offer_post_id' => $postID,
			    'package_id' => $value['product'],
          'emi' => $value['valueEmi'],
          'url' => $value['valueUrl'],
			    ));
	     	
	     }
		}
		

		$offer->packages = array_map( function( DNC_Offer_Package $package ){
			return $package->sanitize( 'db' );
		}, array_filter( array_map( 'DNC_Offer_Package::create', $packages ) ) );
	} // method DNC_PostType_Offer::actionSavePost
	
	/**
	 * Registers the necessary meta boxes for our post type
	 *
	 * @return void
	 */
	/* protected */ function actionRegisterMetaBox(){
		/*
		 * Will register 3 meta boxes:
		 * * The Package Manager
		 * * The Package Editor
		 * * The Outro Editor
		 */
		
		add_action( 'edit_form_after_title', array( $this, 'actionEditFormAfterTitle' ) );
		add_action( 'edit_form_after_editor', array( $this, 'actionEditFormAfterEditor' ) );
		
		// The Package Manager
		add_meta_box( self::META_BOX_PACKAGE_MANAGER, __( 'Packages Manager', 'dnc-wc-offers' ), array( $this, 'actionMetaBoxPackageManager' ), null, 'side', 'high' );
		
		// The Package Editor
		add_action( 'edit_form_after_editor', array( $this, 'actionMetaBoxPackageEditor' ) );
		
		// The Outro Editor
		add_action( 'edit_form_after_editor', array( $this, 'actionMetaBoxOutro' ) );
		
		// The Speaker Editor
		$this->metaboxSpeaker->actionAddMetaBox();
	} // method DNC_PostType_Offer::actionRegisterMetaBox
	
	/**
	 * Registers the styles for our post type
	 *
	 * @return void
	 */
	/* protected */ function actionAdminEnqueue( $page ){
		if( !in_array( $page, array( 'post.php', 'post-new.php' ) ) )
			return;
		
		if( self::POST_TYPE !== $GLOBALS[ 'typenow' ] )
			return;
		
		$rootDir = dirname( __DIR__ );
		$pluginDir = dirname( $rootDir );
		$file = '/css/dnc-wc-offers.admin.css';
		$filePath = $pluginDir . $file;
		$fileTime = MZ_Files::mtime( $filePath );
		
		if( false !== $fileTime )
			wp_enqueue_style( 'dnc-wc-offers', plugins_url( $file, $rootDir ), array(), $fileTime );
		else if( WP_DEBUG )
			error_log( sprintf( '[%s] Unable to locate file: %s', __CLASS__, $filePath ) );
		
		$file = '/js/dnc-wc-offers.admin.js';
		$filePath = $pluginDir . $file;
		$fileTime = MZ_Files::mtime( $filePath );
		
		if( false !== $fileTime )
			wp_enqueue_script( 'dnc-wc-offers', plugins_url( $file, $rootDir ), array( 'jquery' ), $fileTime, true );
		else if( WP_DEBUG )
			error_log( sprintf( '[%s] Unable to locate file: %s', __CLASS__, $filePath ) );
	} // method DNC_PostType_Offer::actionAdminEnqueue
	
	/**
	 * Emit lead-in for the intro editor
	 *
	 * @return void
	 */
	/* protected */ function actionEditFormAfterTitle(){
		wp_nonce_field( self::NONCE_ACTION, self::NONCE_NAME );
?>
<div id="dnc-wc-offers-intro-editor-widget" class="dnc-wc-offers-intro-editor-widget dnc-wc-offers-widget">
	<div class="dnc-wc-offers-row">
		<h1 class="dnc-wc-offers-heading"><?php _e( 'Offer Intro', 'dnc-wc-offers' ) ?></h1>
		<div class="dnc-wc-offers-sub-controls">
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Show/Hide Offer Intro Editor', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-toggle button"><span class="screen-reader-text"><?php _e( 'Show/Hide Offer Intro Editor', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-hidden"></span></button></p>
		</div> <!-- .dnc-wc-offers-sub-controls -->
	</div> <!-- .dnc-wc-offers-row -->
	
	<div class="dnc-wc-offers-body">
<?php
	} // method DNC_PostType_Offer::actionEditFormAfterTitle
	
	/**
	 * Emit the lead-out for the intro editor
	 *
	 * @return void
	 */
	/* protected */ function actionEditFormAfterEditor(){
?>
	</div> <!-- .dnc-wc-offers-body -->
</div> <!-- #dnc-wc-offers-intro-editor-widget -->
<?php
	} // method DNC_PostType_Offer::actionEditFormAfterEditor
	
	/**
	 * Emit the meta box for the package manager
	 * 
	 * @param WP_Post $post
	 * @return void
	 */
	/* protected */ function actionMetaBoxPackageManager( WP_Post $post ){
		$offer = self::getPost( $post );
		
		if( null === $offer ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Not an %s: %s', __CLASS__, self::POST_TYPE, var_export( $post, true ) ) );
			
			return;
		} // endif null === $offer
		
		$products = self::getWCProducts0();
?>
<div id="dnc-wc-offer-package-manager-widget" class="dnc-wc-offer-package-manager-widget" data-message-remove="<?php _e( 'Really delete this package?', 'dnc-wc-offers' ); ?>">
	<ol class="dnc-wc-offers-package-manager-list">
<?php
		foreach( $offer->packages as $package )
			self::emitPackageManagerItem0( $products, $package->product, $package->valueRegular, $package->valueCurrent, $package->valueEmi, $package->valueUrl );
?>
	</ol> <!-- .dnc-wc-offers-package-manager-list -->
<?php
		self::emitPackageManagerItem0( $products, '', '', '','','', true );
		self::emitPackageEditorItem0();
?>
	<p class="dnc-wc-offers-package-manager-control"><button type="button" title="<?php _e( 'Add Package', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-package-manager-add button"><?php _e( 'Add Package', 'dnc-wc-offers' ); ?></button></p>
</div> <!-- #dnc-wc-offer-package-manager-widget -->
<?php
	} // method DNC_PostType_Offer::actionMetaBoxPackageManager
	
	/**
	 * Emit the meta box for the package editor
	 *
	 * @param WP_Post $post
	 * @return void
	 */
	/* protected */ function actionMetaBoxPackageEditor( WP_Post $post ){
		$offer = self::getPost( $post );
		
		if( null === $offer ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Not an %s: %s', __CLASS__, self::POST_TYPE, var_export( $post, true ) ) );
			
			return;
		} // endif null === $offer
		
		$packages = $offer->packages;
		
		$packages = array_map( function( DNC_Offer_Package $package ){
			return $package->sanitize( 'edit' );
		}, $packages );
?>
<div id="dnc-wc-offers-package-editor-widget" class="dnc-wc-offers-package-editor-widget dnc-wc-offers-widget" data-remove-message="<?php _e( 'Really delete this item?', 'dnc-wc-offers' ); ?>">
	<h1 class="dnc-wc-offers-heading"><?php _e( 'Packages Editor', 'dnc-wc-offers' ); ?></h1>
	
	<input type="hidden" name="<?php echo self::FIELD_NAME_PACKAGE_EDITOR; ?>" value="<?php echo esc_attr( wp_json_encode( $packages ) ); ?>" />
<?php
		self::emitItemEditorItem0();
?>
	<div class="inside">
		<ol class="dnc-wc-offers-package-editor-list">
<?php
		foreach( $packages as $package )
			self::emitPackageEditorItem0( $package );
?>
		</ol> <!-- .dnc-wc-offers-package-editor-list -->
	</div> <!-- .inside -->
</div> <!-- #dnc-wc-offers-package-editor-widget -->
<?php
	} // method DNC_PostType_Offer::actionMetaBoxPackageEditor
	
	/**
	 * Emit the meta box for the offer outro content
	 *
	 * @param WP_Post $post
	 * @return void
	 */
	/* protected */ function actionMetaBoxOutro( WP_Post $post ){
		$offer = self::getPost( $post );
		
		if( null === $offer ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Not an %s: %s', __CLASS__, self::POST_TYPE, var_export( $post, true ) ) );
			
			return;
		} // endif null === $offer
?>
<div id="dnc-wc-offers-outro-editor-widget" class="dnc-wc-offers-outro-editor-widget dnc-wc-offers-widget">
	<div class="dnc-wc-offers-row">
		<h1 class="dnc-wc-offers-heading"><?php _e( 'Offer Outro', 'dnc-wc-offers' ) ?></h1>
		<div class="dnc-wc-offers-sub-controls">
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Show/Hide Offer Outro Editor', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-toggle button"><span class="screen-reader-text"><?php _e( 'Show/Hide Offer Outro Editor', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-hidden"></span></button></p>
		</div> <!-- .dnc-wc-offers-sub-controls -->
	</div> <!-- .dnc-wc-offers-row -->
	
	<div class="dnc-wc-offers-body">
<?php
		wp_editor( $offer->outroContent, MZ_Strings::mb_str_replace( '-', '_', self::FIELD_NAME_OUTRO_EDITOR ), array(
			'textarea_name' => self::FIELD_NAME_OUTRO_EDITOR,
			'drag_drop_upload' => true,
			'tabfocus-elements' => 'content-html,save-post',
			'editor_height' => 300,
			'tinymce' => array(
				'resize' => false,
				'wp_autoresize_on' => false,
				'add_unload_trigger' => false,
			),
		) );
?>
	</div> <!-- .dnc-wc-offers-body -->
</div> <!-- #dnc-wc-offers-outro-editor-widget -->
<?php
	} // method DNC_PostType_Offer::actionMetaBoxOutro
	
	/**
	 * Inserts our single template into the selection
	 *
	 * @param string $path Path to our caller's chosen template file
	 * @return string The path our caller will return to its caller
	 */
	/* protected */ function filterSingleTemplate( $path ){
		global $post;
		
		if( self::POST_TYPE !== $post->post_type )
			return $path;
		
		return DNC_Plugin_Offers::filterTemplate( $path, 'single', self::POST_TYPE );
	} // method DNC_PostType_Offer::filterSingleTemplate
	
	/**
	 * Inserts our archive template into the selection process
	 *
	 * @param $path Path to our caller's chosen template file
	 * @return string The path our caller will return to its caller
	 */
	/* protected */ function filterArchiveTemplate( $path ){
		if( !is_post_type_archive( self::POST_TYPE ) )
			return $path;
		
		return DNC_Plugin_Offers::filterTemplate( $path, 'archive', self::POST_TYPE );
	} // method DNC_PostType_Offer::filterArchiveTemplate
	
	/**
	 * Emit a package manager item, selecting the given product entry
	 *
	 * @param array $products A mapping of product-id => product-label
	 * @param int $selectedID The id in the mapping to display as selected
	 * @param bool $template Mark this entry as a template
	 * @return void
	 */
	private static function emitPackageManagerItem0( array $products, $selectedID, $valueRegular, $valueCurrent, $valueEmi, $valueUrl, $template = false ){
?>
<li <?php if( $template ) echo 'id="dnc-wc-offers-package-manager-template" '; ?>class="dnc-wc-offers-package-manager-item dnc-wc-offers-container dnc-wc-offers-widget">
	<div class="dnc-wc-offers-row">
		<h4 class="dnc-wc-offers-package-manager-heading dnc-wc-offers-heading"><?php _e( 'Package: ', 'dnc-wc-offers' ); ?></h4>
		<div class="dnc-wc-offers-sub-controls">
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Promote Package', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-promote button"><span class="screen-reader-text"><?php _e( 'Promote Package', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-arrow-up"></span></button></p>
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Demote Package', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-demote button"><span class="screen-reader-text"><?php _e( 'Demote Package', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-arrow-down"></span></button></p>
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Remove Package', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-package-manager-remove button"><span class="screen-reader-text"><?php _e( 'Remove Package', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-no"></span></button></p>
		</div> <!-- .dnc-wc-offers-sub-controls -->
	</div> <!-- .dnc-wc-offers-row -->
	
	<p class="dnc-wc-offers-package-manager-field">
		<label class="dnc-wc-offers-package-manager-label"><span class="screen-reader-text"><?php _e( 'Product for Package', 'dnc-wc-offers' ); ?> </span>
			<select name="<?php echo self::FIELD_NAME_PACKAGE_MANAGER_PRODUCT_ID; ?>[]" class="dnc-wc-offers-package-manager-input">
<?php
		foreach( $products as $productID => $productLabel ){
?>
				<option value="<?php echo esc_attr( $productID ); ?>"<?php selected( $selectedID, $productID ); ?>><?php echo $productLabel; ?></option>
<?php
		} // foreach $productID => $productLabel
?>
			</select> <!-- .dnc-wc-offers-package-manager-input -->
		</label> <!-- .dnc-wc-offers-package-manager-label -->
	</p> <!-- .dnc-wc-offers-package-manager-field -->
	
	<p class="dnc-wc-offers-package-manager-field">
		<label class="dnc-wc-offers-package-manager-label"><span><?php _e( 'Total Price Value', 'dnc-wc-offers' ); ?> </span>
			<input name="<?php echo self::FIELD_NAME_PACKAGE_MANAGER_VALUE_REGULAR; ?>[]" value="<?php echo esc_attr( $valueRegular ); ?>" class="dnc-wc-offers-package-manager-input" />
	</p> <!-- .dnc-wc-offers-package-manager-field -->
	
	<p class="dnc-wc-offers-package-manager-field">
		<label class="dnc-wc-offers-package-manager-label"><span><?php _e( 'Current Price', 'dnc-wc-offers' ); ?> </span>
			<input name="<?php echo self::FIELD_NAME_PACKAGE_MANAGER_VALUE_CURRENT; ?>[]" value="<?php echo esc_attr( $valueCurrent ); ?>" class="dnc-wc-offers-package-manager-input" />
	</p>
      <?php
       global $wpdb;
       global $post;
       
			//$qry = "select * from hp_offer_data where offer_post_id = '".$postID."'";
			 $myrows = $wpdb->get_row( "select * from hp_offer_data where offer_post_id = '".$post->ID."' and package_id = '".$selectedID."'" );
       
      ?>
  	<p class="dnc-wc-offers-package-manager-field">
		<label class="dnc-wc-offers-package-manager-label"><span><?php _e( 'Button Label', 'dnc-wc-offers' ); ?> </span>
			<input name="<?php echo self::FIELD_NAME_PACKAGE_MANAGER_VALUE_EMI; ?>[]" value="<?php echo $myrows->emi; ?>" class="dnc-wc-offers-package-manager-input" />
	</p>
  
  	<p class="dnc-wc-offers-package-manager-field">
		<label class="dnc-wc-offers-package-manager-label"><span><?php _e( 'Button Link Url', 'dnc-wc-offers' ); ?> </span>
			<input name="<?php echo self::FIELD_NAME_PACKAGE_MANAGER_VALUE_URL; ?>[]" value="<?php echo  $myrows->url ; ?>" class="dnc-wc-offers-package-manager-input" />
	</p>
   <!-- .dnc-wc-offers-package-manager-field -->
</li> <!-- .dnc-wc-offers-package-manager-item -->
<?php
	} // method DNC_PostType_Offer::emitPackageManagerItem0
	
	private function get0( $name ){
		$methodName = MZ_Strings::propertyNameGetter( $name );
		
		return method_exists( $this, $methodName ) ? $this->$methodName() : $this->$name;
	} // method DNC_Post_Offer::get0
	
	/**
	 * Emit a package editor item, which contains a sub-editor for any items
	 *
	 * @param DNC_Offer_Package|null $package
	 * @return void
	 */
	private static function emitPackageEditorItem0( DNC_Offer_Package $package = null ){
		static $count = 0;
		
		if( null === $package ){
			$index = 'template';
			$id = 'dnc-wc-offers-package-editor-template';
		}else
			$index = $count++;
?>
<li <?php if( !empty( $id ) ) printf( 'id="%s" ', esc_attr( $id ) ); ?>class="dnc-wc-offers-package-editor-item dnc-wc-offers-container dnc-wc-offers-widget">
	<div class="dnc-wc-offers-row">
		<h2 class="dnc-wc-offers-package-editor-heading dnc-wc-offers-heading"><?php _e( 'Package: ', 'dnc-wc-offers' ); ?></h2>
		
		<div class="dnc-wc-offers-sub-controls">
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Promote Package', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-promote button"><span class="screen-reader-text"><?php _e( 'Promote Package', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-arrow-up"></span></button></p>
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Demote Package', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-demote button"><span class="screen-reader-text"><?php _e( 'Demote Package', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-arrow-down"></span></button></p>
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Show/Hide Package', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-toggle button"><span class="screen-reader-text"><?php _e( 'Show/Hide Package', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-hidden"></span></button></p>
		</div> <!-- .dnc-wc-offers-sub-controls -->
	</div> <!-- .dnc-wc-offers-row -->
	
	<div class="dnc-wc-offers-package-editor-body dnc-wc-offers-body">
		<div class="dnc-wc-offers-package-editor-intro-widget dnc-wc-offers-container dnc-wc-offers-widget">
			<div class="dnc-wc-offers-row">
				<h3 class="dnc-wc-offers-heading"><?php _e( 'Package Intro Content', 'dnc-wc-offers' ); ?></h3>
				<div class="dnc-wc-offers-sub-controls">
					<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Show/Hide Package Intro Editor', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-toggle button"><span class="screen-reader-text"><?php _e( 'Show/Hide Package Intro Editor', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-hidden"></span></button></p>
				</div> <!-- .dnc-wc-offers-sub-controls -->
			</div> <!-- .dnc-wc-offers-row -->
			
			<div class="dnc-wc-offers-body">
<?php
		wp_editor( ( ( $package instanceof DNC_Offer_Package ) ? $package->introContent : '' ), sprintf( 'dnc_wc_offers_package_intro_%s', $index ), array(
			'textarea_name' => '',
			'drag_drop_upload' => true,
			'tabfocus-elements' => 'content-html,save-post',
			'editor_height' => 200,
			'tinymce' => array(
				'resize' => false,
				'wp_autoresize_on' => false,
				'add_unload_trigger' => false,
			),
		) );
?>
			</div> <!-- .dnc-wc-offers-body -->
		</div> <!-- .dnc-wc-offers-package-editor-intro-widget -->
		
		<div class="dnc-wc-offers-items-editor dnc-wc-offers-widget">
			<h2 class="dnc-wc-offers-heading"><?php _e( 'Items Editor', 'dnc-wc-offers' ); ?></h3>
			
			<ol class="dnc-wc-offers-items-editor-list">
<?php
		if( $package instanceof DNC_Offer_Package )
			foreach( $package->items as $item )
				self::emitItemEditorItem0( $item );
?>
			</ol> <!-- .dnc-wc-offers-items-editor-list -->
			
			<p class="dnc-wc-offers-items-editor-control"><button type="button" title="<?php _e( 'Add Item', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-items-editor-add button-primary button"><?php _e( 'Add Item', 'dnc-wc-offers' ); ?></button></p>
		</div> <!-- .dnc-wc-offers-items-editor -->
		
		<div class="dnc-wc-offers-package-editor-outro-widget dnc-wc-offers-container dnc-wc-offers-widget">
			<div class="dnc-wc-offers-row">
				<h3 class="dnc-wc-offers-heading"><?php _e( 'Package Outro Content', 'dnc-wc-offers' ); ?></h3>
				<div class="dnc-wc-offers-sub-controls">
					<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Show/Hide Package Outro Editor', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-toggle button"><span class="screen-reader-text"><?php _e( 'Show/Hide Package Outro Editor', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-hidden"></span></button></p>
				</div> <!-- .dnc-wc-offers-sub-controls -->
			</div> <!-- .dnc-wc-offers-row -->
			
			<div class="dnc-wc-offers-body">
<?php
		wp_editor( ( ( $package instanceof DNC_Offer_Package ) ? $package->outroContent : '' ), sprintf( 'dnc_wc_offers_package_outro_%s', $index ), array(
			'textarea_name' => '',
			'drag_drop_upload' => true,
			'tabfocus-elements' => 'content-html,save-post',
			'editor_height' => 200,
			'tinymce' => array(
				'resize' => false,
				'wp_autoresize_on' => false,
				'add_unload_trigger' => false,
			),
		) );
?>
			</div> <!-- .dnc-wc-offers-body -->
		</div> <!-- .dnc-wc-offers-package-editor-outro-widget -->
	</div> <!-- .dnc-wc-offers-package-editor-body -->
</li> <!-- .dnc-wc-offers-package-editor-item -->
<?php
	} // method DNC_PostType_Offer::emitPackageEditorItem0
	
	private static function emitItemEditorItem0( DNC_Offer_Item $item = null ){
		static $count = 0;
		
		if( $item instanceof DNC_Offer_Item ){
			$index = $count++;
			$title = $item->title;
			$format = $item->format;
			$value = $item->value;
			$content = $item->content;
			$bonus = $item->bonus;
			$dividerType = $item->dividerType;
		}else{
			$index = 'template';
			$title = $format = $value = $content = '';
			$id = 'dnc-wc-offers-item-editor-template';
			$bonus = 0;
			$dividerType = 0;
		} // endif !( $item instanceof DNC_Offer_Item )
?>
<li <?php if( !empty( $id ) ) printf( 'id="%s" ', esc_attr( $id ) ); ?>class="dnc-wc-offers-item-editor dnc-wc-offers-container dnc-wc-offers-widget">
	<div class="dnc-wc-offers-row">
		<h4 class="dnc-wc-offers-item-editor-heading dnc-wc-offers-heading"><?php _e( 'Item: ', 'dnc-wc-offers' ); ?></h4>
		
		<div class="dnc-wc-offers-sub-controls">
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Promote Item', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-promote button"><span class="screen-reader-text"><?php _e( 'Promote Item', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-arrow-up"></span></button></p>
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Demote Item', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-demote button"><span class="screen-reader-text"><?php _e( 'Demote Item', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-arrow-down"></span></button></p>
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Show/Hide Item', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-toggle button"><span class="screen-reader-text"><?php _e( 'Show/Hide Item', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-hidden"></span></button></p>
			<p class="dnc-wc-offers-sub-control"><button type="button" title="<?php _e( 'Remove Item', 'dnc-wc-offers' ); ?>" class="dnc-wc-offers-item-editor-remove button"><span class="screen-reader-text"><?php _e( 'Remove Item', 'dnc-wc-offers' ); ?> </span><span class="dashicons dashicons-no"></span></button></p>
		</div> <!-- .dnc-wc-offers-item-editor-sub-controls -->
	</div> <!-- .dnc-wc-offers-row -->
	
	<div class="dnc-wc-offers-item-editor-body dnc-wc-offers-body">
		<div class="dnc-wc-offers-row items-start flex-wrap">
			<div class="dnc-wc-offers-item-editor-field dnc-wc-offers-item-editor-field-bonus">
				<h4 class="dnc-wc-offers-field-heading"><?php _e( 'Item Type', 'dnc-wc-offers' ); ?></h4>
				<p><label class="dnc-wc-offers-label-checkbox"><input type="checkbox" name="" value="1" class="dnc-wc-offers-item-editor-bonus-input"<?php checked( 1, $bonus ); ?> /> <?php _e( 'Is Bonus Item', 'dnc-wc-offers' ); ?></label></p>
			</div> <!-- .dnc-wc-offers-item-editor-field-bonus -->
			
			<div class="dnc-wc-offers-item-editor-field dnc-wc-offers-item-editor-field-divider-type">
				<h4 class="dnc-wc-offers-field-heading"><?php _e( 'Trailing Divider Type', 'dnc-wc-offers' ); ?></h4>
				<p><select class="dnc-wc-offers-item-editor-divider-type-input">
<?php
		foreach( DNC_Offer_Item::getDividerTypesInfo() as $dividerIndex => $dividerInfo ){
?>
					<option value="<?php echo esc_attr( $dividerIndex ); ?>"<?php selected( $dividerType, $dividerIndex ); ?>><?php echo $dividerInfo[ 'label' ]; ?></option>
<?php
		} // foreach $dividerType => $dividerInfo
?>
				</select></p>
			</div> <!-- .dnc-wc-offers-item-editor-field-divider-type -->
		</div> <!-- .dnc-wc-offers-row -->
		
		<div class="dnc-wc-offers-item-editor-field dnc-wc-offers-item-editor-field-title">
			<h4 class="screen-reader-text"><?php _e( 'Item Title', 'dnc-wc-offers' ); ?></h4>
			<p><input type="text" name="" value="<?php echo esc_attr( $title ); ?>" class="widefat dnc-wc-offers-item-editor-title-input" placeholder="<?php _e( 'Item Title', 'dnc-wc-offers' ); ?>" /></p>
		</div> <!-- .dnc-wc-offers-item-editor-field-title -->
		
		<div class="dnc-wc-offers-item-editor-field dnc-wc-offers-item-editor-field-format">
			<h4 class="screen-reader-text"><?php _e( 'Deliverable Format', 'dnc-wc-offers' ); ?></h4>
			<p><input type="text" name="" value="<?php echo esc_attr( $format ); ?>" class="widefat dnc-wc-offers-item-editor-format-input" placeholder="<?php _e( 'Deliverable Format', 'dnc-wc-offers' ); ?>" /></p>
		</div> <!-- .dnc-wc-offers-item-editor-field-format -->
		
		<div class="dnc-wc-offers-item-editor-field dnc-wc-offers-item-editor-field-value">
			<h4 class="screen-reader-text"><?php _e( 'Item Value', 'dnc-wc-offers' ); ?></h4>
			<p><input type="text" name="" value="<?php echo esc_attr( $value ); ?>" class="widefat dnc-wc-offers-item-editor-value-input" placeholder="<?php _e( 'Item Value', 'dnc-wc-offers' ); ?>" /></p>
		</div> <!-- .dnc-wc-offers-item-editor-field-value -->

		<div class="dnc-wc-offers-item-editor-field dnc-wc-offers-item-editor-field-content">
			<h4 class="screen-reader-text"><?php _e( 'Item Content', 'dnc-wc-offers' ); ?></h4>
<?php
		wp_editor( $content, sprintf( 'dnc_wc_offers_item_editor_content_%s', $index ), array(
			'textarea_name' => '',
			'drag_drop_upload' => true,
			'tabfocus-elements' => 'content-html,save-post',
			'editor_height' => 300,
			'tinymce' => array(
				'resize' => false,
				'wp_autoresize_on' => false,
				'add_unload_trigger' => false,
			),
		) );
?>
		</div> <!-- .dnc-wc-offers-item-editor-field-content -->
	</div> <!-- .dnc-wc-offers-item-editor-body -->
</li> <!-- .dnc-wc-offers-item-editor -->
<?php
	} // method DNC_PostType_Offer::emitItemEditorItem0
	
	/**
	 * Fetch a mapping of all the available WooCommerce Products
	 * @return array Mapping of id => label
	 */
	private static function getWCProducts0(){
		$factory = new WC_Product_Factory();
		$query = new WP_Query( array(
			'post_type' => 'product',
			'posts_per_page' => -1,
		) );
		
		$ret = array();
		
		foreach( $query->posts as $post ){
			$product = $factory->get_product( $post );
			
			if( !( $product instanceof WC_Product ) )
				continue;
			
			$ret[ $post->ID ] = sprintf( '%s [%s]', get_the_title( $post ), $product->get_price() );
		} // foreach $post
		
		$ret[ 0 ] = __( '&lt;No Product&gt;', 'dnc-wc-offers' );
		asort( $ret, SORT_LOCALE_STRING );
		
		return $ret;
	} // method DNC_PostType_Offer::getWCProducts0
} // class DNC_PostType_Offer
