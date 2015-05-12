<?php

/**
 * Sale Controller
 * ------------------
 * @author Somwang
 *
 */
class SaleController extends BaseController {

	
	/**
	 * Sale Index
	 * -------------
	 */
	public function index()
	{
		return View::make('sale/index');
	}
	
	/**
	 * Sale form
	 * ------------
	 */
	public function form() {
		
		return View::make('sale/form');
	}
	
	/**
	 * Sale form save
	 * -------------------
	 */
	public function form_save() {

		$rules = array(
				'quality'     	=> 'required',
				'product_id'   	=> 'required',
				'date'   		=> 'required',
				'sale_number'	=> 'required',

		);
		
		$messages = array(
				'sale_number.required' => 'ກະລຸນາໃສ່ລະຫັດລາຍການຂາຍ',
				'date.required' => 'ກະລຸນາເລືອກວັນທີ',
				'product_id.required' => 'ກະລຸນາໃສ່ລະຫັດສິນຄ້າ',
				'quality.required' => 'ກະລຸນາໃສ່ຈຳນວນ',
		);
		
		$validator = Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails()) {
		
			$messages = $validator->messages()->toArray();
		
			foreach( $messages as $key => $value) {
				$message =  $messages[$key][0];
			}

			return Response::json(array(
		        'success' => false,
		        'message' => $message
		    ), 400);

		} else {

			$sale = new Sale();
			$sale->sale_number = Input::get('sale_number');
			$sale->product_id = Input::get('product_id');
			$sale->sale_date = Tool::toMySqlDate(Input::get('date'));
			$sale->quality = Input::get('quality');
			//$sale->customer_code = Input::get('customer_code') > 0 ? Input::get('customer_code') : NULL;
			$sale->note = Input::get('note');
	
			# Update Product quality
			$product = Product::find(Input::get('product_id'));

			# If product quality is not enougth
			if( $product->quality < Input::get('quality') ) {
				return Response::json(array(
			        'success' => true,
					'message' => 'ຂໍອະໄພ ຈຳນວນສິນຄ້າທີ່ຍັງເຫລືອບໍ່ພຽງພໍສຳຫລັບການຂາຍ (ຈຳນວນສິນຄ້າທີ່ຍັງເຫລືອແມ່ນ '.$product->quality.')',
		   		), 400); 
			}
			
			$product->quality = $product->quality-Input::get('quality');
			$sale->save();
			$product->save();
			
			# Find Sale by ID
			#$sale = DB::table('sale_view')->where('id',$sale->id)->first();
			$sale = Sale::allSales(true, array('search'=>$sale->id));
			
			return Response::json(array(
		        'success' => true,
				'sale' => $sale['data'][0],
		    ), 200);
		}
	}
	
  /**
 	* Sale Json
 	* ---------
 	*/
	public function get_json() {
	
		$query = array(
				'search' => Input::get('search'),
				'date_from' => Input::get('date_from'),
				'date_to' => Input::get('date_to'),
				'order' => Input::get('order'),
				'limit' => Input::get('limit'),
				'offset' => Input::get('offset')
		);
	
		$sales = StockIo::allSales($query);
	
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

	}
	
	/**
	 * Sale Remove
	 * ---------------
	 */
	public function remove() {
	
		$ids = explode(',', Route::input('ids'));
	
		foreach( $ids as $id ) {
	
			# Find Sale
			$sale = Sale::find($id);
	
			# Update Product Quality
			$product = Product::find($sale->product_id);
			$product->quality = $product->quality + $sale->quality;
			$product->save();
				
			$sale->delete();
		}
	
		return Response::json(array(
				'success' => true,
		));
	}
	
}