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
		
		$orders= DB::table('view_report_order_cancelled')
					->whereBetween('updateDate', array( Tool::toMySqlDate($query['date_from']).' 00:00:00', Tool::toMySqlDate($query['date_to']).' 23:59:00'))->orderBy('updateDate','desc');
		
		$total = $orders->count() > 0 ? $orders->count() : 0;
		
		$orders = $orders->skip($query['offset'])->take($query['limit'])->get();
		if( $total > 0 ) {
			
			$quality = 0;
			foreach( $orders as $key => $row ) {

				$data[] = array(
						'product_name' => $row->product_name,
						'quality' => $row->quality,
						'unit' => $row->unit,
						'productIdx' => $row->productIdx,
						'date' => date('d-M-Y H:i:s', strtotime($row->updateDate)),
				);
				
				/*$data[$key]['date'] = Tool::toDateTime($row->updateDate);
				$data[$key]['product_name'] = $row->product_name;
				$data[$key]['productIdx'] = $row->productIdx;
				$data[$key]['quality'] = $row->quality;
				$data[$key]['unit'] = $row->unit;*/
			}
			
			/*echo '<pre>';
			print_r($data);
			echo '</pre>';
			exit();*/
		} else {
			$data = array();
		}
		
		return array('data'=>$data, 'total'=> $total);

	}
	
}
