<?php

/**
 * Category Controller
 * ------------------
 * @author Somwang
 *
 */
class ProductController extends BaseController {

	
	/**
	 * Category Index
	 * -------------
	 */
	public function index()
	{
		//return View::make('category/index');
	}
	
	/**
	 * Category form
	 * ------------
	 */
	public function form() {
		
		//return View::make('category/form');
	}
	
	/**
	 * Category form save
	 * -------------------
	 */
	public function form_save() {
		
		$product_id = Input::get('product_id');
		
		$rules = array(
				'name'          => 'required',
				//'parent_id'   => 'required',
		);
		
		$messages = array(
				'name.required' => 'ກະລຸນາໃສ່ລະຫັດສິນຄ້າ',
				//'parent_id.required' => 'ກະລຸນາໃສ່ລາຍລະອຽດສິນຄ້າ',
		);
		
		$validator = Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails()) {
		
			$messages = $validator->messages();
		
			return Redirect::to('product/add')->withErrors($validator)->withInput();
		
		} else {
			
			$category = new Category();
			$product->name = Input::get('name');
			$product->save();
			
			return Redirect::to('product/add')->with('message','ລາຍການສິນຄ້າໄດ້ຖືກບັນທຶກແລ້ວ');
		
		}
	}
	
}