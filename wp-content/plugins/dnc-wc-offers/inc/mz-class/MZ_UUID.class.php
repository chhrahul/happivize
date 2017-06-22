<?php

/*
Copyright (c) 2015 Martovianus Zolus

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
 * Provides options for generating UUIDs
 * Adapted from {@link http://php.net/manual/en/function.uniqid.php#94959}.  Original license unknown.
 */

final class MZ_UUID {
	const INVALID = false;
	
	const FLAG_IS_BINARY = 1;
	const SHIFT_VERSION = 1;
	
	const PATTERN_CANONICAL_WRAP = '\A\{.*\}\z';
	const PATTERN_CANONICAL = '\A[0-9a-fA-F]{8}(?:-[0-9a-fA-F]{4}){3}-[0-9a-fA-F]{12}\z';
	const PATTERN_HEX = '\A([0-9a-fA-F]{8})([0-9a-fA-F]{4})([0-9a-fA-F]{4})([0-9a-fA-F]{4})([0-9a-fA-F]{12})\z';
	const REGEX_OPTIONS = 'mr';
	
	const INDEX_VARIANT = 3;
	const INDEX_VERSION = 2;
	
	const CANONICAL_SEPARATOR = '-';
	
	const VARIANT_MASK = 0xB; // 1100
	const VARIANT_VALUE = 0x8; // 1000
	
	const LENGTH_BINARY = 16; // 128 bit / 8 bit/Byte
	
	private /* string */ $raw;
	private /* int */ $version = null;
	
	/**
	 * Supports:
	 * <ul>
	 * <li>16-byte raw binary UUIDs</li>
	 * <li>32-character raw hex UUIDs (with optional {} wrapping)</li>
	 * <li>36-character "canonical" hex UUIDs (with optional {} wrapping)</li>
	 * </ul>
	 * @throws InvalidArgumentException if $raw isn't a valid UUID
	 */
	public function __construct( $raw ){
		$tmp = self::canonicalize0( $raw );
		if( false === $tmp )
			throw new InvalidArgumentException( sprintf( '[%s] Invalid UUID: %s', __METHOD__, var_export( $raw, true ) ) );
		
		$this->raw = $tmp;
	} // method MZ_UUID::__construct
	
	/**
	 * @returns the canonical form of this UUID
	 */
	public function __toString(){
		return $this->raw;
	} // method MZ_UUID::__toString
	
	/**
	 * @returns the raw hex-string form of this UUID
	 */
	public function toHex(){
		return MZ_Strings::mb_str_replace( self::CANONICAL_SEPARATOR, '', $this->raw );
	} // method MZ_UUID::toHex
	
	/**
	 * @returns the raw binary form of this UUID
	 */
	public function toBinary(){
		return hex2bin( $this->toHex() );
	} // method MZ_UUID::toBinary
	
	/**
	 * Extracts the version info and returns it.  Returns <samp>0</samp> if unable to determine version
	 */
	public function getVersion(){
		$version = $this->version;
		
		if( null === $version ){
			$parts = MZ_Strings::mb_explode( '-', $this->raw );
			
			foreach( array(
				self::INDEX_VARIANT => 'variant',
				self::INDEX_VERSION => 'version',
			) as $index => $var )
				$$var = self::extractFirstNibble0( $parts[ $index ] );
			
			$version = ( self::VARIANT_VALUE === ( $variant & self::VARIANT_MASK ) ) ? ( $version << self::SHIFT_VERSION ) : 0;
			$this->version = $version;
		} // endif null === $version
		
		return $version;
	} // method MZ_UUID::getVersion
	
	/**
	 * @returns MZ_UUID, or <samp>false</samp> on error
	 */
	public static function make( $raw ){
		try{
			return new self( $raw );
		}catch( InvalidArgumentException $e ){
			return false;
		} // catch InvalidArgumentException $e
	} // method MZ_UUID::make
	
	/**
	 * Generates a version 3 (md5-based deterministic) UUID using the given $namespace and $name
	 */
	public static function v3( self $namespace, $name ){
		return new self( self::makeNamespaced0( $namespace, $name, 'md5' ) );
	} // method MZ_UUID::v3
	
	/**
	 * Generates a version 4 (pseudo-random) UUID
	 */
	public static function v4(){
		// Try the "good" sources of randomness first
		foreach( array(
			'random_bytes',
			'openssl_random_pseudo_bytes',
		) as $func ){
			if( function_exists( $func ) ){
				$binary = call_user_func( $func, self::LENGTH_BINARY );
				if( false !== $binary )
					break;
			} // endif function_exists( $func )
		} // foreach $func
		
		// Fall back to mt_rand
		if( empty( $binary ) ){
			assert( 'mt_getrandmax() >= 0xFFFF' );
			$hex = '';
			for( $i = self::LENGTH_BINARY >> 1; $i > 0; --$i )
				$hex .= sprintf( '%04x', mt_rand( 0, 0xFFFF ) );
		}else
			$hex = bin2hex( $binary );
		
		return new self( self::overlayVersion0( $hex, 4 ) );
	} // method MZ_UUID::v4
	
