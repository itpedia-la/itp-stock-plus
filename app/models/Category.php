<?php

/**
 * Category Model
 * ---------------
 * @author Somwang 
 *
 */
class Category extends Eloquent {

	protected $table = 'stock_category';
	protected $primaryKey = 'idx';
	
	/**
	 * Get Array
	 * ---------
	 * array(1=>unit)
	 */
	public static function getArray() {
	
		foreach(Category::all()->toArray() as $category ) {
			$categories[$category['id']] = $category['name'];
		}
	
		return $categories;
	}
}
