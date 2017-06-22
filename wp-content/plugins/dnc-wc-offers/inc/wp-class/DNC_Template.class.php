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
 * General helper functions for Wordpress
 */
class DNC_Template{
	/**
	 * Compliements OBJECT, ARRAY_A and ARRAY_N
	 */
	const IDS = 'IDS';
	
	const SUFFIX_GRAVATAR_MD5 = '@md5.gravatar.com';
	
	const UNMAPPED_ACTION_DEFAULT = 'untouched';
	const UNMAPPED_ACTION_THROW = 'throw';
	const UNMAPPED_ACTION_EMPTY = 'empty';
	const UNMAPPED_ACTION_UNTOUCHED = 'untouched';

	private static /* array( string ) */ $userByFields = array(
		'email',
		'slug',
		// 'login', // Not enabling, for "security" reasons
	);
	
	private function __construct(){}
	
	/**
	 * Derives the url for the given absolute path
	 *
	 * @return string|false
	 */
	public static function urlForPath( $path ){
		$path = wp_normalize_path( $path );
		
		if( 0 !== mb_strpos( $path, ABSPATH ) )
			return false;
		
		$path = mb_substr( $path, mb_strlen( ABSPATH ) );
		
		return home_url( $path );
	} // method DNC_Template::urlForPath
	
	/**
	 * Returns a timestamped url for the given path, based on its modified time
	 *
	 * @param string $path
	 * @param boolean $asArray
	 * @return array|string|false
	 */
	public static function versionedURLForPath( $path, $asArray = false ){
		$url = self::urlForPath( $path );
		
		if( !is_string( $url ) )
			return false;
		
		$stat = @stat( $path );
		
		if( !is_array( $stat ) )
			return false;
		
		$mtime = isset( $stat[ 'mtime' ] ) ? $stat[ 'mtime' ] : null;
		
		if( $asArray ){
			$ret = array(
				'url' => $url,
				'mtime' => $mtime, // Chosing this over compact(), as the latter does not intern nulls into the resulting array
			);
			
			return array_merge( array_values( $ret ), $ret );
		} // endif $asArray
		
		return $url . '?ver=' . urlencode( $mtime );
	} // method DNC_Template::versionedURLForPath
	
	public static function enqueueScripts( array $args ){
		foreach( $args as $handle => $info ){
			if( is_object( $info ) )
				$info = (array)$info;
			else if( !is_array( $info ) )
				$info = array( 'file' => (string)$info );
			
			if( empty( $info ) )
				continue;
			
			$depends = (array)MZ_Arrays::isget( 'depends', $info, array() );
			$footer = (bool)MZ_Arrays::isget( 'footer', $info, false );
			
			if( !empty( $info[ 'file' ] ) )
				self::enqueueScriptFile( $handle, $info[ 'file' ], $depends, $footer );
			else if( !empty( $info[ 'url' ] ) )
				wp_enqueue_script( $handle, $info[ 'url' ], $depends, null, $footer );
		} // foreach $handle => $info
	} // method DNC_Template::enqueueScripts
	
	public static function enqueueScriptFile( $handle, $file, array $dependsOn = array(), $inFooter = false ){
		$comps = self::versionedURLForPath( $file, true );
		
		if( is_array( $comps ) )
			wp_enqueue_script( $handle, $comps[ 'url' ], $dependsOn, $comps[ 'mtime' ], $inFooter );
		else if( WP_DEBUG )
			error_log( sprintf( '[%s] Unable to locate file: %s', __METHOD__, $file ) );
	} // method DNC_Template::enqueueScriptFile
	
	public static function enqueueStyles( array $args ){
		foreach( $args as $handle => $info ){
			if( is_object( $info ) )
				$info = (array)$info;
			else if( !is_array( $info ) )
				$info = array( 'file' => (string)$info );
			
			if( empty( $info ) )
				continue;
			
			$depends = (array)MZ_Arrays::isget( 'depends', $info, array() );
			$media = (string)MZ_Arrays::isget( 'media', $info, 'all' );
			
			if( !empty( $info[ 'file' ] ) )
				self::enqueueStyleFile( $handle, $info[ 'file' ], $depends, $media );
			else if( !empty( $info[ 'url' ] ) )
				wp_enqueue_style( $handle, $info[ 'url' ], $depends, null, $media );
		} // foreach $handle => $info
	} // method DNC_Template::enqueueStyles
	
