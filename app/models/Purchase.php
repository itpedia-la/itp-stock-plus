<?php

/**
 * Purchase Model
 * ---------------
 * @author Somwang 
 *
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Purchase extends Eloquent {

	protected $table = 'purchase';
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
			case 'byDate' :
				
				$purchases = DB::table('view_purchase')
				->whereBetween('created_at', array( '2015-05-01 00:00:00', '2015-05-30 23:59:00'))
				->orderBy('id',$query['order']);
				
				break;
				
			default :
				
				break;
		}
		
		$total = $purchase->count();
		
		$purchases = $purchases->skip($query['offset'])->take($query['limit'])->get();
		
		/*if( $query['search'] ) {
				
			$purchases = DB::table('purchase_view')
			->where('purchase_number','LIKE','%'.$query['search'].'%')
			->orWhere('product_description','LIKE','%'.$query['search'].'%')
			->orWhere('product_code','LIKE','%'.$query['search'].'%')
			->orWhere('purchase_date','LIKE','%'.Tool::toMySqlDate($query['search']).'%')
			->orderBy('id',$query['order']);
			
			$total = $purchases->count();
			
			$purchases = $purchases->skip($query['offset'])->take($query['limit'])->get();
			
		} else {
				
			$purchases = DB::table('purchase_view')->orderBy('id',$query['order']);
			
			$total = $purchases->count();
				
			$purchases = $purchases->get();
			
		}	*/

		foreach( $purchases as $key => $row ) {
			
			$data[$key]['id'] = $row->id;
			$data[$key]['purchase_date'] = Tool::toDate($row->purchase_date);
			$data[$key]['purchase_number'] = $row->purchase_number;
			$data[$key]['product_code'] = $row->product_code;
			$data[$key]['product_description'] = $row->product_description;
			$data[$key]['quality'] = number_format($row->quality,2);
			$data[$key]['supplier'] = $row->supplier_name;
	
			$data[$key]['note'] = $row->note;
			
		}
		
		return array('data'=>$data, 'total'=> $total);
	}
}
