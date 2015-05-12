<?php

/**
 * Sale Model
 * ---------------
 * @author Somwang 
 *
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Sale extends Eloquent {

	protected $table = 'sale';

	use SoftDeletingTrait;
	
	/**
	 * Sale in json format
	 * 
	 * @param $query array
	 * @return array
	 */
	public static function allSales($search_by_id = false, $query) {
		
		if( $search_by_id == false && $query['search'] ) {
				
			$sales = DB::table('sale_view')
			->where('sale_number','LIKE','%'.$query['search'].'%')
			->orWhere('product_description','LIKE','%'.$query['search'].'%')
			->orWhere('product_code','LIKE','%'.$query['search'].'%')
			->orWhere('sale_date','LIKE','%'.Tool::toMySqlDate($query['search']).'%')
			->orderBy('id',$query['order']);

			$total = $sales->count();
			
			$sales = $sales->skip($query['offset'])->take($query['limit'])->get();
			
		} elseif( $search_by_id == true && $query['search'] ) {
			
			$sales = DB::table('sale_view')
				->where('id','=',$query['search']);
			
			$total = $sales->count();
			
			$sales = $sales->get();
			
		} else {
				
			$sales = DB::table('sale_view')
				->orderBy('id',$query['order']);
				
			$total = $sales->count();
			
			$sales = $sales->skip($query['offset'])->take($query['limit'])->get();
		}	
		
		$data = array();
		foreach( $sales as $key => $row ) {

			# FInd Unit
			$unit = Unit::find($row->product_unit);
			
			$data[$key]['id'] = $row->id;
			$data[$key]['date'] = Tool::toDate($row->sale_date);
			$data[$key]['sale_number'] = $row->sale_number;
			$data[$key]['product_code'] = $row->product_code;
			$data[$key]['product_description'] = $row->product_description;
			$data[$key]['quality'] = number_format($row->quality,2);
			$data[$key]['product_unit'] = $unit->name;
			//$data[$key]['customer_name'] = $row->customer_name;
			//$data[$key]['product_price'] = number_format($row->product_price,2);
			//$data[$key]['sale_net_total'] = number_format($row->sale_net_total,2);
			//$data[$key]['sale_net_cost'] = number_format($row->sale_net_cost,2);
			//$data[$key]['sale_net_profit'] = number_format($row->sale_net_profit,2);
			$data[$key]['note'] = $row->note;
			
		}
	
		return array('data'=>$data,'total'=>$total);
	}
}
