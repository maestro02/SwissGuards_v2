<?php namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Helpers\SwgohHelp;
use http\Exception;
use PHPUnit\Util\Json;
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

		$this->getCategoryList($swgoh);
		// $this->getAbilityList($swgoh);
		// $this->getEquipmentList($swgoh);
		// $this->getMaterialList($swgoh);
		// $this->getPlayerTitle($swgoh);
		// $this->getRecipeList($swgoh);
		// $this->getSkillList($swgoh);
		// $this->getUnitsList($swgoh);

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

		// return view('welcome_message');

	}

	public function getGuildData()
	{
		$swgoh = new SwgohHelp();
		$this->getGuild($swgoh);
		return view('welcome_message');
	}


	private function getGuild(SwgohHelp $swgoh):void
	{
		try {
			$guild = $swgoh->fetchGuild(256163745);
			$object = json_decode($guild);
			/* ToDo: Save Data to Model and Database */
			$this->getGuildMember($swgoh, $object);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	private function getGuildMember(SwgohHelp $swgoh, $json):void
	{
		$members = $json[0]->roster;
		foreach ($members as $member) {
			$list .= ', '.$member->allyCode;
		}
		try {
			$result_en = $swgoh->fetchPlayer($list);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	private function getCategoryList(SwgohHelp $swgoh)
	{
		// Get CategoryList
		$match = new StdClass();
		$match->visible = true;
		try {
			$result_en = $swgoh->fetchData('categoryList', 'eng_us', $match);
			$data['result_en'] = $result_en;
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
			$data['result_en'] = $e->getMessage();
		}
		try {
			$result_de = $swgoh->fetchData('categoryList', 'ger_de', $match);
			$data['result_de'] = $result_de;
			/* ToDo: Add Translations to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
			$data['result_de'] =  $e->getMessage();
		}

		return view('welcome_message', $data);
	}

	private function getAbilityList(SwgohHelp $swgoh):void
	{
		$projectCriteria = new StdClass();
		$projectCriteria->id = 1;
		$projectCriteria->nameKey = 1;
		$projectCriteria->descKey = 1;
		$projectCriteria->tierList = 1;
		$projectCriteria->cooldown = 1;
		$projectCriteria->icon = 1;
		$projectCriteria->ultimateChargeRequired = 1;
		$projectCriteria->updated = 1;
		try {
			$result_en = $swgoh->fetchData('abilityList', 'eng_us', $projectCriteria);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		$projectCriteria->tierList = 0;
		$projectCriteria->cooldown = 0;
		$projectCriteria->icon = 0;
		$projectCriteria->ultimateChargeRequired = 0;
		$projectCriteria->updated = 0;
		try {
			$result_de = $swgoh->fetchData('abilityList', 'ger_de', $projectCriteria);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	private function getEquipmentList(SwgohHelp $swgoh):void
	{
		$projectCriteria = new StdClass();
		$projectCriteria->id = 1;
		$projectCriteria->nameKey = 1;
		$projectCriteria->iconKey = 1;
		$projectCriteria->requiredLevel = 1;
		$projectCriteria->equipmentStat = 1;
		$projectCriteria->recipeId = 1;
		$projectCriteria->tier = 1;
		$projectCriteria->sellValue = 1;
		$projectCriteria->mark = 1;
		$projectCriteria->raidLookupList = 1;
		$projectCriteria->actionLinkLookupList = 1;
		$projectCriteria->requiredRarity = 1;
		$projectCriteria->updated = 1;
		try {
			$result_en = $swgoh->fetchData('equipmentList', 'eng_us', $projectCriteria);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		$projectCriteria_de = new StdClass();
		$projectCriteria_de->id = 1;
		$projectCriteria_de->nameKey = 1;
		$projectCriteria_de->iconKey = 1;
		try {
			$result_de = $swgoh->fetchData('equipmentList', 'ger_de', $projectCriteria_de);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	private function getMaterialList(SwgohHelp $swgoh):void
	{
		$result_en = $swgoh->fetchData('materialList');
		$projectCriteria_de = new StdClass();
		$projectCriteria_de->id = 1;
		$projectCriteria_de->nameKey = 1;
		$projectCriteria_de->descKey = 1;
		$result_de = $swgoh->fetchData('materialList', 'ger_de', $projectCriteria_de);
	}

	private function getPlayerTitle(SwgohHelp $swgoh):void
	{
		$projectCriteria = new StdClass();
		$projectCriteria->id = 1;
		$projectCriteria->nameKey = 1;
		$projectCriteria->descKey = 1;
		$projectCriteria->shortDescLevel = 1;
		$projectCriteria->updated = 1;
		try {
			$result_en = $swgoh->fetchData('playerTitleList', 'eng_us', $projectCriteria);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		try {
			$result_de = $swgoh->fetchData('playerTitleList', 'ger_de', $projectCriteria);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	private function getRecipeList(SwgohHelp $swgoh):void
	{
		try {
			$result_en = $swgoh->fetchData('recipeList');
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		$projectCriteria_de = new StdClass();
		$projectCriteria_de->id = 1;
		$projectCriteria_de->descKey = 1;
		try {
			$result_de = $swgoh->fetchData('recipeList', 'ger_de', $projectCriteria_de);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	private function getSkillList(SwgohHelp $swgoh):void
	{
		try {
			$result_en = $swgoh->fetchData('skillList');
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		$projectCriteria_de = new StdClass();
		$projectCriteria_de->id = 1;
		$projectCriteria_de->descKey = 1;
		$projectCriteria_de->tierList = 1;
		try {
			$result_de = $swgoh->fetchData('skillList', 'ger_de', $projectCriteria_de);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	private function getUnitsList(SwgohHelp $swgoh):void
	{
		$match = new StdClass();
		$match->rarity = 7;
		$match->obtainableTime = 0;
		$projectCriteria = new StdClass();
		$projectCriteria->id = 1;
		$projectCriteria->baseId = 1;
		$projectCriteria->nameKey = 1;
		$projectCriteria->descKey = 1;
		$projectCriteria->forceAlignment = 1;
		$projectCriteria->categoryIdList = 1;
		$projectCriteria->combatType = 1;
		$projectCriteria->skillReferenceList = 1;
		$projectCriteria->unitTierList = 1;
		$projectCriteria->relicDefinition = 1;
		$projectCriteria->modRecommendationList = 1;
		$projectCriteria->limitBreakRefList = 1;
		$projectCriteria->crewList = 1;
		$projectCriteria->updated = 1;
		try {
			$result_en = $swgoh->fetchData('unitsList', 'eng_us', $match, $projectCriteria);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		$projectCriteria_de = new StdClass();
		$projectCriteria_de->id = 1;
		$projectCriteria_de->baseId = 1;
		$projectCriteria_de->nameKey = 1;
		$projectCriteria_de->descKey = 1;
		try {
			$result_de = $swgoh->fetchData('unitsList', 'ger_de', $match, $projectCriteria_de);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	private function getTerritoryBattle(SwgohHelp $swgoh):void
	{
		try {
			$result_en = $swgoh->fetchData('territoryBattleDefinitionList', 'eng_us');
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		try {
			$result_de = $swgoh->fetchData('territoryBattleDefinitionList', 'ger_de');
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	private function callApi(SwgohHelp $swgoh, string $listName, StdClass $projectCriteria = null, StdClass $projectCriteria_de = null, StdClass $match = null):void
	{
		try {
			$result_en = $swgoh->fetchData($listName, 'eng_us', $match, $projectCriteria);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		try {
			$result_de = $swgoh->fetchData($listName, 'ger_de', $match, $projectCriteria_de);
			/* ToDo: Save Data to Model and Database */
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}

}
