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
 * Core library.  Provides functions for:
 * Script access checking,
 * Callable manipulation,
 * Debug/logging,
 * Constant manipulation,
 * Array manipulation,
 * Number manipulation.
 */

final class MZ_Assure{
	/**
	 * @see MZ_Assure::dieWithCode
	 * @deprecated
	 */
	static function die_code( $code, $text = '', $msg = '', $content_type = '' ){
		self::dieWithCode( $code, $text, $msg, $content_type );
	} // method MZ_Assure::die_code
	
	/**
	 * Calls MZ_Assure::fakeDieWithCode to setup headers & body content
	 * Then, dies.  Always dies.  Does not return.
	 * @see MZ_Assure::fakeDieWithCode
	 */
	public static function dieWithCode( $code, $codeName = null, $bodyContent = null, $contentType = null ){
		if( ( null === $bodyContent ) && self::isFailureHTTPStatus( $code ) ){
			$bodyContent = sprintf( 'Status: %s', $code );
			$contentType = null; // Will be patched up below
		} // endif ( null === $bodyContent ) && self::isFailureHTTPStatus( $code )
		
		if( !self::fakeDieWithCode( $code, $codeName, $contentType ) )
			MZ_Debug::log( '[%s] fakeDieWithCode returned false', __CLASS__ );
		
		if( !empty( $bodyContent ) ){
			echo $bodyContent;
			MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, '[%s] Die-with-code {%s}: %s', __CLASS__, $code, $bodyContent );
		} // endif !empty( $bodyContent )
		
