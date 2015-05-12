<?php

/**
 * Product Model
 * ---------------
 * @author Somwang 
 *
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;



class TransactionChild extends Eloquent {

	public $timestamps = false;
	protected $table = 'transaction_child';
	protected $primaryKey = 'idx';

	use SoftDeletingTrait;

	public static function get_json($query) {
		
		$orders= DB::table('transaction_child')
					->select('*', DB::raw('SUM(quality) as total'))
					->where('remove',1)
					->whereBetween('updateDate', array( Tool::toMySqlDate($query['date_from']).' 00:00:00', Tool::toMySqlDate($query['date_to']).' 23:59:00'))
					->groupBy('productIdx');
		
		$total = $orders->count() > 0 ? $orders->count() : 0;
		
		$orders = $orders->skip($query['offset'])->take($query['limit'])->get();
		if( $total > 0 ) {
			
			/*foreach( $orders as $key => $row ) {
				
				$data[$key]['date'] = Tool::toDateTime($row->updateDate);
				$data[$key]['product_name'] = $row->product_name;
				$data[$key]['productIdx'] = $row->productIdx;
				$data[$key]['quality'] = $row->quality;
				$data[$key]['unit'] = $row->unit;
			}*/
			$data = $orders;
			
		} else {
			$data = array();
		}
		
		return array('data'=>$data, 'total'=> $total);

	}
	
}
