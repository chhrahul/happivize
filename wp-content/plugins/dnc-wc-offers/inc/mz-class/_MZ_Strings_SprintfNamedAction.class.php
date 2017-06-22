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
 * String manipulation
 *
 * @internal
 */

final class _MZ_Strings_SprintfNamedAction{
	private $mapping;
	private $unmappedAction;
	
	/* package-private */ function __construct( array $mapping, $unmappedAction ){
		$this->mapping = $mapping;
		$this->unmappedAction = $unmappedAction;
	} // method _MZ_Strings_SprintfNamedAction::__construct
	
	/* package-private */ function call( array $matches ){
		$mapping = $this->mapping;
		list( , $named, $format ) = $matches;
		
		if( isset( $mapping[ $named ] ) )
			return $mapping[ $named ];
		
		switch( $this->unmappedAction ){
			case MZ_Strings::UNMAPPED_ACTION_EMPTY:
				return '';
			case MZ_Strings::UNMAPPED_ACTION_THROW:
				throw new LogicException( sprintf( '[%s] No such name: %s', __METHOD__, $named ) );
			case MZ_Strings::UNMAPPED_ACTION_UNTOUCHED:
			default:
				break;
		} // switch $unmappedAction
		
		return $matches[ 0 ];
	} // method _MZ_Strings_SprintfNamedAction::call
} // class _MZ_Strings_SprintfNamedAction
