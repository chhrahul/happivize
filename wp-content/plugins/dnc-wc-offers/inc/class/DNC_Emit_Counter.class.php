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
 * Helper class to properly count the packages, items and bonuses
 */
class DNC_Emit_Counter{
	public /* int */ $packageIndex = 0;
	public /* int */ $itemIndex = 0;
	public /* int */ $bonusIndex = 0;
	public /* int */ $packageCount;
	public /* int */ $itemCount;
	public /* int */ $bonusCount;
	public /* string */ $offerTitle;
	
	public function __construct( array $packages, $offerTitle ){
		$this->packageCount = count( $packages );
		$this->itemCount = array_sum( array_map( 'DNC_Offer_Package::getItemCount', $packages ) );
		$this->bonusCount = array_sum( array_map( 'DNC_Offer_Package::getBonusCount', $packages ) );
		$this->offerTitle = $offerTitle;
	} // method DNC_Emit_Counter::__construct
	
	public function reset(){
		$this->packageIndex = $this->itemIndex = $this->bonusIndex = 0;
	} // method DNC_Emit_Counter::reset
} // class DNC_Emit_Counter