		die();
	} // method MZ_Assure::dieWithCode
	
	public static function getHTTPStatusNames(){
		static $ret = null;
		
		if( null === $ret ){
			$tmp = include ( dirname( __FILE__ ) . '/../statuslib-1.0.php' );
			$ret = is_array( $tmp ) ? $tmp : array();
		} // endif null === $ret
		
		return $ret;
	} // method MZ_Assure::getHTTPStatusNames
	
	/**
	 * Setup the necessary headers for the given status code and die, while also providing an appropriate response and content-type to the client
	 */
	public static function fakeDieWithCode( $code, $codeName = null, $contentType = null ){
		$code = self::sanitizeHTTPStatus( $code );
		if( false === $code )
			return false;
		
		if( empty( $codeName ) ){
			$messages = self::getHTTPStatusNames();
			$codeName = MZ_Arrays::isget( $code, $messages, '' );
		} // endif empty( $codeName )
		
		$codeText = sprintf( '%d %s', $code, $codeName );
		
		// Emit headers
		header( sprintf( '%s %s', MZ_Arrays::isget( 'SERVER_PROTOCOL', $_SERVER, 'HTTP/1.1' ), $codeText ), true, $code );
		header( sprintf( 'Status: %s', $codeText ) );
		
		if( null === $contentType )
			$contentType = sprintf( 'text/plain; charset=%s', MZ_Strings::output_encoding() );
		
		if( $contentType )
			header( sprintf( 'Content-Type: %s', $contentType ) );
		
		return true;
	} // method MZ_Assure::fakeDieWithCode
	
	/**
	 * Sanitizes the given HTTP status code.  Checks both type of argument, and range.
	 * If not is_numeric( $code ), returns false.
	 * If $code is outside the range [100, 599], returns false.
	 * Returns (int)$code
	 * 
	 * @returns false|int (See description)
	 * @param $code The HTTP status code to sanitize
	 * @param $emitOnFailure If true, and if $code is not a valid HTTP status code, emit a debugging message with a level of LEVEL_DEBUG
	 */
	public static function sanitizeHTTPStatus( $code, $emitOnFailure = true ){
		if( self::isValidHTTPStatus( $code ) )
			return (int)$code;
		
		if( $emitOnFailure )
			MZ_Debug::log_if( MZ_Debug::LEVEL_DEBUG, '[%s] Invalid HTTP Status: 5s', __CLASS__, $code );
		
		return false;
	} // method MZ_Assure::sanitizeHTTPStatus
	
	/**
	 * Ascertains if the given HTTP status code represents a "failure" condition: Either a 4xx or 5xx result.
	 * By order of priority:
	 * Returns null if $code is not a valid HTTP status code
	 * Returns true if $code is in the 4xx or 5xx range
	 * Returns false
	 *
	 * @returns null|boolean (See description)
	 * @param $code The HTTP status code to check
	 * @param $emitOnFailure If true, and if $code is not a valid HTTP status code in [100, 599], emit a debugging message with a level of LEVEL_DEBUG
	 */
	public static function isFailureHTTPStatus( $code, $emitOnFailure = true ){
		$code = self::sanitizeHTTPStatus( $code, $emitOnFailure );
		
		if( false === $code )
			return null;
		
		assert( '600 > $code' );
		
		return 400 <= $code;
	} // method MZ_Assure::isFailureHTTPStatus
	
	/**
	 * Ascertains if the given HTTP status code is valid: An integer in the range [100, 599]
	 * By order of priority:
	 * If not is_numeric( $code ), return false
	 * Return $code in [100, 599]
	 *
	 * @returns boolean (See description)
	 * @param $code The HTTP status code to check
	 */
	public static function isValidHTTPStatus( $code ){
		if( !is_numeric( $code ) )
			return false;
		
		$code = (int)$code;
		
		return ( 100 <= $code ) && ( 600 > $code );
	} // method MZ_Assure::isValidHTTPStatus
	
	/**
	 * @param string $location An absolute URL
	 * @param int|null $code The HTTP status code to use
	 * @return void Does not return
	 */
	public static function redirect_to( $location, $code = null ){
		// TODO Add some kind of validation to check if $location is really a URL
		// TODO Add something to realize relative $locations
		if( headers_sent() ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, '[%s] Headers already sent', __METHOD__ );
			return false;
		} // endif headers_sent()
		
		if( null === $code )
			$code = ( 'POST' === self::get_request_method() ) ? 303 : 302;
		
		header( 'Location: ' . $location, true, $code );
		self::die_code( $code );
	} // method MZ_Assure::redirect_to
	
	public static function delegateFullResponse( $fullResponse ){
		$parts = explode( "\r\n\r\nHTTP/", $fullResponse );
		$parts = ( count( $parts ) > 1 ) ? ( 'HTTP/' . array_pop( $parts ) ) : reset( $parts );
		list( $headers, $body ) = explode( "\r\n\r\n", $parts, 2 );

		unset( $parts );

		$seen = array();
		foreach( explode( "\r\n", $headers ) as $header ){
			$prefix = mb_split( '[^a-zA-Z0-9\-]', $header, 2 );
			$prefix = reset( $prefix );
			
			if( !isset( $seen[ $prefix ] ) ){
				header( $header, true );
				$seen[ $prefix ] = true;
			}else
				header( $header, false );
		} // foreach $header

		foreach( array(
			'Transfer-Encoding',
			'X-Powered-By',
		) as $header ){
			if( function_exists( 'header_remove' ) )
				header_remove( $header );
			else
				header( $header . ':' );
		} // foreach $header

		$body = MZ_Strings::mb_trim( $body );

		header( 'Content-Length: ' . MZ_Strings::byte_len( $body ) );

		echo $body;
	} // method MZ_Assure::delegateFullResponse
	
	/**
	 * Determines if $a is an external url relative to $b.
	 * Note: Relative urls always compare as non-external. [terrible-joke]Since it's all relative.[/terrible-joke]
	 * For a non-strict comparison, the simple hosts must match (example.com).  For a strict comparison, the full hosts must match (www.example.com)
	 *
	 * @param string $a url
	 * @param string $b url
	 * @param boolean $strict Controls host comparison strictness
	 * @return boolean|null Returns <code>null</code> in the event that either $a or $b cannot be interpreted as a url
	 */
	public static function isExternalTo( $a, $b, $strict = false ){
		$aHost = parse_url( MZ_Strings::toStringQuiet( $a ), PHP_URL_HOST );
		$bHost = parse_url( MZ_Strings::toStringQuiet( $b ), PHP_URL_HOST );
		
		if( ( false === $aHost ) || ( false === $bHost ) )
			return null;
		
		if( ( null === $aHost ) || ( null === $bHost ) || ( '' === $aHost ) || ( '' === $bHost ) ) // relative
			return true;
		
		$aHost = explode( '.', $aHost );
		$bHost = explode( '.', $bHost );
		$comps = -max( count( $aHost ), count( $bHost ) );
		$aHost = array_pad( $aHost, $comps, '' ); // $comps is negative, pad to left
		$bHost = array_pad( $bHost, $comps, '' ); // $comps is negative, pad to left
				
		if( !$strict ){
			$aHost = array_slice( $aHost, -2 );
			$bHost = array_slice( $bHost, -2 );
		} // endif !$strict
		
		return $aHost !== $bHost;
	} // method MZ_Assure::isExternalTo
	
	/**
	 * Script access-related functions
	 */
	static function library_only( $file, $message = '', $content_type = '', $verbose = false ){
		if( MZ_Arrays::isget( 'SCRIPT_FILENAME', $_SERVER, '' ) === $file )
			self::dieWithCode( 503, null, ( empty( $message ) ? MZ_Debug::debug_message( 1, 'Script not publically accessible', '' ) : $message ), $content_type );
	} // method MZ_Assure::assure_library_only
	
	static function methods_only( $file, $methods, $message = '', $content_type = '', $verbose = false ){
		$script = MZ_Arrays::isget( 'SCRIPT_FILENAME', $_SERVER, '' );
		if( $script !== $file ){
			MZ_Debug::log( 'Cannot use as library file: %s; Accessed script is: %s', $file, $script );
			
			self::dieWithCode( 503, null, ( empty( $message ) ? MZ_Debug::debug_message( 1, 'Script not useable as library', '' ) : $message ), $content_type );
		} // endif $script !== $file
		
		$methods = array_map( 'MZ_Strings::normalize_token_upper', MZ_Arrays::make( $methods ) );
		$method = self::get_request_method();
		if( !in_array( $method, $methods, true ) ){
			MZ_Debug::log( '[%s] Cannot access via method %s; Accessed script is: %s; Allowed: %s', __METHOD__, $method, $file, print_r( $methods, true ) );
			$referer = MZ_Arrays::isget( 'HTTP_REFERER', $_SERVER, '' );
			if( !empty( $referer ) )
				MZ_Debug::log( '[%s] Referer: %s', __METHOD__, $referer );
			
			if( $verbose )
				MZ_Debug::log( '[%s] Server status: %s', __METHOD__, print_r( $_SERVER, true ) );
			
			header( sprintf( 'Allow: %s', implode( ', ', $methods ) ) );
			self::dieWithCode( 405, null, ( empty( $message ) ? 'Script not accessible by that method' : $message ), $content_type );
		} // endif !in_array( $method, $methods, true )
	} // method MZ_Assure::assure_methods_only
	
	static function get_only( $file, $message = '', $content_type = '', $verbose = false ){
		self::methods_only( $file, array( 'GET', 'HEAD' ), $message, $content_type, $verbose );
	} // method MZ_Assure::assure_get_only
	
	static function post_only( $file, $message = '', $content_type = '', $verbose = false ){
		self::methods_only( $file, 'POST', $message, $content_type, $verbose );
	} // method MZ_Assure::assure_post_only
	
	static function is_secure(){
		$tmp = MZ_Arrays::isget( 'HTTPS', $_SERVER, '' );
		if( !empty( $tmp ) )
			return mb_strtoupper( $tmp ) !== 'OFF';
		return ( MZ_Arrays::isget( 'SERVER_PORT', $_SERVER, '' ) === '433' ) || ( mb_strtoupper( MZ_Arrays::isget( 'HTTP_X_FORWARDED_PROTO', $_SERVER, '' ) ) === 'HTTPS' );
	} // method MZ_Assure::is_secure
	
	static function secure( $message = '', $content_type = '', $verbose = false ){
		if( self::is_secure() )
			return;
		
		if( $verbose )
			MZ_Debug::log( '[%s] Insecure access: %s', __METHOD__, print_r( $_SERVER, true ) );
		self::die_code( 426, null, ( empty( $message ) ? 'Secure connection required' : $message ), $content_type );
	} // method MZ_Assure::assure_secure
	
	static function get_request_method(){
		return MZ_Strings::normalize_token_upper( MZ_Arrays::isget( 'REQUEST_METHOD', $_SERVER, '' ) );
	} // method MZ_Assure::get_request_method
	
	
	public static function getRootURL(){
		static $ret = null;
		
		if( null === $ret ){
			$scheme = mb_strtolower( trim( MZ_Arrays::isget( 'REQUEST_SCHEME', $_SERVER, '' ) ) );
			if( empty( $scheme ) ){
				$scheme = MZ_Arrays::isget( 'REQUEST_SCHEME', $_SERVER, '' );
				$scheme = ( empty( $scheme ) || ( 'off' === mb_strtolower( $scheme ) ) ) ? 'http' : 'https';
			} // endif empty( $scheme )
			
			if( !defined( 'HTTP_HOST_OVERRIDE' ) ){
				$host = MZ_Arrays::isget( 'HTTP_HOST', $_SERVER, '' );
				if( empty( $host ) )
					$host = MZ_Arrays::isget( 'SERVER_NAME', $_SERVER, '' );
			}else
				$host = HTTP_HOST_OVERRIDE;
			
			if( empty( $host ) )
				$host = defined( 'HTTP_HOST_DEFAULT' ) ? HTTP_HOST_DEFAULT : '';
			
			$ret = sprintf( '%1$s://%2$s', $scheme, $host );
		} // endif $null === $ret;
		
		return $ret;
	} // mathod MZ_Assure::getRootURL
	
	public static function getCurrentURL(){
		static $ret = null;
		
		if( null === $ret )
			$ret = self::getRootURL() . MZ_Arrays::isget( 'REQUEST_URI', $_SERVER, '/' );
		
		return $ret;
	} // method MZ_Assure::getCurrentURL
	
	public static function findURLForPath( $path ){
		$documentRoot = $_SERVER[ 'DOCUMENT_ROOT' ];
		
		$realPath = MZ_Files::resolve_path( $path, $documentRoot );
		if( false === $realPath ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, '[%s] Invalid path: %s', __METHOD__, $path );
			return false;
		} // endif false === $realPath
		
		$docRootLength = mb_strlen( $documentRoot );
		assert( '$documentRoot === mb_substr( $realPath, 0, $docRootLength )' );
		
		return self::getRootURL() . MZ_Files::normalize_path( mb_substr( $realPath, $docRootLength ), '/', true );
	} // method MZ_Assure::findURLForPath
} // class MZ_Assure

MZ_Assure::library_only( __FILE__ );