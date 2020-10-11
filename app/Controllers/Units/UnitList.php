<?php namespace App\Controllers\Units;

use App\Controllers\BaseController;
use App\Models\ToonModel;

class UnitList extends BaseController
{
	public function toonList():string
	{
		$toon = new ToonModel();
		$data['toons'] = $toon->asObject()->where('combatType', 'CHARACTER')->findAll();

		return view('Units/UnitList', $data);
	}

	public function shipList():string
	{
		$toon = new ToonModel();
		$data['toons'] = $toon->asObject()->where('combatType', 'SHIP')->findAll();

		return view('Units/UnitList', $data);
	}
}