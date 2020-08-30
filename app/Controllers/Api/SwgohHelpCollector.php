<?php namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Helpers\SwgohHelp;
use App\Models\CategoryModel;
use App\Models\GuildModel;
use App\Models\GuildPlayerModel;
use App\Models\PlayerModel;
use DateTime;
use http\Exception;
use ReflectionException;
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

		$data['result_en'] = 'en';
		$data['result_de'] = 'de';

		return view('welcome_message', $data);

	}

	public function getGuildData()
	{
		$swgoh = new SwgohHelp();
		$this->getGuild($swgoh);
		$data['result_en'] = 'en_done';
		$data['result_de'] = 'de_done';
		return view('welcome_message', $data);
	}


	private function getGuild(SwgohHelp $swgoh):void
	{
		try {
			foreach (json_decode($swgoh->fetchGuild(256163745), true, 512, JSON_THROW_ON_ERROR) as $g) {
				$result = '';
				$dt = new DateTime();
				$guild = new GuildModel();
				$data = [
					'id' => $g['id'],
					'memberCount' => $g['members'],
					'name' => $g['name'],
					'gp' => $g['gp'],
					'updated' => $dt->setTimestamp(($g['updated']) / 1000)->format('Y-m-d H:i:s')
				];
				if ($guild->find($g['id'])) {
					$guild->save($data);
				} else {
					$guild->insert($data);
				}
				$this->getGuildMember($swgoh, $g['roster'], $g['id']);
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	private function getGuildMember(SwgohHelp $swgoh, $roster, $guildId):void
	{
		$list = '';
		foreach ($roster as $member) {
			$list .= ', '.$member['allyCode'];
			$guildMember = new GuildPlayerModel();
			$data = [
				'guildId'   =>  $guildId,
				'playerId'  =>  $member['id'],
				'guildMemberStatus' =>  $member['guildMemberLevel']
			];
			if ($guildMember->where('guildId',$guildId)->find($member['id'])) {
				try {
					$guildMember->save($data);
				} catch (ReflectionException $e) {
					echo $e->getMessage();
				}
			} else {
				try {
					$guildMember->insert($data);
				} catch (ReflectionException $e) {
					echo $e->getMessage();
				}
			}
		}
		$list = substr($list, 2);
		try {
			foreach (json_decode($swgoh->fetchPlayer($list), false, 512, JSON_THROW_ON_ERROR) as $p) {
				$stats = array();
				foreach ($p->stats as $s){
					$stats[] = $s->value;
				}
				$dt = new DateTime();
				$player = new PlayerModel();
				$data = [
					'id' => $p->id,
					'name' => $p->name,
					'allyCode' => $p->allyCode,
					'level' => $p->level,
					'guildId' => $p->guildRefId,
					'lastActivity' => $dt->setTimestamp(($p->lastActivity) / 1000)->format('Y-m-d H:i:s'),
					'gpTotal' => $stats[0],
					'gpToon' => $stats[1],
					'gpShip' => $stats[2],
					'lifetimeChampionshipScore' => $stats[3],
					'fleetArenaBattlesWon' => $stats[4],
					'squadArenaBattlesWon' => $stats[5],
					'totalBattlesWon' => $stats[6],
					'hardBattlesWon' => $stats[7],
					'galacticWarBattlesWon' => $stats[8],
					'guildRaidsWon' => $stats[9],
					'guildTokensEarned' => $stats[10],
					'gearDonatedinGuildExchange' => $stats[11],
					'championshipPromotionsEarned' => $stats[12],
					'championshipOffensiveBattlesWon' => $stats[13],
					'championshipSuccessfulBattleDefends' => $stats[14],
					'championshipBannersEarned' => $stats[15],
					'championshipFullRoundsCleared' => $stats[16],
					'championshipUndersizedSquadBattlesWon' => $stats[17],
					'championshipTerritoriesDefeated' => $stats[18],
					'updated' => $dt->setTimestamp(($p->updated) / 1000)->format('Y-m-d H:i:s')
				];
				if ($player->find($p->id)) {
					$player->save($data);
				} else {
					$player->insert($data);
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	private function getCategoryList(SwgohHelp $swgoh):void
	{
		$match = new StdClass();
		$match->visible = true;
		try {
			foreach (json_decode($swgoh->fetchData('categoryList', 'eng_us', $match), false, 512,
				JSON_THROW_ON_ERROR) as $e) {
				$dt = new DateTime();
				$category = new CategoryModel();
				$data = [
					'id' => $e->id,
					'descKeyEn' => $e->descKey,
					'toonFilter' => in_array(1, $e->uiFilterList, false),
					'shipFilter' => in_array(2, $e->uiFilterList, false),
					'updated' => $dt->setTimestamp(($e->updated) / 1000)->format('Y-m-d H:i:s')
				];
				if ($category->find($e->id)) {
					$category->save($data);
				} else {
					$category->insert($data);
				}
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		try {
			foreach (json_decode($swgoh->fetchData('categoryList', 'ger_de', $match), false, 512,
				JSON_THROW_ON_ERROR) as $e) {
				$categoryModel = new CategoryModel();
				$categoryModel->whereIn('id', [$e->id])->set(['descKeyDe' => $e->descKey])->update();
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
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

	private function callApi(
		SwgohHelp $swgoh,
		string $listName,
		StdClass $projectCriteria = null,
		StdClass $projectCriteria_de = null,
		StdClass $match = null
	):void {
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