	public static function enqueueStyleFile( $handle, $file, array $dependsOn = array(), $media = 'all' ){
		$comps = self::versionedURLForPath( $file, true );
		
		if( is_array( $comps ) )
			wp_enqueue_style( $handle, $comps[ 'url' ], $dependsOn, $comps[ 'mtime' ], $media );
		else if( WP_DEBUG )
			error_log( sprintf( '[%s] Unable to locate file: %s', __METHOD__, $file ) );
	} // method DNC_Template::enqueueStyleFile
	
	public static function getUsersFromAuthors( $authors, $allowAll = true ){
		// Break out the semicolon-delimited list, trim the elements, remove empty entries
		if( is_string( $authors ) )
			$authors = MZ_Strings::mb_explode( ';', $authors );
		
		$authors = array_filter( array_map( sprintf( '%s::cleanupAuthor0', __CLASS__ ), (array)$authors ) );
		
		// No one specified?
		if( empty( $authors ) ){
			if( $allowAll ) // Just grab all of the authors
				return get_users( array(
					'who' => 'authors',
					'fields' => 'all',
				) );
			
			return array();
		} // endif empty( $authors )
		
		// Run through each entry, and look up its associated WP_User
		$ret = array();
		
		foreach( $authors as $author ){
			$user = self::getUserFromAuthor( $author );
			
			if( $user instanceof WP_User )
				$ret[] = $user; // TODO At present, does not prevent duplicates
			else
				MZ_Debug::log_if( MZ_Debug::LEVEL_DEBUG, '[%s] [NOTICE] Could not locate user: %s', __CLASS__, $author );
		} // foreach $author
		
		return $ret;
	} // method DNC_Template::getUsersFromAuthors
	
	/**
	 * Normalizes the given list(s) of CSS classes.  Each argument provided may be presented as wither a string[] or a space-delimited string.  Returns a normalized CSS class attribute-value
	 * 
	 * @param string[]|string $class,... The classes to be processed
	 * @return string The normalized & simplified class attribute-value
	 */
	public static function prepareClasses( $classes ){
		$args = func_get_args();
		$args = array_map( sprintf( '%s::prepareClasses0', __CLASS__ ), $args ); // Normalize everything to string[]
		$args = call_user_func_array( 'array_merge', $args ); // merge all the disparate arrays into one string[]
		$args = MZ_Arrays::ordered_unique_strings( array_filter( $args ) ); // filter out empty, and non-unique
		$args = implode( ' ', $args ); // implode to space-delimited string
		
		return $args;
	} // method DNC_Template::prepareClasses
	
	/* package-private */ static function prepareClasses0( $classes ){
		if( is_string( $classes ) )
			return explode( ' ', $classes );
		
		return is_array( $classes ) ? array_map( 'MZ_Strings::toStringQuiet', $classes ) : array();
	} // method DNC_Template::prepareClasses0
	
	private static function extractUserFromString0( $author ){
		// We don't interfere with an explicit request for a gravatar
		if( self::SUFFIX_GRAVATAR_MD5 !== mb_substr( $author, -mb_strlen( self::SUFFIX_GRAVATAR_MD5 ) ) ){
			foreach( self::$userByFields as $field ){
				$user = get_user_by( $field, $author );
				
				if( $user instanceof WP_User )
					return $user;
			} // foreach $field
		} // endif self::SUFFIX_GRAVATAR_MD5 !== mb_substr( $author, -mb_strlen( self::SUFFIX_GRAVATAR_MD5 ) )
		
		return false;
	} // method DNC_Template::extractUserFromString0
	
	public static function isComment( $arg ){
		return is_object( $src ) && isset( $src->comment_ID );
	} // method DNC_Template::isComment
	
