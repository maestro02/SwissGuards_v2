<?php namespace App\Controllers\Units;

use App\Controllers\BaseController;
use App\Models\EnumsModel;
use App\Models\ToonModel;

class UnitList extends BaseController
{
	public function toonList():string
	{
		$toon = new ToonModel();
		$enums = new EnumsModel();
		$data['toons'] = $toon->asObject()->where('combatType', 'CHARACTER')->findAll();
		$data['enums'] = $enums->asObject()->findAll();
		$data['is_logged_in'] = logged_in();
		$data['page_title'] = 'Toon List';
		return view('Units/UnitList', $data);
	}

	public function shipList():string
	{
		$toon = new ToonModel();
		$enums = new EnumsModel();
		$data['toons'] = $toon->asObject()->where('combatType', 'SHIP')->findAll();
		$data['enums'] = $enums->asObject()->findAll();
		$data['is_logged_in'] = logged_in();
		$data['page_title'] = 'Ship List';
		return view('Units/UnitList', $data);
	}
}