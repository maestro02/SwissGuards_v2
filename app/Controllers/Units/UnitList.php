<?php namespace App\Controllers\Units;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\EnumsModel;
use App\Models\ToonCategoryModel;
use App\Models\ToonModel;

class UnitList extends BaseController
{
	public function toonList():string
	{
		$toon = new ToonModel();
		$enums = new EnumsModel();
		$toonCategory = new ToonCategoryModel();
		$cats = new CategoryModel();
		$toon = $toon->asObject()->where('combatType', 'CHARACTER')->findAll();
		$cats = $cats->asObject()->where('toonFilter', 1)->findAll();
		foreach ($toon as $t){
			$l = [];
			$t->tcList = $toonCategory->asObject()->where('baseId', $t->baseId)->findColumn('categoryId');
			foreach ($cats as $c){
				if(in_array($c->id, $t->tcList)){
					$l[] = $c;
				}
			}
			if (!empty($l)){
				$t->cats = $l;
			}
		}
		$data['toons'] = $toon;
		$data['enums'] = $enums->asObject()->findAll();
		$data['is_logged_in'] = logged_in();
		$data['page_title'] = 'Toon List';
		return view('Units/UnitList', $data);
	}

	public function shipList():string
	{
		$toon = new ToonModel();
		$enums = new EnumsModel();
		$toonCategory = new ToonCategoryModel();
		$cats = new CategoryModel();
		$toon = $toon->asObject()->where('combatType', 'SHIP')->findAll();
		$cats = $cats->asObject()->where('shipFilter', 1)->findAll();
		foreach ($toon as $t){
			$l = [];
			$t->tcList = $toonCategory->asObject()->where('baseId', $t->baseId)->findColumn('categoryId');
			foreach ($cats as $c){
				if(in_array($c->id, $t->tcList)){
					$l[] = $c;
				}
			}
			if (!empty($l)){
				$t->cats = $l;
			}
		}
		$data['toons'] = $toon;
		$data['enums'] = $enums->asObject()->findAll();
		$data['is_logged_in'] = logged_in();
		$data['page_title'] = 'Ship List';
		return view('Units/UnitList', $data);
	}
}