	public static function getUserFromAuthor( $author ){
		if( is_numeric( $author ) )
			return get_user_by( 'id', absint( $author ) );
		
		if( is_string( $author ) )
			return self::extractUserFromString0( $author );
		
		if( $author instanceof WP_User )
			return $author;
		
		if( $author instanceof WP_Post )
			return get_user_by( 'id', (int)$author->post_author );
		
		if( self::isComment( $author ) ){
			$author = get_comment( $author ); // Get full comment
			
			if( !empty( $author->comment_type ) ){
				if( in_array( $author->comment_type, (array)apply_filters( 'get_avatar_comment_types', array( 'comment' ) ) ) ){
					if( !empty( $author->user_id ) )
						return get_user_by( 'id', (int)$author->user_id );
					
					if( !empty( $author->comment_author_email ) )
						return get_user_by( 'email', $author->comment_author_email );
				} // endif in_array( $author->comment_type, (array)$allowedCommentTypes )
			} // endif !empty( $author->comment_type )
		} // endif self::isComment( $author )
		
		return false;
	} // method DNC_Template::getUserFromAuthor
	
	public static function loadTemplate( $path, array $_context = array() ){
		// BEGIN: Straight stolen from wordpress core's load_template()
		global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

		if( is_array( $wp_query->query_vars ) )
			extract( $wp_query->query_vars, EXTR_SKIP );

		if( isset( $s ) )
			$s = esc_attr( $s );
		// END: Straight stolen from wordpress core's load_template()
		
		extract( $_context, EXTR_SKIP );
		require $path;
	} // method DNC_Template::loadTemplate
	
	public static function getURLForThemeFile( $file ){
		if( empty( $file ) || !@is_file( get_template_directory() . $file ) )
			return false;
		
		return esc_url( get_template_directory_uri() . $file );
	} // method DNC_Template::getURLForThemeFile
	
	public static function getPostFormat( $post = null ){
		$format = get_post_format( $post );
		
		if( false === $format )
			$format = get_post_type( $post );
		
		return $format;
	} // method DNC_Template::getPostFormat
	
	public static function isEmbeddedPost( $post = null ){
		$postObject = get_post( $post, OBJECT, 'raw' );
		
		if( !( $postObject instanceof WP_Post ) ){
			error_log( sprintf( '[%s] Invalid post ID/object: %s', var_export( $post, true ) ) );
			return null;
		} // endif !( $postObject instanceof WP_Post )
		
		return get_queried_object_id() !== $postObject->ID;
	} // method DNC_Template::isEmbeddedPost
	
