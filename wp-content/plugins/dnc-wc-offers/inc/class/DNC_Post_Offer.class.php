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
 * Wrapper for <i>dnc-wc-offer</i>-typed WP_Posts
 */
class DNC_Post_Offer extends DNC_Post{
	private /* string */ $post_type = 'dnc-wc-offer';
	private /* lazy DNC_Offer_Package[] */ $packages;
	private /* lazy string */ $outroContent;
	private /* lazy int */ $speakerMugshot;
	private /* lazy int */ $speakerName;
	private /* lazy int */ $speakerTitle;
	private /* lazy int */ $speakerBio;
	
	public function __construct( $post ){
		parent::__construct( $post );
	} // method DNC_Post_Offer::__construct
	
	public function __isset( $name ){
		if( property_exists( $this, $name ) )
			return !is_null( $this->get0( $name ) );
		
		return parent::__isset( $name );
	} // method DNC_Post_Offer::__isset
	
	public function __get( $name ){
		if( property_exists( $this, $name ) )
			return $this->get0( $name );
		
		return parent::__get( $name );
	} // method DNC_Post_Offer::__get
	
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
	
	public function getPackages(){
		$tmp = $this->packages;
		
		if( null === $tmp )
			$this->packages = $tmp = self::normalizePackages( get_post_meta( $this->ID, $this->getMetaKeyForProperty( 'packages' ), true ) );
		
		return $tmp;
	} // method DNC_Post_Offer::getPackages
	
