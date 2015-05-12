<?php

/**
 * StockIo Model
 * ---------------
 * @author Somwang 
 *
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class StockIo extends Eloquent {

	protected $table = 'stock_io';
	protected $primaryKey = 'idx';
	
	use SoftDeletingTrait;
	
	/**
	 * Purchase in json format
	 * 
	 * @param $query array
	 * @return array
	 */
	public static function allPurchases($query) {
		
		switch($query['search'])
		{
			# Search By Date
			case 'byDate' :
		
				$purchases = DB::table('view_purchase')
				->whereBetween('purchase_date', array( Tool::toMySqlDate($query['date_from']).' 00:00:00', Tool::toMySqlDate($query['date_to']).' 23:59:00'))
				->orderBy('id',$query['order']);
		
				break;

			# Search by Purchase number
			default :

				$purchases = DB::table('view_purchase')
				->where('purchase_number', $query['pon'])
				->orderBy('id',$query['order']);
				
				break;
		}
		
		$total = $purchases->count() > 0 ? $purchases->count() : 0;
		
		$purchases = $purchases->skip($query['offset'])->take($query['limit'])->get();

		if( $total > 0 ) {
			foreach( $purchases as $key => $row ) {
				
				$data[$key]['id'] = $row->id;
				$data[$key]['purchase_date'] = Tool::toDate($row->purchase_date);
				$data[$key]['purchase_number'] = $row->purchase_number;
				$data[$key]['product_code'] = $row->product_code;
				$data[$key]['product_description'] = $row->product_description;
				$data[$key]['quality'] = number_format($row->quality,2);
				$data[$key]['supplier'] = $row->supplier_name;
				$data[$key]['unit'] = $row->unit;
				$data[$key]['note'] = $row->note;
				
			}
		} else {
			$data = array();
		}

		return array('data'=>$data, 'total'=> $total);
	}
	
	/**
	 * Sale in json format
	 *
	 * @param $query array
	 * @return array
	 */
	public static function allSales($query) {
	
		switch($query['search'])
		{
			# Search By Date
			case 'byDate' :

				$sales = DB::table('stock_io')
					->select('*', DB::raw('sum(quality) as total'))
					->whereBetween('date_created', array( Tool::toMySqlDate($query['date_from']).' 00:00:00', Tool::toMySqlDate($query['date_to']).' 23:59:00'))
					->where('move_type',0)
					->groupBy('stock_item_idx')
					->orderBy('date_created',$query['order']);

				break;
	
			default :
		
				break;
		}
		
		$total = $sales->count() > 0 ? $sales->count() : 0;
		
		$sales = $sales->skip($query['offset'])->take($query['limit'])->get();

		if( $total > 0 ) {
			foreach( $sales as $key => $row ) {
		
				# Find Stock_item
				$Product = Product::find($row->stock_item_idx);
				
				$data[$key]['id'] = $row->idx;
				$data[$key]['date'] = Tool::toDate($row->date_created);
				$data[$key]['product_code'] = $Product->code;
				$data[$key]['product_description'] = $Product->item_name;
				$data[$key]['quality'] = $row->total;
				$data[$key]['product_unit'] = Unit::find($Product->stock_unit_idx_use)->name;
		
			}
		} else {
			$data = array();
		}

		return array('data'=>$data, 'total'=> $total);
		
	}
}
