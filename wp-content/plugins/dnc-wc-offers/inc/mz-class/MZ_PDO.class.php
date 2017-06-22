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
 * Quality-of-Life extension to PDO
 */

class MZ_PDO extends PDO{
	const CODE_DUPLICATE_ENTRY = '23000';
	const CODE_NO_TABLE = '42S02';
	
	private $cached_queries = array();
	
	public function __construct( $dsn, $username, $password, array $options = array() ){
		parent::__construct( $dsn, $username, $password, $options );
		parent::setAttribute( PDO::ATTR_STATEMENT_CLASS, array( ( __CLASS__ . 'Statement' ), array( $this ) ) );
	} // method MZ_PDO::__construct
	
	private function prepare0( $query, array $driver_options, $fallback ){
		/**
		 * Logic here is complicated somewhat by the fact that the methods could fail by either throwing or returning false.
		 * These try-blocks in effect convert it into a fail-with-false, while keeping track of the most recently thrown exception
		 */
		try{
			$ret = parent::prepare( $query, $driver_options );
		}catch( PDOException $e ){
			$ret = false;
		} // catch PDOException $e
		
		if( ( false === $ret ) && is_callable( $fallback ) ){
			try{ // Try the fallback.  Maybe it can cleanup this mess
				$tmp = call_user_func( $fallback, $this );
			}catch( Exception $e ){
				$tmp = false;
			} // catch Exception $e
			
			if( false !== $tmp ){ // Was the fallback happy?
				if( true !== $tmp ) // Did it give us a new query?
					$query = strval( $tmp );
				
				try{ // Try this again
					$ret = parent::prepare( $query, $driver_options );
				}catch( PDOException $e ){
					// Do nothing, $ret is already false
				} // catch PDOException $e
			} // endif false !== $tmp
		} // endif ( false === $ret ) && is_callable( $fallback )
		
		// Either way, this is more useful to us as a string than an array
		$driver_options = print_r( $driver_options, true );
		if( false !== $ret ){
			$ret->init0( $query, $driver_options );
			return $ret;
		} // false !== $ret
		
		MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_ERROR, '[%s; %s] Could not prepare query: %s ( %s )', __METHOD__, $this->errorInfoAsString(), $query, $driver_options );
		if( !empty( $e ) ) // If we had an exception thrown, prolly because we were the throwing type.
			throw $e;
		return false;
	} // method MZ_PDO::prepare0
	
	public function setAttribute( $attribute, $value ){
		if( PDO::ATTR_STATEMENT_CLASS === $attribute )
			return false;
		
		return parent::setAttribute( $attribute, $value );
	} // method MZ_PDO::setAttribute
	
	public function errorInfoAsString(){
		return implode( '; ', parent::errorInfo() );
	} // method MZ_PDO::errorInfoAsString
	
	public function prepare( $query, $driver_options = null, $fallback = null ){
		// Simplify the whitespace
		// Needed? // $query = mb_ereg_replace( "[\r\n]+", ' ', $query );
		
		if( empty( $driver_options ) && isset( $this->cached_queries[ $query ] ) )
			return $this->cached_queries[ $query ];
		
		try{
			$ret = $this->prepare0( $query, $driver_options, $fallback );
		}catch( Throwable $e ){
			$ret = false;
		} // catch Throwable $e
		
		// Yes, we'll be caching false results as well.  If nothing else, cuts down on database & log spam.
		if( empty( $driver_options ) )
			$this->cached_queries[ $query ] = $ret;
		
		if( isset( $e ) )
			throw $e;
		return $ret;
	} // method MZ_PDO::prepare
	
	public function exec( $query, array $driver_options = array(), $fallback = null ){
		$prepared = $this->query( $query, $driver_options, $fallback );
		
		if( !( $prepared instanceof MZ_PDOStatement ) )
			return false;
		
		$ret = $prepared->rowCount();
		$prepared->closeCursor();
		return $ret;
	} // method MZ_PDO::exec
	
	public function query( $query, array $driver_options = array(), $fallback = null ){
		$prepared = $this->prepare( $query, $driver_options, $fallback ); // Let error propagate
		if( false === $prepared )
			return false;
		
		return $prepared->execute( array(), $fallback ) ? $prepared : false; // Let error propagate
	} // method MZ_PDO::query
	
	public function underTransaction( $action ){
		if( !is_callable( $action ) )
			throw new InvalidArgumentException( sprintf( '[%s] Not a callback: %s', __METHOD__, var_export( $action, true ) ) );
			
		$args = func_get_args();
		$args = array_slice( $args, 1 );
		
		if( !$this->beginTransaction() )
			return false;
		try{
			$success = call_user_func_array( $action, $args );
		}catch( Throwable $e ){
			$success = false;
		} // catch Throwable $e
		
		if( !$this->{ ( false === $success ) ? 'rollBack' : 'commit' }() ) // If this throws... meh.
			$success = false;
		
		if( !empty( $e ) )
			throw $e;
		return $success;
	} // method MZ_PDO::underTransaction
	
	public function underLocks( $query, $action ){
		if( !mb_ereg_match( '\Alock\s+tables', $query, 'pri' ) )
			throw new InvalidArgumentException( sprintf( '[%s] Not a lock statement: %s', __METHOD__, var_export( $query, true ) ) );
		if( !is_callable( $action ) )
			throw new InvalidArgumentException( sprintf( '[%s] Not a callback: %s', __METHOD__, var_export( $action, true ) ) );
		
		$args = func_get_args();
		$args = array_slice( $args, 2 );
		
		$ret = false;
		if( $this->exec( $query ) ){
			try{
				$ret = call_user_func_array( $action, $args );
			}catch( Throwable $e ){
				$ret = false;
			} // catch Throwable $e
			
			$this->exec( 'unlock tables' ); // best-effort
		} // endif $this->exec( $query )
		
		return $ret;
	} // method MZ_PDO::underLocks
	
	public static function escapeIdentifier( $raw_ident ){
		return '`' . MZ_Strings::mb_str_replace( '`', '``', $raw_ident ) . '`';
	} // method MZ_PDO::escapeIdentifier
} // class MZ_PDO

MZ_Assure::library_only( __FILE__ );