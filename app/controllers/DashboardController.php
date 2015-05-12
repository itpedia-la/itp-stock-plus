<?php

/**
 * Dashboard Controller
 * --------------------
 * @author Somwang
 *
 */
class DashboardController extends BaseController {

	
	/**
	 * Dashboard Controller Index
	 * --------------------------
	 */
	public function index()
	{
		return View::make('dashboard');
	}
	
	
}