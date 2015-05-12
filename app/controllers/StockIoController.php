<?php

/**
 * Purchase Controller
 * ------------------
 * @author Somwang
 *
 */
class StockIoController extends BaseController {

	
	/**
	 * Product Index
	 * -------------
	 */
	public function purchase()
	{
		return View::make('purchase/index');
	}
	
	/**
	 * Purchase Json
	 * -------------
	 */
	public function purchase_json() {
	
		$query = array(
				'search' => Input::get('search'),
				'order' => Input::get('order'),
				'limit' => Input::get('limit'),
				'offset' => Input::get('offset')
		);
	
		$purchases = StockIo::allPurchases($query);
	
		if( $purchases['total'] > 0 ) {
			foreach( $purchases['data'] as $purchase ) {
					
				$data["total"] = $purchases['total'];
				$data["rows"][] = $purchase;
			}
		} else {
			$data['total'] = 0;
			$data['rows'] = array();
		}
	
		return Response::json($data,200)->setCallback(Input::get('callback'));
	}
	
	/**
	 * Sale Json
	 * -------------
	 */
	public function sale_json() {
	
		$query = array(
				'search' => Input::get('search'),
				'order' => Input::get('order'),
				'limit' => Input::get('limit'),
				'offset' => Input::get('offset')
		);
	
		$purchases = StockIo::allSales(false, $query);
	
		if( $purchases['total'] > 0 ) {
			foreach( $purchases['data'] as $purchase ) {
					
				$data["total"] = $purchases['total'];
				$data["rows"][] = $purchase;
			}
		} else {
			$data['total'] = 0;
			$data['rows'] = array();
		}
	
		return Response::json($data,200)->setCallback(Input::get('callback'));
	}
	
	/**
	 * Purchase form
	 * ------------
	 */
	public function form() {
		
		return View::make('purchase/form');
	}
	
	/**
	 * Purchase form save
	 * -------------------
	 */
	public function form_save() {

		$rules = array(
				'quality'     		=> 'required',
				'product_id'   	=> 'required',
				'date'   => 'required',
				'purchase_number'          => 'required',

		);
		
		$messages = array(
				'purchase_number.required' => 'ກະລຸນາໃສ່ລະຫັດໃບຈັດຊື້',
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

			$purchase = new Purchase();
			$purchase->purchase_number = Input::get('purchase_number');
			$purchase->product_id = Input::get('product_id');
			$purchase->purchase_date = Tool::toMySqlDate(Input::get('date'));
			$purchase->quality = Input::get('quality');
			$purchase->supplier_id = Input::get('supplier_id') > 0 ? Input::get('supplier_id') : NULL;
			$purchase->note = Input::get('note');
			$purchase->save();
			
			# Update Product quality
			$product = Product::find(Input::get('product_id'));
			$product->quality = $product->quality+Input::get('quality');
			$product->save();
			
			# Find Purchase by ID
			$purchase = DB::table('purchase_view')->where('id',$purchase->id)->first();
			
			return Response::json(array(
		        'success' => true,
				'purchase' => $purchase,
		    ), 200);
		}

	}
	
	/**
	 * Purchase Json
	 * -------------
	 */
	public function get_json() {
	
		$query = array(
				'search' => Input::get('search'),
				'order' => Input::get('order'),
				'limit' => Input::get('limit'),
				'offset' => Input::get('offset')
		);
	
		$purchases = StockIo::allPurchases($query);
	
		if( $purchases['total'] > 0 ) {
			foreach( $purchases['data'] as $purchase ) {
					
				$data["total"] = $purchases['total'];
				$data["rows"][] = $purchase;
			}
		} else {
			$data['total'] = 0;
			$data['rows'] = array();
		}
	
		return Response::json($data,200)->setCallback(Input::get('callback'));
	}

	/**
	 * Purchase Remove
	 * ---------------
	 */
	public function remove() {
		
		$ids = explode(',', Route::input('ids'));
		
		foreach( $ids as $id ) {

			# Find Purchase
			$purchase = Purchase::find($id);
		
			# Update Product Quality
			$product = Product::find($purchase->product_id);
			$product->quality = $product->quality - $purchase->quality;
			$product->save();
			
			$purchase->delete();
		}
		
		return Response::json(array(
				'success' => true,
		));
	}
	
}