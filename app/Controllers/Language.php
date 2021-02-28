<?php


namespace App\Controllers;


class Language extends BaseController
{
	public function __construct()
	{
	}

	public function index():\CodeIgniter\HTTP\RedirectResponse
	{
		$session = session();
		$locale = $this->request->getLocale();
		$session->remove('lang');
		$session->set('lang', $locale);
		$url = base_url();
		return redirect()->to(previous_url());

	}
}