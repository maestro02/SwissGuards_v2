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
		return view('Units/UnitList', $data);
	}

	public function shipList():string
	{
		$toon = new ToonModel();
		$enums = new EnumsModel();
		$data['toons'] = $toon->asObject()->where('combatType', 'SHIP')->findAll();
		$data['enums'] = $enums->asObject()->findAll();

		return view('Units/UnitList', $data);
	}
}