	/**
	 * Generates a verion 5 (sha1-based dterministic) UUID using the given $namespace and $name
	 */
	public static function v5( self $namespace, $name ){
		return new self( self::makeNamespaced0( $namespace, $name, 'sha1' ) );
	} // method MZ_UUID::v5
	
	public static function normalizeString( $arg ){
		if( $arg instanceof MZ_UUID )
			return $arg->__toString();
		
		$tmp = self::make( $arg );
		return ( $tmp instanceof self ) ? $tmp->__toString() : '';
	} // method MZ_UUID::normalizeString
	
	
	/* package-private */ static function mapToBinary( self $uuid ){
		return $uuid->toBinary();
	} // method MZ_UUID::mapToBinary
	
	/* package-private */ static function mapToString( self $uuid ){
		return $uuid->__toString();
	} // method MZ_UUID::mapToString
	
	/* package-private */ static function mapToHex( self $uuid ){
		return $uuid->toHex();
	} // method MZ_UUID::mapToHex
	
	/**
	 * Attempts to split a hex string into its customary groupings.  Returns the array of those groupings if able, else <samp>false</samp>.
	 */
	private static function splitHex0( $hex ){
		$regs = array();
		return mb_ereg( self::PATTERN_HEX, $hex, $regs ) ? array_slice( $regs, 1 ) : false;
	} // method MZ_UUID::splitHex0
	
	/**
	 * Attempts to parse $arg into a "canonical" UUID string
	 * @returns string, or <samp>false</samp> on failure
	 */
	private static function canonicalize0( $arg ){
		// If a raw binary UUID, convert to hex
		if( self::LENGTH_BINARY === MZ_Strings::byte_len( $arg ) )
			$arg = bin2hex( $arg );
		
		// If it's wrapped, strip the wrapping
		if( mb_ereg_match( self::PATTERN_CANONICAL_WRAP, $arg ) )
			$arg = mb_substr( $arg, 1, -1 );
		
		// If a hex UUID, convert to canonical
		$regs = self::splitHex0( $arg );
		if( is_array( $regs ) )
			$arg = implode( self::CANONICAL_SEPARATOR, $regs );
		
		return mb_ereg_match( self::PATTERN_CANONICAL, $arg ) ? $arg : false;
	} // method MZ_UUID::canonicalize0
	
	/**
	 * Extracts the leading nibble and returns its integer value
	 */
	private static function extractFirstNibble0( $hex ){
		assert( 'mb_ereg_match( \'^[a-fA-F0-9]+$\', $hex )' );
		
		return intval( mb_substr( $hex, 0, 1 ), 16 );
	} // method MZ_UUID::extractFirstNibble0
	
	/**
	 * Sets the version and variant stamps on the hex-string
	 */
	private static function overlayVersion0( $hex, $version ){
		assert( 'mb_ereg_match( \'^[a-fA-F0-9]{32}$\', $hex )' );
		assert( 'is_int( $version )' );
		
		// Take apart
		$parts = self::splitHex0( $hex );
		
		// Set version
		$parts[ self::INDEX_VERSION ] = dechex( $version & 0xF ) . mb_substr( $parts[ self::INDEX_VERSION ], 1 );
		
		// Set variant
		$variant = $parts[ self::INDEX_VARIANT ];
		$parts[ self::INDEX_VARIANT ] = dechex( ( self::extractFirstNibble0( $variant ) & ~self::VARIANT_MASK ) | self::VARIANT_VALUE ) . mb_substr( $variant, 1 );
		
		// Glue back together as canonical
		return implode( '-', $parts );
	} // method MZ_UUID::overlayVersion0
	
	/**
	 * Performs a salted hash of $name (with $namespace's binary form as the salt) and overlays the relevant version
	 */
	private static function makeNamespaced0( self $namespace, $name, $hash_func ){
		assert( 'is_callable( $hash_func )' );
		
		$namespace = $namespace->toBinary();
		$hash = call_user_func( $hash_func, ( $namespace . $name ) );
		
		if( false === $hash )
			return false;
		
		// Keep only the <code>self::LENGTH_BINARY << 1</code> most-significant characters
		return self::overlayVersion0( mb_substr( $hash, 0, ( self::LENGTH_BINARY << 1 ) ), 3 );
	} // method MZ_UUID::makeNamespaced0
} // class MZ_UUID

MZ_Assure::library_only( __FILE__ );
