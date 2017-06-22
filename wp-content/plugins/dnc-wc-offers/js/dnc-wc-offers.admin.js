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
 * Manages the various editors for dnc-wc-offer CPTs
 */
;
window.jQuery( function( $ ){
	/**
	 * Polyfill taken from https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/JSON#Polyfill
	 */
	if (!window.JSON) {
	  window.JSON = {
		 parse: function(sJSON) { return eval('(' + sJSON + ')'); },
		 stringify: (function () {
			var toString = Object.prototype.toString;
			var isArray = Array.isArray || function (a) { return toString.call(a) === '[object Array]'; };
			var escMap = {'"': '\\"', '\\': '\\\\', '\b': '\\b', '\f': '\\f', '\n': '\\n', '\r': '\\r', '\t': '\\t'};
			var escFunc = function (m) { return escMap[m] || '\\u' + (m.charCodeAt(0) + 0x10000).toString(16).substr(1); };
			var escRE = /[\\"\u0000-\u001F\u2028\u2029]/g;
			return function stringify(value) {
			  if (value == null) {
				 return 'null';
			  } else if (typeof value === 'number') {
				 return isFinite(value) ? value.toString() : 'null';
			  } else if (typeof value === 'boolean') {
				 return value.toString();
			  } else if (typeof value === 'object') {
				 if (typeof value.toJSON === 'function') {
					return stringify(value.toJSON());
				 } else if (isArray(value)) {
					var res = '[';
					for (var i = 0; i < value.length; i++)
					  res += (i ? ', ' : '') + stringify(value[i]);
					return res + ']';
				 } else if (toString.call(value) === '[object Object]') {
					var tmp = [];
					for (var k in value) {
					  if (value.hasOwnProperty(k))
						 tmp.push(stringify(k) + ': ' + stringify(value[k]));
					}
					return '{' + tmp.join(', ') + '}';
				 }
			  }
			  return '"' + value.toString().replace(escRE, escFunc) + '"';
			};
		 })()
	  };
	}
	/*
	 * End Polyfill
	 */
	
	var $MANAGER_TEMPLATE = $( '#dnc-wc-offers-package-manager-template' );
	var $ITEM_TEMPLATE = $( '#dnc-wc-offers-item-editor-template' );
	var $PACKAGE_TEMPLATE = $( '#dnc-wc-offers-package-editor-template' );
	
	var $packageManager = $( '#dnc-wc-offer-package-manager-widget' );
	var $packageEditor = $( '#dnc-wc-offers-package-editor-widget' );
	
	var $packageManagerList = $packageManager.find( '.dnc-wc-offers-package-manager-list' );
	var $packageEditorList = $packageEditor.find( '.dnc-wc-offers-package-editor-list' );
	
	var packageInstanceCount = $packageEditorList.children( '.dnc-wc-offers-package-editor-item' ).length;
	var itemInstanceCount = $packageEditorList.find( '.dnc-wc-offers-item-editor' ).length;
	
	function move( $elem, $anchor, action ){
		if( $anchor.length > 0 )
			$elem[ action ]( $anchor );
	} // function move
	
	function containerOf( elem ){
		return $( elem ).closest( '.dnc-wc-offers-container' );
	} // function containerOf
	
	var TEMPLATE_REGEX = /template(?=$|[ \-_])/;
	
	function prepareTemplate( template, newIndex, where ){
		var $template = $( template ).clone();
		var $where = $( where ).first();
		var ids = {};
		
		if( 0 === $where.length )
			return;
		
		$template.removeAttr( 'id' );
		$template.find( '.upload-editor' ).remove();
		$template.find( '.quicktags-toolbar' ).empty();
		$template.find( '.mce-container' ).first().remove();
		
		$template.find( '[id]' ).each( function(){
			var oldID = this.id;
			var newID = oldID.replace( TEMPLATE_REGEX, newIndex );
			
			this.id = newID;
			
			var $this = $( this );
			
			if( $this.is( 'textarea' ) ){
				$this.css( 'display', '' );
				ids[ newID ] = oldID;
			} // endif $this.is( 'textarea' )
		} );
		
		$template.find( '[class*="template"]' ).each( function(){
			this.className = this.className.replace( TEMPLATE_REGEX, newIndex );
		} );
		
		$.each( [
			'editor',
			'wp-editor-id',
		], function( index, data ){
			$template.find( '[data-' + data + ']' ).each( function(){
				var $this = $( this );
				var oldData = $this.data( data );
				var newData = oldData.replace( TEMPLATE_REGEX, newIndex );
				
				$this.data( data, newData );
				$this.attr( ( 'data-' + data ), newData );
			} );
		} );
		
		$where.append( $template );
		
		$.each( ids, function( newID, oldID ){
			registerEditor( newID, oldID );
		} );
	} // function prepareTemplate
	
	var MODE_HTML = 'html';
	
	function registerEditor( id, templateID ){
		var mceInit = tinyMCEPreInit.mceInit;
		var oldInit = tinymce.settings
		var init = $.extend( {}, mceInit[ templateID ] );
		
		init.body_class = init.body_class.replace( new RegExp( ( '\Q' + templateID + '\E' ), 'g' ), id.replace( '$', '$$' ) );
		init.selector = '#' + id;
		
		tinymce.settings = mceInit[ id ] = init;
		
		try{
			tinymce.execCommand( 'mceAddEditor', false, id );
		}catch( e ){
			console.log( e );
		}finally{
			tinymce.settings = oldInit;
		}
		
		quicktags( {
			id: id,
		} ).constructor._buttonsInit();
		
		var mode = window.getUserSetting( 'editor', MODE_HTML );
		
		switchEditors.go( id, MODE_HTML ); // Ensures that certains scripts set state correctly
		
		if( MODE_HTML !== mode )
			switchEditors.go( id, mode );
	} // function registerEditor
	
	function destroyEditors( region ){
		$( region ).find( 'textarea[id]' ).each( destroyEditor );
	} // function destroyEditors
	
	function destroyEditor( arg ){
		arg = this || arg;
		
		if( !( arg instanceof Object ) )
			return;
		
		var editor = tinymce.editors[ arg.id ];
		
		if( !( editor instanceof Object ) )
			return;
		
		editor.destroy();
		
		// There does not appear to be a way to unlink quicktags
	} // function destroyEditor
	
	function getEditorContent( $editor ){
		if( !$editor.is( 'textarea[id]' ) )
			$editor = $editor.find( 'textarea[id]' );
		
		if( 0 >= $editor.length )
			return '';
		
		if( !( tinymce.editors instanceof Object ) )
			return '';
		
		var $wrap = $editor.closest( '.wp-editor-wrap' );
		
		if( $wrap.hasClass( 'tmce-active' ) ){
			var editor = tinymce.editors[ $editor.get( 0 ).id ];
			
			if( !( editor instanceof Object ) )
				return '';
			
			if( 'function' !== typeof editor.getContent )
				return '';
			
			return editor.getContent();
		} // endif $wrap.hasClass( 'tmce-active' )
		
		return $editor.val();
	} // function getEditorContent
	
	$packageManager
		.on( 'click', '.dnc-wc-offers-package-manager-add', function( e ){
			e.preventDefault();
			
			var $this = $( this );
			var index = ++packageInstanceCount;
			
			prepareTemplate( $MANAGER_TEMPLATE, index, $packageManagerList );
			prepareTemplate( $PACKAGE_TEMPLATE, index, $packageEditorList );
		} )
		.on( 'click', '.dnc-wc-offers-package-manager-remove', function( e ){
			e.preventDefault();
			
			if( window.confirm( $packageManager.data( 'remove-message' ) ) ){
				var $item = containerOf( this );
				var index = $item.index();
				var $editor = $packageEditorList.children( '.dnc-wc-offers-package-editor-item' ).eq( index );
				
				destroyEditors( $editor );
				$item.remove();
				$editor.remove();
			} // endif window.confirm( $packageManager.data( 'remove-message' ) )
		} )
	;
	
	$packageEditor
		.on( 'click', '.dnc-wc-offers-items-editor-add', function( e ){
			e.preventDefault();
			
			var index = ++itemInstanceCount;
			
			prepareTemplate( $ITEM_TEMPLATE, index, $( this ).closest( '.dnc-wc-offers-items-editor' ).find( '.dnc-wc-offers-items-editor-list' ) );
		} )
		.on( 'click', '.dnc-wc-offers-item-editor-remove', function( e ){
			e.preventDefault();
			
			if( window.confirm( $packageEditor.data( 'remove-message' ) ) ){
				var $editor = containerOf( this );
				
				destroyEditors( $editor );
				$editor.remove();
			} // endif window.confirm( $packageEditor.data( 'remove-message' ) )
		} )
	;
	
	var CSS_HIDDEN = {
		display: '',
		visibility: 'hidden',
		overflow: 'hidden',
		margin: 0,
		maxHeight: 0,
	};
	
	var CSS_VISIBLE = {
		display: 'none',
		visibility: '',
		overflow: '',
		margin: '',
		maxHeight: '',
	};
	
	$( '#poststuff' )
		.on( 'click', '.dnc-wc-offers-toggle', function( e ){
			e.preventDefault();
			
			var $button = $( this );
			var $icon = $button.children( 'span.dashicons' );
			var $body = containerOf( $button ).children( '.dnc-wc-offers-body' );
			
			if( $icon.hasClass( 'dashicons-hidden' ) ){
				$body.slideUp( function(){
					$body.css( CSS_HIDDEN );
				} );
			}else
				$body.css( CSS_VISIBLE ).slideDown();
			
			$icon.toggleClass( 'dashicons-hidden dashicons-visibility' );
		} )
		.on( 'click', '.dnc-wc-offers-promote', function( e ){
			e.preventDefault();
			
			var $container = containerOf( this );
			
			move( $container, $container.prev(), 'insertBefore' );
		} )
		.on( 'click', '.dnc-wc-offers-demote', function( e ){
			e.preventDefault();
			
			var $container = containerOf( this );
			
			move( $container, $container.next(), 'insertAfter' );
		} )
	;
	
	function serializeItem(){
		var $item = $( this );
		
		return {
			title: $item.find( '.dnc-wc-offers-item-editor-title-input' ).val(),
			format: $item.find( '.dnc-wc-offers-item-editor-format-input' ).val(),
			value: $item.find( '.dnc-wc-offers-item-editor-value-input' ).val(),
			content: getEditorContent( $item.find( '.dnc-wc-offers-item-editor-field-content' ) ),
			bonus: $item.find( '.dnc-wc-offers-item-editor-bonus-input' ).prop( 'checked' ),
			dividerType: $item.find( '.dnc-wc-offers-item-editor-divider-type-input' ).val(),
		};
	} // function serializeItem
	
	function serializePackage(){
		var $package = $( this );
		
		return {
			introContent: getEditorContent( $package.find( '.dnc-wc-offers-package-editor-intro-widget' ) ),
			outroContent: getEditorContent( $package.find( '.dnc-wc-offers-package-editor-outro-widget' ) ),
			items: $package.find( '.dnc-wc-offers-item-editor' ).map( serializeItem ).get(),
			product: 0,
			valueRegular: '',
			valueCurrent: '',
		};
	} // function serializePackage
	
	$packageEditor.closest( 'form' ).on( 'submit', function( e ){
		var packages = $packageEditorList.find( '.dnc-wc-offers-package-editor-item' ).map( serializePackage ).get();
		var $input = $packageEditor.find( '[name="dnc-wc-offer-package-data"]' );
		
		$packageManagerList.find( '.dnc-wc-offers-package-manager-item' ).each( function( index ){
			var $manager = $( this );
			var pckg = packages[ index ];
			
			pckg.product = $manager.find( '[name="dnc-wc-offer-package-associations[]"]' ).val();
			pckg.valueRegular = $manager.find( '[name="dnc-wc-offer-package-value-regular[]"]' ).val();
			pckg.valueCurrent = $manager.find( '[name="dnc-wc-offer-package-value-current[]"]' ).val();
      pckg.valueUrl = $manager.find( '[name="dnc-wc-offer-package-value-url[]"]' ).val();
      pckg.valueEmi = $manager.find( '[name="dnc-wc-offer-package-value-emi[]"]' ).val();
		} );
		
		try{
			$input.val( JSON.stringify( packages ) );
		}catch( x ){
			console.log( x );
			$input.val( x.toString() );
		}
	} );
} );