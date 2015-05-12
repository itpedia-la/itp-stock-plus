<?php

/**
 * Customer Model
 * ---------------
 * @author Somwang 
 *
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Customer extends Eloquent {

	protected $table = 'customer';

	use SoftDeletingTrait;
	
	/**
	 * Products in json format
	 * 
	 * @param $query array
	 * @return array
	 */
	public static function allProducts($query) {
		
		if( $query['search'] ) {
			
			$products = DB::table('product')
						->where('code','LIKE','%'.$query['search'].'%')
						->orWhere('description','LIKE','%'.$query['search'].'%')
						->orderBy('id',$query['order'])
						->skip($query['offset'])->take($query['limit'])->get();
		} else {
			
			$products = Product::orderBy('id','desc')->get();
		}

		foreach( $products as $key => $row ) {
			
			# Find Category
			$Category = Category::find($row->category);
			
			# Find Unit
			$Unit = Unit::find($row->unit);
			$data[$key]['id'] = $row->id;
			$data[$key]['image'] = '<img src="'.URL::to('img/products').'/'.$row->image.'" width="40" class="img-thumbnail">';
			$data[$key]['category_id'] = $row->category;
			$data[$key]['category'] = $Category->name;
			$data[$key]['code'] = $row->code;
			$data[$key]['price'] = number_format($row->price,2);
			$data[$key]['cost'] = number_format($row->cost,2);
			$data[$key]['quality'] = Product::checkAlert($row->alert_quality, $row->quality);
			$data[$key]['unit'] = $Unit->name;
			$data[$key]['description'] = $row->description;
			$data[$key]['alert_quality'] = $row->alert_quality;
		}
		
		return $data;
	}
	
	/**
	 * Product Alert
	 * ---------------
	 */
	public static function checkAlert($alert_quality, $quality) {
		
		if($quality > 1 && $quality <= $alert_quality) {
			
			return '<span class="label label-warning">'.number_format($quality,2).'</span>';
			
		} elseif( $quality == 0 ) {
			
			return '<span class="label label-danger">'.number_format($quality,2).'</span>';

		} else {
			
			return  '<span class="label label-success">'.number_format($quality,2).'</span>';
		}
	}
	
}
