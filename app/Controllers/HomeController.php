<?php namespace App\Controllers;

class HomeController extends BaseController
{
	public function index():string
	{
		$data['page_title'] = 'Swiss Guards @ SWGOH';


		return view('welcome_message', $data);
	}

	//--------------------------------------------------------------------

}
