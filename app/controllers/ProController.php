<?php

/**
 * Product Controller
 * ------------------
 * @author Somwang
 *
 */
class ProController extends BaseController {

	
	/**
	 * Product Index
	 * -------------
	 */
	public function index()
	{

		return View::make('product/index');
	}
	
	/**
	 * Product form
	 * ------------
	 */
	public function form() {
		
		$product_id = Route::input('product_id');

		$product = $product_id > 0 ? Product::find($product_id) : null;
		
		return View::make('product/form')->with('product',$product);
	}
	
	/**
	 * Product form save
	 * -------------------
	 */
	public function form_save() {
		
		$product_id = Input::get('product_id');

		$rules = array(
				'code'          => 'required',
				'description'   => 'required',
				'category'     	=> 'required',
				'quality'     	=> 'required',
				'unit'     		=> 'required',
				//'cost'     		=> 'required',
				//'price'     	=> 'required',
				'alert_quality' => 'required',
		);
		
		$messages = array(
				'code.required' => 'ກະລຸນາໃສ່ລະຫັດສິນຄ້າ',
				'description.required' => 'ກະລຸນາໃສ່ລາຍລະອຽດສິນຄ້າ',
				'category.required' => 'ກະລຸນາເລືອກໝວດສິນຄ້າ',
				'quality.required' => 'ກະລຸນາໃສ່ຈຳນວນສິນຄ້າ',
				'unit.required' => 'ກະລຸນາໃສ່ຫົວໜ່ວຍສິນຄ້າ',
				//'cost.required' => 'ກະລຸນາໃສ່ລາຄາຕົ້ນທຶນສິນຄ້າ',
				//'price.required' => 'ກະລຸນາໃສ່ລາຄາຂາຍສິນຄ້າ',
				'alert_quality.required' => 'ກະລຸນາໃສ່ຈຳນວນແຈ້ງ',
		);
		
		$validator = Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails()) {
		
			$messages = $validator->messages();
		
			return Redirect::to( $product_id > 0 ? 'product/edit/'.$product_id : 'product/add' )->withErrors($validator)->withInput();
		
		} else {
			
			# Find duplicate product by code
			$dubProduct = Product::where('code',Input::get('code'))->get()->count();
			if( $dubProduct > 0 && $product_id == null) {
				return Redirect::to( $product_id > 0 ? 'product/edit/'+$product_id : 'product/add')->withErrors(array('0'=>'ລະຫັດສິນຄ້າຊຳກັນ ກະລຸນາລອງໃຫມ່'))->withInput();
			}
			
			$product = $product_id > 0 ? Product::find($product_id) : new Product();
			$product->code = Input::get('code');
			$product->item_name = Input::get('description');
			$product->stock_category_idx = Input::get('category');
			$product->quality = Input::get('quality');
			$product->stock_unit_idx_use = Input::get('unit');
			//$product->cost = Input::get('cost');
			//$product->price = Input::get('price');
			$product->alert_quality = Input::get('alert_quality');

			$destinationPath = '';
		    $filename        = '';
		
		    /*if (Input::hasFile('image')) {

		        $file            = Input::file('image');
		        $destinationPath = public_path() . '/img/products/';
		        $filename        = Input::get('code').'.'.$file->getClientOriginalExtension();
		        $uploadSuccess   = $file->move($destinationPath, $filename);
		        
		        $image = Image::make(sprintf($destinationPath.'%s', $filename ))->resize(120, 120)->save();
		    }*/
    
		   // $product->image = $filename;
			$product->save();
			
			return Redirect::to( $product_id > 0 ? URL::to('product/') : URL::to('product/add'))->with('message','ລາຍການສິນຄ້າໄດ້ຖືກບັນທຶກແລ້ວ');
		
		}
	}
	
	/**
	 * PRoduct Json
	 * -------------
	 */
	public function get_json() {
	
		$query = array(
				'search' => Input::get('search'),
				'order' => Input::get('order'),
				'mode' => Input::get('mode'),
				'limit' => Input::get('limit'),
				'offset' => Input::get('offset')
		);
		
		$products = Product::allProducts($query);
		
		foreach( $products['data'] as $product ) {
			
			$data["total"]  = $products['total'];
			$data["rows"][] = $product;
		}
	
		return Response::json($data)->setCallback(Input::get('callback'));
	}
	
	/**
	 * Product Remove 
	 * --------------
	 */
	public function remove() {
		
		$ids = explode(',', Route::input('ids'));
		
		foreach( $ids as $id ) {
			
			$product = Product::find($id);
			$product->delete();
		}
		
		return Response::json(array(
				'success' => true,
		),200);
	}
	
	/**
	 * Find Product by Code
	 * --------------------
	 */
	public function findByCode() {
		
		$code = Route::input('code');

		$data = DB::table('view_stock_item')->where('code','=',$code);
		
		if( $data->count() > 0 ) {
			return Response::json($data->get(),200)->setCallback(Input::get('callback'));
		} else {
			return Response::json($data->get(),400)->setCallback(Input::get('callback'));
		}
		
	}
	
}