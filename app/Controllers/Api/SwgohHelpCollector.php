<?php namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Helpers\SwgohHelp;
use http\Exception;
use stdClass;

class SwgohHelpCollector extends BaseController
{
	public function index()
	{
		$swgoh = new SwgohHelp();
		$swgoh->login();
		return view('welcome_message');
	}

	public function list()
	{
		$swgoh = new SwgohHelp();
		$swgoh->login();
		return view('welcome_message');
	}

	public function getBaseData()
	{
		$swgoh = new SwgohHelp();

		// Get CategoryList
		$matchCategory = new StdClass();
		$matchCategory->visible = true;
		try {
			$data['categoryList'] = $swgoh->fetchData('categoryList', 'eng_us', $matchCategory);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		try {
			$data['categoryList_de'] = $swgoh->fetchData('categoryList', 'ger_de', $matchCategory);
			/* ToDo: Add Translations to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}


		$projectAbilityList = new StdClass();
		$projectAbilityList->id = 1;
		$projectAbilityList->nameKey = 1;
		$projectAbilityList->descKey = 1;
		$projectAbilityList->tierList = 1;
		$projectAbilityList->cooldown = 1;
		$projectAbilityList->icon = 1;
		$projectAbilityList->ultimateChargeRequired = 1;
		$projectAbilityList->updated = 1;
		$data['abilityList'] = $swgoh->fetchData('abilityList', 'eng_us', $projectAbilityList);
		$projectAbilityList->tierList = 0;
		$projectAbilityList->cooldown = 0;
		$projectAbilityList->icon = 0;
		$projectAbilityList->ultimateChargeRequired = 0;
		$projectAbilityList->updated = 0;
		$data['abilityList_de'] = $swgoh->fetchData('abilityList', 'ger_de', $projectAbilityList);


		$projectEquipmentList = new StdClass();
		$projectEquipmentList->id = 1;
		$projectEquipmentList->nameKey = 1;
		$projectEquipmentList->iconKey = 1;
		$projectEquipmentList->requiredLevel = 1;
		$projectEquipmentList->equipmentStat = 1;
		$projectEquipmentList->recipeId = 1;
		$projectEquipmentList->tier = 1;
		$projectEquipmentList->sellValue = 1;
		$projectEquipmentList->mark = 1;
		$projectEquipmentList->raidLookupList = 1;
		$projectEquipmentList->actionLinkLookupList = 1;
		$projectEquipmentList->requiredRarity = 1;
		$projectEquipmentList->updated = 1;
		$data['equipmentList'] = $swgoh->fetchData('equipmentList', 'eng_us', $projectEquipmentList);
		$equipmentList_de = new StdClass();
		$equipmentList_de->id = 1;
		$equipmentList_de->nameKey = 1;
		$equipmentList_de->iconKey = 1;
		$data['equipmentList_de'] = $swgoh->fetchData('equipmentList', 'ger_de', $equipmentList_de);


		$data['categoryList'] = $swgoh->fetchData('materialList');
		$categoryList_de = new StdClass();
		$categoryList_de->id = 1;
		$categoryList_de->nameKey = 1;
		$categoryList_de->descKey = 1;
		$data['categoryList_de'] = $swgoh->fetchData('materialList', 'ger_de', $categoryList_de);


		$projectPlayerTitleList = new StdClass();
		$projectPlayerTitleList->id = 1;
		$projectPlayerTitleList->nameKey = 1;
		$projectPlayerTitleList->descKey = 1;
		$projectPlayerTitleList->shortDescLevel = 1;
		$projectPlayerTitleList->updated = 1;
		$data['$projectPlayerTitleList'] = $swgoh->fetchData('playerTitleList', 'eng_us', $projectPlayerTitleList);
		$data['$projectPlayerTitleList_de'] = $swgoh->fetchData('playerTitleList', 'ger_de', $projectPlayerTitleList);


		$data['recipeList'] = $swgoh->fetchData('recipeList');
		$recipeList_de = new StdClass();
		$recipeList_de->id = 1;
		$recipeList_de->descKey = 1;
		$data['recipeList_de'] = $swgoh->fetchData('recipeList', 'ger_de', $recipeList_de);


		$data['skillList'] = $swgoh->fetchData('skillList');
		$skillList_de = new StdClass();
		$skillList_de->id = 1;
		$skillList_de->descKey = 1;
		$skillList_de->tierList = 1;
		$data['skillList_de'] = $swgoh->fetchData('skillList', 'ger_de', $skillList_de);


		$data['territoryBattleDefinitionList'] = $swgoh->fetchData('territoryBattleDefinitionList', 'eng_us');
		$data['territoryBattleDefinitionList_de'] = $swgoh->fetchData('territoryBattleDefinitionList', 'eng_us');


		$matchUnitsList = new StdClass();
		$matchUnitsList->rarity = 7;
		$matchUnitsList->obtainableTime = 0;
		$projectUnitsList = new StdClass();
		$projectUnitsList->id = 1;
		$projectUnitsList->baseId = 1;
		$projectUnitsList->nameKey = 1;
		$projectUnitsList->descKey = 1;
		$projectUnitsList->forceAlignment = 1;
		$projectUnitsList->categoryIdList = 1;
		$projectUnitsList->combatType = 1;
		$data['unitsList'] = $swgoh->fetchData('unitsList', 'eng_us', $matchUnitsList, $projectUnitsList);
		$data['unitsList_de'] = $swgoh->fetchData('unitsList', 'ger_de', $matchUnitsList, $projectUnitsList);


		/*
		 *
		 * Probably needed Lists - not yet fully validated:
		 *
		 * effectList       =>      HIGH CHANCE FOR SERVER TIME OUT!
		 * requirementList
		 * statModList
		 * statModSetList
		 *
		 */

		return view('welcome_message', $data);

	}

	public function getGuildData()
	{
		$swgoh = new SwgohHelp();

		$guild = $swgoh->fetchGuild(256163745);
		$data['guild'] = $guild;
		$object = json_decode($guild);
		$members = $object[0]->roster;
		foreach ($members as $member) {
			$list .= ', '.$member->allyCode;
		}
		$data['members'] = $swgoh->fetchPlayer($list);

		return view('welcome_message', $data);
	}

}
