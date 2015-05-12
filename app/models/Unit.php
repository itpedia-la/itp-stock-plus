<?php

/**
 * Unit Model
 * ---------------
 * @author Somwang 
 *
 */
class Unit extends Eloquent {

	protected $table = 'stock_unit';
	protected $primaryKey = 'idx';
	
	/**
	 * Get Array
	 * ---------
	 * array(1=>unit)
	 */
	public static function getArray() {

		foreach(Unit::all()->toArray() as $unit ) {
			$units[$unit['id']] = $unit['category_name'];
		}
		
		return $units;
	}
}
