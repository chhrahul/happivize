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
 * Metabox Field for image attachment
 */
class DNC_MetaBoxField_Image extends DNC_MetaBoxField{
	private static /* array( string ) */ $gLabels = array(
		0 => 'select-image',
		1 => 'no-image',
		'set' => 'set-image',
		'remove' => 'remove-image',
		'reset' => 'reset-image',
	);
	
	public function __construct( array $args ){
		$args[ 'type' ] = 'image';
		$labels = isset( $args[ 'labels' ] ) ? $args[ 'labels' ] : array();
		
		foreach( self::$gLabels as $label )
			if( !isset( $labels[ $label ] ) )
				$labels[ $label ] = mb_convert_case( mb_ereg_replace( '-', ' ', $label ), MB_CASE_TITLE );
		
		$args[ 'labels' ] = $labels;
		
		parent::__construct( $args );
	} // method DNC_MetaBoxField_Image::__construct
	
	protected function emit( $name, $value ){
		add_thickbox();
		wp_enqueue_media();
		add_action( 'admin_footer', array( $this, 'actionAdminFooter' ), 100 );
		
		$value = absint( $value );
		$thumbURL = esc_attr( (string)wp_get_attachment_url( $value ) );
?>
<div class="dnc-metas-image-box">
	<p>
		<span class="dnc-metas-image-label"><?php echo esc_attr( $this->label ); ?></span>
		<img class="dnc-metas-image-thumb" src="<?php echo $thumbURL; ?>" data-default="<?php echo $thumbURL; ?>" />
		<span class="dnc-metas-image-status"></span>
<?php
		foreach( self::$gLabels as $class => $prop ){
			if( !is_string( $class ) )
				continue;
			
			$label = esc_attr( $this->labels[ $prop ] );
?>
		<a href="#" title="<?php echo $label; ?>" class="dnc-metas-image-link dnc-metas-image-<?php echo $class; ?>"><?php echo $label; ?></a>
<?php
		} // foreach $class => $prop
?>
		<input class="dnc-metas-image-id" type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>" data-default="<?php echo $value; ?>" />
	</p>
</div> <!-- .dnc-metas-image-box -->
<?php
	} // method DNC_MetaBoxField_Image::emit
	
	protected function sanitize( $name, $value ){
		$post = get_post( $value );
		
		if( !( $post instanceof WP_Post ) )
			return 0;
		
		if( 'attachment' !== $post->post_type )
			return 0;
		
		return $post->ID;
	} // method DNC_MetaBoxField_Image::sanitize
	
	/* package-private */ function actionAdminFooter(){
		if( !wp_script_is( 'jquery', 'done' ) )
			return;
		
		$labelSelectImage = esc_attr( $this->labels[ 'select-image' ] );
?>
<script type="text/javascript">
	/* <![CDATA[ */
	;
	if( window.jQuery ){
		window.jQuery( function( $ ){
			"use strict";
			
			function createFrame( $box ){
				var ret = wp.media( {
					title: '<?php echo $labelSelectImage; ?>',
					button: {
						text: '<?php echo $labelSelectImage; ?>',
					},
					multiple: false,
				} );
				
				ret.on( 'select', function(){
					var imageInfo = ret.state().get( 'selection' ).first().toJSON();
					
					setState( $box, imageInfo.url, imageInfo.id );
				} );
				
				return ret;
			} // function createFrame
			
			function getState( e ){
				var $box = $( e.target ).parents( '.dnc-metas-image-box' ).first();
				if( 0 === $box.length )
					return null;
				
				var frame = $box.data( 'dnc-metas-frame' );
				if( !frame )
					$box.data( 'dnc-metas-frame', createFrame( $box ) );
				
				return $box;
			} // function getState
			
			function setState( $box, url, id ){
				id = parseInt( id );
				var $thumb = $box.find( '.dnc-metas-image-thumb' );
				var $id = $box.find( '.dnc-metas-image-id' );
				
				var changed = false;
				
				if( $thumb.attr( 'src' ) !== url ){
					changed = true;
					$thumb.attr( 'src', url );
				} // endif $thumb.attr( 'src' ) !== url
				
				if( parseInt( $id.val() ) !== id ){
					changed = true;
					$id.val( id );
				} // endif parseInt( $id.val() ) !== id
				
				$box.toggleClass( 'dnc-metas-image-changed', changed );
			} // function setState
			
			function onSet( e ){
				e.preventDefault();
				
				var $box = getState( e );
				if( null !== $box )
					$box.data( 'dnc-metas-frame' ).open();
			} // function onSet
			
			function onRemove( e ){
				e.preventDefault();
				
				var $box = getState( e );
				if( null !== $box )
					setState( $box, '', 0 );
			} // function onRemove
			
			function onReset( e ){
				e.preventDefault();
				
				var $box = getState( e );
				if( null === $box )
					return;
				
				setState( $box, $box.find( '.dnc-metas-image-thumb' ).data( 'default' ), $box.find( '.dnc-metas-image-id' ).data( 'default' ) );
			} // function onReset
			
			$( document )
				.on( 'click', '.dnc-metas-image-set', onSet )
				.on( 'click', '.dnc-metas-image-remove', onRemove )
				.on( 'click', '.dnc-metas-image-reset', onReset )
			;
			
			$( 'head' ).append( '<style type="text/css">' +
'.dnc-metas-image-label, .dnc-metas-image-status, .dnc-metas-image-link { display: block; }' +
'.dnc-metas-image-reset { display: none; }' +
'.dnc-metas-image-changed .dnc-metas-image-reset { display: block; }' +
'.dnc-metas-image-thumb { display: block; max-width: 100%; }' +
'.dnc-metas-image-thumb[src=""] ~ .dnc-metas-image-status:before { content: "<?php echo esc_attr( $this->labels[ 'no-image' ] ); ?>"; font-style: italic; }' +
'.dnc-metas-image-thumb[src=""] ~ .dnc-metas-image-remove { display: none; }' +
'</style>' );
		} );
	} // endif window.jQuery
	/* ]]> */
</script>
<?php
	} // method DNC_MetaBoxField_Image::actionAdminFooter
} // class DNC_MetaBoxField_Image