	public static function getTemplatePart( $slug, $name = null ){
		if( empty( $slug ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Empty slug provided to getTemplatePart()', __CLASS__ ) );
			
			return;
		} // endif empty( $slug )
		
		do_action( sprintf( 'get_template_part_%s', $slug ), $slug, (string)$name );
		
		$args = func_get_args();
		$template = self::locateTemplatePart0( $args );
		
		if( !empty( $template ) )
			load_template( $template, false );
		else if( WP_DEBUG )
			error_log( sprintf( '[%s] Unable to locate template part: %s', __METHOD__, implode( ', ', $args ) ) );
	} // method DNC_Template::getTemplatePart
	
	public static function locateTemplatePart( $slug ){
		if( empty( $slug ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Empty slug provided to locateTemplatePart()', __CLASS__ ) );
			
			return '';
		} // endif empty( $slug )
		
		return self::locateTemplatePart0( func_get_args() );
	} // method DNC_Template::locateTemplatePart
	
	public static function termToSlug( $term ){
		if( is_object( $term ) )
			return property_exists( $term, 'slug' ) ? $term->slug : null;
		
		if( is_array( $term ) )
			return isset( $term[ 'slug' ] ) ? $term[ 'slug' ] : null;
		
		return null;
	} // method DNC_Template::termToSlug
	
	public static function termsToSlugs( array $terms ){
		return array_filter( array_map( sprintf( '%s::termToSlug', __CLASS__ ), $terms ) );
	} // method DNC_Template::termsToSlugs
	
	public static function locateTemplate( $templateNames, $load = false, $requireOnce = true ){
		$template = self::locateTemplate0( $templateNames );
		
		if( $load && !empty( $template ) )
			load_template( $template, $requireOnce );
		
		return $template;
	} // method DNC_Template::locateTemplate
	
	public static function getTheArchiveTitle(){
		if( is_category() || is_tag() )
			$title = single_cat_title( '', false );
		else if( is_author() )
			$title = sprintf( '<span class="vcard">%s</span>', get_the_author() );
		else if( is_year() )
			$title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
		else if( is_month() )
			$title = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
		else if( is_day() )
			$title = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
		else if( is_post_type_archive() )
			$title = post_type_archive_title( '', false );
		else if( is_tax() ){
			$title = single_term_title( '', false );
			
			if( is_tax( 'post_format' ) ){
				foreach( array(
					'post-format-aside' => _x( 'Asides', 'post format archive title' ),
					'post-format-gallery' => _x( 'Galleries', 'post format archive title' ),
					'post-format-image' => _x( 'Images', 'post format archive title' ),
					'post-format-video' => _x( 'Videos', 'post format archive title' ),
					'post-format-quote' => _x( 'Quotes', 'post format archive title' ),
					'post-format-link' => _x( 'Links', 'post format archive title' ),
					'post-format-status' => _x( 'Statuses', 'post format archive title' ),
					'post-format-audio' => _x( 'Audio', 'post format archive title' ),
					'post-format-char' => _x( 'Chats', 'post format archive title' ),
				) as $taxSlug => $taxTitle )
					if( is_tax( 'post_format', $taxSlug ) )
						$title = $taxTitle;
				// As opposed to WP, we won't be potentially leaving this state w/ an empty title.  It was handled above
			} // endif is_tax( 'post_format' )
		}else
			$title = __( 'Archives' );
		
		return apply_filters( 'get_the_archive_title', $title );
	} // method DNC_Template::getTheArchiveTitle
	
	public static function theArchiveTitle( $before = '', $after = '' ){
		$title = self::getTheArchiveTitle();
		
		if( !empty( $title ) )
			echo $before . $title . $after;
	} // method DNC_Template::theArchiveTitle
	
	public static function postToID( $post ){
		return self::xToID( $post, 'ID' );
	} // method DNC_Template::postToID
	
	public static function termToID( $term ){
		return self::xToID( $term, 'term_id' );
	} // method DNC_Template::termToID
	
	public static function xToID( $x, $fieldName ){
		$fieldName = (string)$fieldName;
		if( '' === $fieldName )
			return 0;
		
		if( is_object( $x ) )
			$x = isset( $x->$fieldName ) ? $x->$fieldName : 0;
		else if( is_array( $x ) )
			$x = isset( $x[ $fieldName ] ) ? $x[ $fieldName ] : 0;
		
		return absint( $x );
	} // method DNC_Template::xToID
	
	public static function sprintfNamed( $format, array $mapping, $unmappedAction = null ){
		return mb_ereg_replace_callback( '(?<!\%)\%\{([^:}]+)(?:\:([^}]+))?\}', function( array $matches ) use ( $mapping, $unmappedAction ){
			list( , $named, $format ) = $matches;
			
			if( isset( $mapping[ $named ] ) )
				return $mapping[ $named ];
			
			switch( $unmappedAction ){
				case self::UNMAPPED_ACTION_EMPTY:
					return '';
				case self::UNMAPPED_ACTION_THROW:
					throw new LogicException( sprintf( '[%s] No such name: %s', __METHOD__, $named ) );
				case self::UNMAPPED_ACTION_UNTOUCHED:
				default:
					break;
			} // switch $unmappedAction
			
			return $matches[ 0 ];
		}, $format );
	} // method DNC_Template::sprintfNamed
	
	public static function printfNamed( $format, array $mapping, $unmappedAction = null ){
		echo self::sprintfNamed( $format, $mapping, $unmappedAction );
	} // method DNC_Template::printfNamed
	
	/**
	 * @param array $sizeMap
	 * @return void
	 */
	public static function registerImageSizes( array $sizeMap ){
		foreach( $sizeMap as $id => $size )
			add_image_size( $id, $size[ 'width' ], $size[ 'height' ], MZ_Arrays::isget( 'crop', $size, false ) );
		
		add_filter( 'image_size_names_choose', function( array $arg ) use ( $sizeMap ){
			return array_merge( $arg, array_filter( array_map( function( array $size ){
				return MZ_Arrays::isget( 'label', $size, false );
			}, $sizeMap ) ) );
		} );
	} // method DNC_Template::registerImageSizes
	
	/**
	 * Shim for getting the current screen, handles the case where get_current_screen is undefined.
	 *
	 * @see get_current_screen
	 * @return WP_Screen|false
	 */
	public static function getCurrentScreen(){
		if( !function_exists( 'get_current_screen' ) )
			return false;
		
		$screen = get_current_screen();
		
		return ( $screen instanceof WP_Screen ) ? $screen : false;
	} // method DNC_Template::getCurrentScreen
	
	/**
	 * Returns an array where all the keys are normalized to have only lowercase letters.
	 * 
	 * Steps taken (in no particular order):
	 * <ul>
	 * <li>Lowercase key</li>
	 * <li>strip all sequences of non-alnum characters</li>
	 * </ul>
	 *
	 * @param array $args
	 * @return array
	 */
	public static function normalizeArguments( array $args ){
		$ret = array();
		foreach( $args as $key => $value )
			$ret[ mb_strtolower( mb_ereg_replace( '[^\p{Alnum}]', '', $key ) ) ] = $value;
		
		return $ret;
	} // method DNC_Template::normalizeArguments
	
	/**
	 * Maps the current pseudo
	 *
	 * Recognized in $args:
	 * <dl>
	 * <dt>id</dt><dd><i>mixed</i> The <em>thing</em> to map on</dd>
	 * <dt>allowLoopPost</dt><dd><i>bool</i> Whether to prefer the current-loop's post over the queried object</dd>
	 * <dt>onID</dt><dd><i>callable</i> The mapping performed if the current pseudo can be resolved to an ID.  Is passed said ID</dd>
	 * <dt>onType</dt><dd><i>callable</i> The mapping performed if the current pseudo can be resolved to a post type.  Is passed said post type</dd>
	 * <dt>onDefault</dt><dd><i>callable</i> The mapping performed if no higher-priority mapping matches. Is passed no data</dd>
	 * </dl>
	 * Note: Mappings listed in order of priority.  Only highest possible mapping is performed.  Mappings returning <code>null</code> are considered to not match
	 * Note: Keys of $args will be normalized {@see DNC_Template::normalizeArguments()}
	 *
	 * @param array $args The rules to filter by
	 * @return mixed Returns whatever the first matching mapping does, or <code>null</code> if no mappings match
	 */
	public static function mapPseudo( array $args = array() ){
		$args = self::normalizeArguments( $args );
		$id = self::getPseudoID( MZ_Arrays::isget( 'id', $args, null ), !!MZ_Arrays::isget( 'allowlooppost', $args, false ) );
		
		if( ( 0 < $id ) && isset( $args[ 'onid' ] ) ){
			$mapping = $args[ 'onid' ];
			
			if( is_callable( $mapping ) ){
				$result = call_user_func( $mapping, $id );
				
				if( null !== $result )
					return $result;
			} // endif is_callable( $mapping )
		} // endif ( 0 < $id ) && isset( $args[ 'onid' ] )
		
		$type = self::getPseudoType( $id ); // If an ID was found, use it
		if( !empty( $type ) && isset( $args[ 'ontype' ] ) ){
			$mapping = $args[ 'ontype' ];
			
			if( is_callable( $mapping ) ){
				$result = call_user_func( $mapping, $type );
				
				if( null != $result )
					return $result;
			} // endif is_callable( $mapping )
		} // endif !empty( $type ) && isset( $args[ 'ontype' ] )
		
		if( isset( $args[ 'ondefault' ] ) ){
			$mapping = $args[ 'ondefault' ];
			
			if( is_callable( $mapping ) )
				return call_user_func( $mapping ); // Doesn't matter if it returns null
		} // endif isset( $args[ 'ondefault' ] )
		
		return null;
	} // method DNC_Template::mapPseudo
	
	/**
	 * Extracts and returns the ID from $id, if given, or the current-loop post's ID (if $allowLoopPost and in_the_loop() ), or the queried object's ID
	 * Obviously, archives would return a Pseudo ID of 0.  Because Wordpress.
	 *
	 * @param mixed $id The <em>thing</em> to extract an ID from (Default: null)
	 * @param bool $allowLoopPost Whether to prefer the current-loop's post if it is available (Default: false)
	 * @return int|null
	 */
	public static function getPseudoID( $id = null, $allowLoopPost = false ){
		if( is_object( $id ) )
			$id = isset( $id->ID ) ? $id->ID : 0;
		
		if( is_array( $id ) )
			$id = MZ_Arrays::isget( 'ID', $id, 0 );
		
		$id = absint( $id );
		if( empty( $id ) )
			$id = ( $allowLoopPost && in_the_loop() ) ? get_the_ID() : get_queried_object_id();
		
		return $id;
	} // method DNC_Template::getPseudoID
	
	/**
	 * Gets the post type for the current pseudo
	 *
	 * @param mixed $id The <em>thing</em> to extract an ID from (Default: null)
	 * @param bool $allowLoopPost Whether to prefer the current-loop's post if it is available (Default: false)
	 * @return string|null The post type for the current pseudo
	 */
	public static function getPseudoType( $id = null, $allowLoopPost = false ){
		global $wp_query;
		
		$id = self::getPseudoID( $id, $allowLoopPost );
		if( ( 0 < $id ) && !( ( $id === $wp_query->queried_object_id ) && $wp_query->is_posts_page ) ){ // If $id maps to the posts_page, we'll handle it below
			$post = get_post( $id );
			
			if( $post instanceof WP_Post )
				return $post->post_type;
		} // endif ( 0 < $id ) && !( ( $id === $wp_query->queried_object_id ) && $wp_query->is_posts_page )
		
		$postType = is_home() ? 'post' : MZ_Arrays::isget( 'post_type', $wp_query->query_vars, 'post' );
		
		return post_type_exists( $postType ) ? $postType : null;
	} // method DNC_Template::getPseudoType
	
	public static function getUpPostLink( $anchorFormat, $textFormat ){
		$post = get_post();
		if( !( $post instanceof WP_Post ) )
			return '';
		
		$postType = $post->post_type;
		if( 'post' === $postType ){
			$showOnFront = get_option( 'show_on_front' );
			$pageForPosts = get_option( 'page_for_posts' );
			
			if( ( 'page' === $showOnFront ) && $pageForPosts ){
				$page = get_post( $pageForPosts );
				$link = get_permalink( $pageForPosts );
				$title = $page->post_title;
			}else{
				$link = get_home_url();
				$title = get_bloginfo( 'name' );
			} // endif !( ( 'page' === $showOnFront ) && $pageForPosts )
		}else{
			$link = get_post_type_archive_link( $postType );
			if( false === $link )
				return '';
			
			$postTypeObject = get_post_type_object( $post->post_type );
			if( !is_object( $postTypeObject ) )
				return '';
			
			$title = $postTypeObject->labels->name;
		} // endif 'post' !== $postType
		
		if( empty( $link ) )
			return '';
		
		if( empty( $title ) )
			$title = __( 'Archive' );
		$title = apply_filters( 'the_title', $title );
		$date = mysql2date( get_option( 'date_format' ), $post->post_date );
		
		$anchor = sprintf( '<a href="%s" rel="archives">%s</a>', $link, str_replace( array(
			'%title',
			'%date',
		), array(
			$title,
			$date,
		), $textFormat ) );
		
		return str_replace( '%link', $anchor, $anchorFormat );
	} // method DNC_Template::getUpPostLink
	
	public static function getThePostNavigation( $args = array() ){
		$args = wp_parse_args( $args, array(
			'prev_text' => '%title',
			'next_text' => '%title',
			'up_text' => '%title',
			'in_same_term' => false,
			'excluded_terms' => '',
			'taxonomy' => 'category',
			'screen_reader_text' => __( 'Post navigation' ),
			'nav_class' => 'post-navigation',
		) );
		
		$found = 0;
		$links = array();
		$funcArgs = array(
			null,
			null,
			$args[ 'in_same_term' ],
			$args[ 'excluded_terms' ],
			$args[ 'taxonomy' ],
		);
		foreach( array(
			'previous' => 'get_previous_post_link',
			'up' => sprintf( '%s::getUpPostLink', __CLASS__ ),
			'next' => 'get_next_post_link',
		) as $key => $func ){
			$funcArgs[ 0 ] = sprintf( '<div class="nav-%s">%%link</div>', $key );
			$funcArgs[ 1 ] = sprintf( '<span class="nav-text">%s</span>', $args[ mb_substr( $key, 0, 4 ) . '_text' ] );
			$tmp = call_user_func_array( $func, $funcArgs );
			if( !empty( $tmp ) ){
				++$found;
				$links[] = $tmp;
			}else
				$links[] = sprintf( '<div class="nav-%s"></div>', $key );
		} // foreach $key => $func
		
		if( 0 === $found )
			return '';
		
		$screenReaderText = empty( $args[ 'screen_reader_text' ] ) ? __( 'Post navigation' ) : $args[ 'screen_reader_text' ];
		$navClass = sanitize_html_class( empty( $args[ 'nav_class' ] ) ? 'post-navigation' : $args[ 'nav_class' ] );
		
		$template = '
<nav class="navigation %1$s" role="navigation">
	<h2 class="screen-reader-text">%2$s</h2>
	<div class="nav-links">%3$s</div>
</nav>';
		$template = apply_filters( 'navigation_markup_template', $template, $navClass );
		
		return sprintf( $template, $navClass, esc_html( $screenReaderText ), implode( '', $links ) );
	} // method DNC_Template::getThePostNavigation
	
	public static function thePostNavigation( $args = array() ){
		echo self::getThePostNavigation( $args );
	} // method DNC_Template::thePostNavigation
	
	/**
	 * @returns WP_Error|string|false
	 */
	public static function getTheTermsList( $post = null, $taxonomy = null, $makeLinks = null ){
		$post = get_post( $post );
		
		if( !( $post instanceof WP_Post ) )
			return;
		
		$taxonomy = (string)$taxonomy;
		$terms = get_the_terms( $post->ID, $taxonomy );
		
		if( is_wp_error( $terms ) )
			return $terms;
		
		if( empty( $terms ) )
			return false;
		
		$taxonomyHTML = esc_attr( $taxonomy );
		
		if( (bool)$makeLinks ){
			$terms = array_map( function( $term ) use ( $taxonomy, $taxonomyHTML ){
				$url = get_term_link( $term, $taxonomy );
				
				if( is_wp_error( $url ) )
					return $url;
				
				return sprintf( '<li class="term-item %1$s-item"><a href="%3$s" rel="tag" class="term-link %1$s-link">%2$s</a></li>', $taxonomyHTML, $term->name, esc_url( $url ) );
			}, $terms );
			$bad = array_filter( $terms, 'is_wp_error' );
			
			if( !empty( $bad ) )
				return reset( $bad ); // Only bother with first
			
			unset( $bad );
		}else
			$terms = array_map( function( $term ) use ( $taxonomyHTML ){
				return sprintf( '<li class="term-item %1$s-item"><span class="term-link %1$s-link">%2$s</span></li>', $taxonomyHTML, $term->name );
			}, $terms );
		
		return sprintf( '<ul class="terms-list %s-list">%s</ul>', $taxonomyHTML, implode( '', $terms ) );
	} // method DNC_Template::getTheTermsList
	
	/**
	 * @returns WP_Error|bool
	 */
	public static function theTermsList( $post = null, $taxonomy = null, $makeLinks = null ){
		$tmp = self::getTheTermsList( $post, $taxonomy, $makeLinks );
		
		if( !is_string( $tmp ) )
			return $tmp;
		
		echo $tmp;
		
		return true;
	} // method DNC_Template::theTermsList
	
	/* package-private */ static function cleanupAuthor0( $author ){
		if( is_object( $author ) )
			return $author;
		
		if( is_array( $author ) )
			return false;
		
		return MZ_Strings::mb_trim( (string)$author );
	} // method DNC_Template::cleanupAuthor0
	
	/* package-private */ static function filterSingleTemplate( $arg ){
		$object = get_queried_object();
		
		$templates = array( 'single' );
		
		if( !empty( $object->post_type ) ){
			$templates[] = $object->post_type;
			$templates[] = $object->post_name;
		} // endif !empty( $object->post_type )
		
		$template = call_user_func_array( 'DNC_Template::locateTemplatePart', $templates );
		
		return empty( $template ) ? $arg : $template;
	} // method DNC_Template::filterSingleTemplate
	
	/* package-private */ static function filterArchiveTemplate( $arg ){
		$templates = array( 'archive' );
		
		$postTypes = array_filter( (array)get_query_var( 'post_type' ) );
		if( 1 === count( $postTypes ) )
			$templates[] = reset( $postTypes );
		
		$template = call_user_func_array( 'DNC_Template::locateTemplatePart', $templates );
		
		return empty( $template ) ? $arg : $template;
	} // method DNC_Template::filterArchiveTemplate
	
	private static function locateTemplatePart0( array $args ){
		$args = array_map( 'strval', $args );
		
		$templateNames = array();
		
		$length = count( $args );
		while( !empty( $args ) ){
			if( '' === $args[ --$length ] )
				continue;
			
			$templateNames[] = implode( '-', $args ) . '.php';
			array_pop( $args );
		} // while !empty( $args )
		
		return self::locateTemplate0( $templateNames );
	} // method DNC_Template::locateTemplatePart0
	
	private static function locateTemplate0( $templateNames ){
		if( empty( $templateNames ) )
			return '';
		
		foreach( array_filter( (array)$templateNames ) as $templateName ){
			foreach( self::fetchTemplateLocations0() as $templateLocation ){
				$template = $templateLocation . $templateName;
				
				if( file_exists( $template ) )
					return $template;
			} // foreach $templateLocation
		} // foreach $templateName
		
		return '';
	} // method DNC_Template::locateTemplate0
	
	/**
	 * By caching this, we're <strong>not</strong> guaranteeing that we'll call the filter every time a template is loaded
	 */
	private static function fetchTemplateLocations0(){
		static $filterName = 'locate_template';
		static $lastFilters = null;
		static $lastLocations = null;
		
		global $wp_filter;
		
		if( !isset( $wp_filter[ $filterName ] ) ){
			// Short-circuit
			return array_map( 'trailingslashit', array(
				get_stylesheet_directory(),
				get_template_directory(),
			) );
		} // endif !isset( $wp_filter[ $filterName ] )
		
		if( $lastFilters !== $wp_filter[ $filterName ] ){
			$lastFilters = $wp_filter[ $filterName ];
			$lastLocations = array_map( 'trailingslashit', array_merge( array(
				get_stylesheet_directory(),
				get_template_directory(),
			), array_filter( (array)apply_filters( $filterName, array() ) ) ) );
		} // endif $lastFilters !== $wp_filter
		
		return $lastLocations;
	} // method DNC_Template::fetchTemplateLocations0
} // class DNC_Template

if( function_exists( 'add_filter' ) || !defined( 'DEBUG' ) ){
	add_filter( 'single_template', 'DNC_Template::filterSingleTemplate' );
	add_filter( 'archive_template', 'DNC_Template::filterArchiveTemplate' );
} // endif function_exists( 'add_filter' ) || !defined( 'DEBUG' )