	public function setPackages( array $packages ){
		$new = self::normalizePackages( $packages );
		
		if( count( $packages ) !== count( $new ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Invalid DNC_Offer_Package[]: %s', __METHOD__, var_export( $packages, true ) ) );
			
			return;
		} // endif $packages !== $new
		
		if( $this->getPackages() === $new )
			return;
		
		update_metadata( 'post', $this->ID, $this->getMetaKeyForProperty( 'packages' ), $new );
		$this->packages = $new;
	} // method DNC_Post_Offer::setPackages
	
	public function getOutroContent(){
		$tmp = $this->outroContent;
		
		if( null === $tmp )
			$this->outroContent = $tmp = self::normalizeString( get_post_meta( $this->ID, $this->getMetaKeyForProperty( 'outroContent' ), true ) );
		
		return $tmp;
	} // method DNC_Post_Offer::getOutroContent
	
	public function setOutroContent( $arg ){
		$new = self::normalizeString( $arg );
		
		if( $this->getOutroContent() === $new )
			return;
		
		update_metadata( 'post', $this->ID, $this->getMetaKeyForProperty( 'outroContent' ), $new );
		$this->outroContent = $new;
	} // method DNC_Post_Offer::setOutroContent
	
	/**
	 * Lazily fetches the speaker's currently set mugshot
	 *
	 * @return int
	 */
	public function getSpeakerMugshot(){
		$tmp = $this->speakerMugshot;
		
		if( null === $tmp ){
			$postType = DNC_PostType_Offer::getInstance();
			$this->speakerMugshot = $tmp = absint( $postType->metaboxSpeaker->getFieldValue( DNC_PostType_Offer::META_SPEAKER_MUGSHOT, $this->post ) );
		} // endif null === $tmp
		
		return $tmp;
	} // method DNC_Post_Offer::getSpeakerMugshot
	
	/**
	 * Sets the speaker's mugshot
	 *
	 * @param int $id
	 * @return void
	 */
	public function setSpeakerMugshot( $id ){
		$new = absint( $id );
		
		if( $this->getSpeakerMugshot() === $new )
			return;
		
		$postType = DNC_PostType_Offer::getInstance();
		$postType->metaboxSpeaker->setFieldValue( DNC_PostType_Offer::META_SPEAKER_MUGSHOT, $new, $this->post );
		$this->speakerMugshot = $new;
	} // method DNC_Post_Offer::setSpeakerMugshot
	
	/**
	 * Lazily fetches the speaker's currently set name
	 *
	 * @return string
	 */
	public function getSpeakerName(){
		$tmp = $this->speakerName;
		
		if( null === $tmp ){
			$postType = DNC_PostType_Offer::getInstance();
			$this->speakerName = $tmp = self::normalizeString( $postType->metaboxSpeaker->getFieldValue( DNC_PostType_Offer::META_SPEAKER_NAME, $this->post ) );
		} // endif null === $tmp
		
		return $tmp;
	} // method DNC_Post_Offer::getSpeakerName
	
	/**
	 * Sets the speaker's name
	 *
	 * @param int $id
	 * @return void
	 */
	public function setSpeakerName( $id ){
		$new = self::normalizeString( $id );
		
		if( $this->getSpeakerName() === $new )
			return;
		
		$postType = DNC_PostType_Offer::getInstance();
		$postType->metaboxSpeaker->setFieldValue( DNC_PostType_Offer::META_SPEAKER_NAME, $new, $this->post );
		$this->speakerName = $new;
	} // method DNC_Post_Offer::setSpeakerName
	
	/**
	 * Lazily fetches the speaker's currently set title
	 *
	 * @return string
	 */
	public function getSpeakerTitle(){
		$tmp = $this->speakerTitle;
		
		if( null === $tmp ){
			$postType = DNC_PostType_Offer::getInstance();
			$this->speakerTitle = $tmp = self::normalizeString( $postType->metaboxSpeaker->getFieldValue( DNC_PostType_Offer::META_SPEAKER_TITLE, $this->post ) );
		} // endif null === $tmp
		
		return $tmp;
	} // method DNC_Post_Offer::getSpeakerTitle
	
	/**
	 * Sets the speaker's title
	 *
	 * @param int $id
	 * @return void
	 */
	public function setSpeakerTitle( $id ){
		$new = self::normalizeString( $id );
		
		if( $this->getSpeakerTitle() === $new )
			return;
		
		$postType = DNC_PostType_Offer::getInstance();
		$postType->metaboxSpeaker->setFieldValue( DNC_PostType_Offer::META_SPEAKER_TITLE, $new, $this->post );
		$this->speakerTitle = $new;
	} // method DNC_Post_Offer::setSpeakerTitle
	
	/**
	 * Lazily fetches the speaker's currently set bio
	 *
	 * @return string
	 */
	public function getSpeakerBio(){
		$tmp = $this->speakerBio;
		
		if( null === $tmp ){
			$postType = DNC_PostType_Offer::getInstance();
			$this->speakerBio = $tmp = self::normalizeString( $postType->metaboxSpeaker->getFieldValue( DNC_PostType_Offer::META_SPEAKER_BIO, $this->post ) );
		} // endif null === $tmp
		
		return $tmp;
	} // method DNC_Post_Offer::getSpeakerBio
	
	/**
	 * Sets the speaker's bio
	 *
	 * @param int $id
	 * @return void
	 */
	public function setSpeakerBio( $id ){
		$new = self::normalizeString( $id );
		
		if( $this->getSpeakerBio() === $new )
			return;
		
		$postType = DNC_PostType_Offer::getInstance();
		$postType->metaboxSpeaker->setFieldValue( DNC_PostType_Offer::META_SPEAKER_BIO, $new, $this->post );
		$this->speakerBio = $new;
	} // method DNC_Post_Offer::setSpeakerBio
	
	/**
	 * Restore this post from the given revision
	 *
	 * @param DNC_Post_Offer $revision
	 * @return void
	 */
	/* package-private */ static function restoreFrom( $revision ){
		$this->setPackages( $revision->getPackages() );
		$this->setOutroContent( $revision->getOutroContent() );
		$this->setSpeakerMugshot( $revision->getSpeakerMugshot() );
		$this->setSpeakerName( $revision->getSpeakerName() );
		$this->setSpeakerTitle( $revision->getSpeakerTitle() );
		$this->setSpeakerBio( $revision->getSpeakerBio() );
	} // method DNC_Post_Offer::restoreFrom
	
	/* package-private */ static function sanitizeString( $arg, $field, $context ){
		return sanitize_post_field( $field, $arg, 0, $context );
	} // method DNC_Post_Offer::sanitizeString
	
	/* package-private */ static function normalizeString( $arg ){
		return MZ_Strings::mb_trim( MZ_Strings::toStringQuiet( $arg ) );
	} // method DNC_Post_Offer::normalizeString
	
	/* package-private */ static function normalizePackages( $arg ){
		if( !is_array( $arg ) )
			return array();
		
		return array_filter( $arg, array( __CLASS__, 'isOfferPackage' ) );
	} // method DNC_Post_Offer::normalizePackages
	
	/* package-private */ static function isOfferPackage( $arg ){
		return $arg instanceof DNC_Offer_Package;
	} // method DNC_Post_Offer::isOfferPackage
	
	private function get0( $name ){
		$methodName = MZ_Strings::propertyNameGetter( $name );
		
		return method_exists( $this, $methodName ) ? $this->$methodName() : $this->$name;
	} // method DNC_Post_Offer::get0
} // class DNC_Post_Offer
