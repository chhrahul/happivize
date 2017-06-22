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
 * Quality-of-Life extension to PDOStatement
 */

class MZ_PDOStatement extends PDOStatement{
	private /* string */ $query;
	private /* string */ $driver_options;
	private /* MZ_PDO */ $db;
	
	protected function __construct( MZ_PDO $db ){
		$this->db = $db;
	} // method MZ_PDOStatement::__construct
	
	function init0( $query, $driver_options ){
		if( null === $this->query ){
			$this->query = $query;
			$this->driver_options = $driver_options;
		} // endif null === $this->query
	} // method MZ_PDOStatement::init0
	
	function closeCursorBestEffort(){
		try{
			parent::closeCursor(); // Disregard return value.  Is best-effort
		}catch( PDOException $x ){} // Disregard error.  Is best-effort
	} // method MZ_PDOStatement::closeCursorBestEffort
	
	public function execute( $params = null, $fallback = null ){
		try{
			// Because PDO doesn't make sense sometimes
			$ret = empty( $params ) ? parent::execute() : parent::execute( $params );
		}catch( PDOException $e ){
			$ret = false;
		} // catch PDOException $e
		
		if( ( false === $ret ) && is_callable( $fallback ) ){
			try{
				$tmp = call_user_func( $fallback, $this );
			}catch( Exception $e ){
				$tmp = false;
			} // catch Exception $e
			
			if( false !== $tmp ){
				if( true !== $tmp )
					$query = strval( $tmp );
				try{
					$ret = empty( $params ) ? parent::execute() : parent::execute( $params );
				}catch( PDOException $e ){
					// Do nothing, $ret is already false
				} // catch PDOException $e
			} // endif false !== $tmp
		} // endif ( false === $ret ) && is_callable( $fallback )
			
		if( false !== $ret )
			return true;
		
		MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_ERROR, '[%s; %s] Could not execute query: %s ( %s )', __METHOD__, $this->errorInfoAsString(), $this->query, $this->driver_options );
		if( !empty( $e ) ) // If we had an exception thrown, prolly because we were the throwing type.
			throw $e;
		return false;
		
	} // method MZ_PDOStatement::execute
	
	public function errorInfoAsString(){
		return implode( '; ', parent::errorInfo() );
	} // method MZ_PDO::errorInfoAsString
	
	public function fetchAndClose( $fetch_style = null, $cursor_orientation = PDO::FETCH_ORI_NEXT, $cursor_offset = 0 ){
		if( null === $fetch_style )
			$fetch_style = $this->db->getAttribute( PDO::ATTR_DEFAULT_FETCH_MODE );
		
		try{
			$ret = parent::fetch( $fetch_style, $cursor_orientation, $cursor_offset = 0 );
		}catch( PDOException $e ){
			$ret = false;
		} // catch PDOException $e
		
		// Regardless of how we got here, close the cursor
		$this->closeCursorBestEffort();
		
		if( !empty( $e ) )
			throw $e;
		return $ret;
	} // method MZ_PDOStatement::fetchAndClose
	
	public function fetchColumnAndClose( $column_number = 0 ){
		try{
			$ret = parent::fetchColumn( $column_number );
		}catch( PDOException $e ){
			$ret = false;
		} // catch PDOException $e
		
		// Regardless of how we got here, close the cursor
		$this->closeCursorBestEffort();
		
		if( !empty( $e ) )
			throw $e;
		return $ret;
	} // method MZ_PDOStatement::fetchColumnAndClose
	
	private function generateFailure0( $class, $format ){
		if( !class_exists( $class ) )
			$class = 'Exception';
		$args = func_get_args();
		$message = vsprintf( $format, array_slice( $args, 2 ) );
		
		MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, $message );
		switch( $this->db->getAttribute( PDO::ATTR_ERRMODE ) ){
			case PDO::ERRMODE_EXCEPTION:
				throw new $class( $message );
			case PDO::ERRMODE_WARNING:
				trigger_error( $message, E_USER_WARNING );
				// Intentional fall-through
			case PDO::ERRMODE_SILENT:
			default:
				// Break out because I don't like having nothing as the last line of the method
		} // switch $this->db->getAttribute( PDO::ATTR_ERRMODE )
		return false;
	} // method MZ_PDOStatement::generateFailure0
	
	public function fetchObjectAndClose( $class = 'stdClass', array $ctor_args = array() ){
		if( !class_exists( $class ) )
			return $this->generateFailure0( 'InvalidArgumentException', '[%s] No such class: %s', __METHOD__, var_export( $class, true ) );
		
		try{
			$ret = parent::fetchObject( $class, $ctor_args );
		}catch( PDOException $e ){
			$ret = false;
		} // catch PDOException $e
		
		// Regardless of how we got here, close the cursor
		$this->closeCursorBestEffort();
		
		if( !empty( $e ) )
			throw $e;
		return $ret;
	} // method MZ_PDOStatement::fetchObjectAndClose
	
	public function __toString(){
		return $this->query;
	} // method MZ_PDOStatement::__toString
} // class MZ_PDOStatement

MZ_Assure::library_only( __FILE__ );