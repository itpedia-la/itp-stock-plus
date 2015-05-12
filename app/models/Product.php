<?php

/**
 * Product Model
 * ---------------
 * @author Somwang 
 *
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Product extends Eloquent {

	protected $table = 'stock_item';
	protected $primaryKey = 'idx';
	
	use SoftDeletingTrait;
	
	/**
	 * Products in json format
	 * 
	 * @param $query array
	 * @return array
	 */
	public static function allProducts($query) {
		
		switch($query['mode']) {
			
			# Stock Alert List
			case 'stock_alert':
				
				$products = DB::table('view_stock_alert')
				->orderBy('idx',$query['order']);
				
				break;
				
			# General Search
			case 'general':
				
				$products = DB::table('stock_item')
				->where('code','LIKE','%'.$query['search'].'%')
				->orWhere('item_name','LIKE','%'.$query['search'].'%')
				->where('deleted_at',null)
				->orderBy('idx',$query['order']);
				
				break;
				
			# Default List
			default:
				
				$products = DB::table('stock_item')
				->where('deleted_at',null)
				->orderBy('idx',$query['order']);
				
				break;
			
		}
		
		
		$total = $products->count();
			
		$products = $products->skip($query['offset'])->take($query['limit'])->get();

		foreach( $products as $key => $row ) {
			
			# Find Category
			$Category = Category::find($row->stock_category_idx);
			
			# Find Unit
			$Unit = Unit::find($row->stock_unit_idx_use);
			
			$data[$key]['id'] = $row->idx;
			#$data[$key]['image'] = '<img src="'.URL::to('img/products').'/'.$row->image.'" width="40" class="img-thumbnail">';
			//$data[$key]['category_id'] = $row->category;
			$data[$key]['category'] = $Category->category_name;
			$data[$key]['code'] = $row->code;
			//$data[$key]['price'] = number_format($row->price,2);
			//$data[$key]['cost'] = number_format($row->cost,2);
			$data[$key]['quality'] = Product::checkAlert($row->alert_quality, $row->quality);
			$data[$key]['unit'] = $Unit->name;
			$data[$key]['description'] = $row->item_name;
			$data[$key]['alert_quality'] = $row->alert_quality;
		}
		
		return array('total'=>$total, 'data'=>$data);
	}
	
	/**
	 * Product Alert
	 * ---------------
	 */
	public static function checkAlert($alert_quality, $quality) {
		
		if($quality > 1 && $quality <= $alert_quality) {
			
			return '<span class="label label-warning">'.number_format($quality,2).'</span>';
			
		} elseif( $quality <= 0 ) {
			
			return '<span class="label label-danger">'.number_format($quality,2).'</span>';

		} else {
			
			return  '<span class="label label-success">'.number_format($quality,2).'</span>';
		}
	}
	
	/**
	 * Stock Alert
	 * ----------
	 */
	public static function stock_alert() {
		
		$stock_alert = DB::table('view_stock_alert_total')->get();
		return $stock_alert[0]->total;
	}
	
}
