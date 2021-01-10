<?php


namespace App\Controllers;


class LanguageController extends BaseController
{
	public function __construct()
	{
		$session = session();
		$session->set('lang', ($session->lang !== "") ? $session->lang : "de");
	}

	public function index()
	{
		$session = session();
		$session->set('lang', ($session->lang !== "") ? $session->lang : "de");
		return redirect()->to(base_url());
	}

	public function languageSwitch(string $value)
	{
		$session = session();
		$session->set('lang', $value);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
}