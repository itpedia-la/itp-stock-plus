<?php

/**
 * Report Controller
 * ------------------
 * @author Somwang
 *
 */
class ReportController extends BaseController {

	
	/**
	 * Order Cancalled
	 * ---------------
	 */
	public function order_cancelled()
	{
		return View::make('report/order_cancelled');
	}
	
	/**
	 * Json Order cancelled
	 * --------------------
	 */
	public function order_cancelled_json() {

		$query = array(
				'search' => Input::get('search'),
				'date_from' => Input::get('date_from'),
				'date_to' => Input::get('date_to'),
				'order' => Input::get('order'),
				'limit' => Input::get('limit'),
				'offset' => Input::get('offset')
		);
		
		$sales = $order = TransactionChild::get_json($query);
		
		if( $sales['total'] ) {
			foreach( $sales['data'] as $sale ) {
					
				$data["total"] = $sales['total'];
				$data["rows"][] = $sale;
			}
		} else {
			$data["total"] = 0;
			$data['rows'] = array();
		}
		
		return Response::json($data, 200)->setCallback(Input::get('callback'));
		
		print_r($order);
	}

}