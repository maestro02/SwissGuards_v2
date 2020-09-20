<?php namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Helpers\SwgohHelp;
use App\Models\AbilityModel;
use App\Models\AbilityTierModel;
use App\Models\CategoryModel;
use App\Models\CrewModel;
use App\Models\EquipmentMissionModel;
use App\Models\EquipmentModel;
use App\Models\GuildModel;
use App\Models\GuildPlayerModel;
use App\Models\MaterialMissionModel;
use App\Models\MaterialModel;
use App\Models\MissionIdentifierModel;
use App\Models\PlayerModel;
use App\Models\RecipeIngredientModel;
use App\Models\RecipeModel;
use App\Models\RecipeResultModel;
use App\Models\SkillModel;
use App\Models\SkillRecipeModel;
use App\Models\TitleModel;
use App\Models\ToonCategoryModel;
use App\Models\ToonEquipmentModel;
use App\Models\ToonModel;
use App\Models\ToonSkillModel;
use DateTime;
use http\Exception;
use JsonException;
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
		$data[] = [];
		$swgoh = new SwgohHelp();
		// $this->getCategoryList($swgoh);
		// $this->getAbilityListEn($swgoh);
		// $this->getAbilityListDe($swgoh);
		// $this->getEquipmentList($swgoh);
		// $this->getMaterialList($swgoh);
		// $this->getMaterialList($swgoh);
		// $this->getPlayerTitle($swgoh);
		// $this->getRecipeList($swgoh);
		// $this->getSkillList($swgoh);
		// $this->getUnitsList($swgoh);

		/*
		 * Probably needed Lists - not yet fully validated:
		 *
		 * effectList       =>      HIGH CHANCE FOR SERVER TIME OUT!
		 * requirementList
		 * statModList
		 * statModSetList
		 */
		$data['result_en'] = 'en';
		$data['result_de'] = 'de';
		return view('welcome_message', $data);
	}

	/**
	 *  getGuildData
	 *
	 *  guild data is part of the content who changes often, so this method has to be called regularly (e.g. daily).
	 *
	 *  method to refresh the guild data from api.swgoh.help
	 *  calls a subroutine "getGuildMember" to update all members
	 */
	public function getGuildData():void
	{
		$swgoh = new SwgohHelp();
		try {
			foreach (json_decode($swgoh->fetchGuild($_ENV['helpers.swgohhelp.allycode']), true, 512,
				JSON_THROW_ON_ERROR) as $g) {
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
		} catch (\Exception | ReflectionException | JsonException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * getGuildMember
	 *
	 * private method to update all guild members an their complete roster. Is always called from getGuildData.
	 *
	 * @param SwgohHelp $swgoh
	 * @param           $roster
	 * @param           $guildId
	 */
	private function getGuildMember(SwgohHelp $swgoh, $roster, $guildId):void
	{
		$idList[] = [];
		$allyList[] = [];
		$guildMember = new GuildPlayerModel();
		foreach ($roster as $member) {
			$allyList[] = $member['allyCode'];
			$idList[] = $member['id'];
			$data = [
				'guildId' => $guildId,
				'playerId' => $member['id'],
				'guildMemberStatus' => $member['guildMemberLevel']
			];
			try {
				if ($guildMember->find($member['id'])) {
					$guildMember->save($data);
				} else {
					$guildMember->insert($data);
				}
			} catch (ReflectionException $e) {
				echo $e->getMessage();
			}
		}
		foreach ($guildMember->findColumn('playerId') as $m) {
			if (!in_array($m, $idList, false)) {
				$data = [
					'guildId' => '',
					'playerId' => $m,
					'guildMemberStatus' => 0
				];
				try {
					$guildMember->update($data);
				} catch (ReflectionException $e) {
					echo $e->getMessage();
				}
			}
		}
		try {
			$dt = new DateTime();
			$player = new PlayerModel();
			foreach (json_decode($swgoh->fetchPlayer(implode(',', $idList)), false, 512, JSON_THROW_ON_ERROR) as $p) {
				$stats = [];
				foreach ($p->stats as $s) {
					$stats[] = $s->value;
				}


				/* ToDo: Load and save roster of each player */

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
		} catch (Exception | ReflectionException | JsonException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * getCategoryList
	 *
	 * the categoryList is part of the base data which hasn't to be updated very often (e.g. monthly).
	 * method to initially insert or update the category list.
	 *
	 * @param SwgohHelp $swgoh
	 */
	private function getCategoryList(SwgohHelp $swgoh):void
	{
		$match = new StdClass();
		$match->visible = true;
		$category = new CategoryModel();
		$idList[] = [];
		try {
			foreach (json_decode($swgoh->fetchData('categoryList', 'eng_us', $match), false, 512,
				JSON_THROW_ON_ERROR) as $item) {

				$dt = new DateTime();
				$idList[] = $item->id;
				$data = [
					'id' => $item->id,
					'descKeyEn' => $item->descKey,
					'toonFilter' => in_array(1, $item->uiFilterList, false),
					'shipFilter' => in_array(2, $item->uiFilterList, false),
					'updated' => $dt->setTimestamp(($item->updated) / 1000)->format('Y-m-d H:i:s')
				];
				if ($category->find($item->id)) {
					$category->save($data);
				} else {
					$category->insert($data);
				}
			}
		} catch (Exception | ReflectionException | JsonException $e) {
			echo $e->getMessage();
		}
		try {
			foreach (json_decode($swgoh->fetchData('categoryList', 'ger_de', $match), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$category->where('id', $item->id)->set(['descKeyDe' => $item->descKey])->update();
			}
		} catch (Exception | JsonException $e) {
			echo $e->getMessage();
		}
		foreach ($category->findColumn('id') as $dbItem) {
			if (!in_array($dbItem, $idList, false)) {
				$category->delete($dbItem);
			}
		}
	}

	/**
	 * getAbilityListEn
	 *
	 * the abilityList is part of the base data which hasn't to be updated very often (e.g. monthly).
	 * method to initially insert or update the category list.
	 *
	 * @param SwgohHelp $swgoh
	 */
	private function getAbilityListEn(SwgohHelp $swgoh):void
	{
		$ability = new AbilityModel();
		$abilityTier = new AbilityTierModel();
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
			foreach (json_decode($swgoh->fetchData('abilityList', 'eng_us', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$dt = new DateTime();
				$data = [
					'id' => $item->id,
					'nameKeyEn' => $item->nameKey,
					'descKeyEn' => $item->descKey,
					'cooldown' => $item->cooldown,
					'image' => $item->icon,
					'ultimateChargeRequired' => $item->ultimateChargeRequired,
					'updated' => $dt->setTimestamp(($item->updated) / 1000)->format('Y-m-d H:i:s')
				];
				if ($ability->find($item->id)) {
					$ability->save($data);
				} else {
					$ability->insert($data);
				}
				if (!empty($item->tierList)) {
					$i = 0;
					foreach ($item->tierList as $tier) {
						$i++;
						$abilityTierRef = $abilityTier->asObject()->where('abilityId', $item->id)->where('tier',
							$i)->first();
						$tierData = [
							'abilityId' => $item->id,
							'tier' => $i,
							'descKeyEn' => $tier->descKey,
							'upgradeDescKeyEn' => $tier->upgradeDescKey
						];
						if ($abilityTierRef) {
							$abilityTier->update($abilityTierRef->id, $tierData);
						} else {
							$abilityTier->insert($tierData);
						}
					}
				}
			}
		} catch (Exception | ReflectionException | JsonException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * getAbilityListDe
	 *
	 * the german translation of abilityList is part of the base data which hasn't to be updated very often (e.g.
	 * monthly). method to initially insert or update the translation of the ability list.
	 *
	 * @param SwgohHelp $swgoh
	 */
	private function getAbilityListDe(SwgohHelp $swgoh):void
	{
		$ability = new AbilityModel();
		$abilityTier = new AbilityTierModel();
		$projectCriteria = new StdClass();
		$projectCriteria->id = 1;
		$projectCriteria->nameKey = 1;
		$projectCriteria->descKey = 1;
		$projectCriteria->tierList = 1;
		try {
			foreach (json_decode($swgoh->fetchData('abilityList', 'ger_de', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$data = [
					'id' => $item->id,
					'nameKeyDe' => $item->nameKey,
					'descKeyDe' => $item->descKey,
				];
				$ability->where('id', $item->id)->set($data)->update();
				if (!empty($item->tierList)) {
					$i = 0;
					foreach ($item->tierList as $tier) {
						$i++;
						$abilityTierRef = $abilityTier->asObject()->where('abilityId', $item->id)->where('tier',
							$i)->first();
						$tierData = [
							'descKeyDe' => $tier->descKey,
							'upgradeDescKeyDe' => $tier->upgradeDescKey
						];
						$abilityTier->update($abilityTierRef->id, $tierData);
					}
				}
			}
		} catch (Exception | ReflectionException | JsonException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * getEquipmentList
	 *
	 * the equipmentList is part of the base data which hasn't to be updated very often (e.g. monthly).
	 * method to initially insert or update the category list.
	 *
	 * @param SwgohHelp $swgoh
	 */
	private function getEquipmentList(SwgohHelp $swgoh):void
	{
		$equipment = new EquipmentModel();
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
		$projectCriteria->lookupMissionList = 1;
		$projectCriteria->raidLookupList = 1;
		$projectCriteria->actionLinkLookupList = 1;
		$projectCriteria->requiredRarity = 1;
		$projectCriteria->updated = 1;
		try {
			foreach (json_decode($swgoh->fetchData('equipmentList', 'eng_us', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$dt = new DateTime();
				$data = [
					'id' => $item->id,
					'nameKeyEn' => $item->nameKey,
					'image' => $item->iconKey,
					'requiredLevel' => $item->requiredLevel,
					'recipeId' => $item->recipeId ? : '',
					'tier' => $item->tier,
					'mark' => $item->mark,
					'updated' => $dt->setTimestamp(($item->updated) / 1000)->format('Y-m-d H:i:s'),
					'sellCurrency' => $item->sellValue->currency ? : 0,
					'sellQuantity' => $item->sellValue->quantity ? : 0,
					'sellBonus' => $item->sellValue->bonusQuantity ? : 0
				];
				if ($equipment->find($item->id)) {
					$equipment->save($data);
				} else {
					$equipment->insert($data);
				}
				if ($item->lookupMissionList) {
					$this->setMission($item->lookupMissionList, 'farm', 'equipmentMission', $item->id);
				}
				if ($item->raidLookupList) {
					$this->setMission($item->raidLookupList, 'raid', 'equipmentMission', $item->id);
				}
				if ($item->actionLinkLookupList) {
					$this->setMission($item->actionLinkLookupList, 'event', 'equipmentMission', $item->id);
				}
			}
		} catch (Exception | JsonException | ReflectionException $e) {
			echo $e->getMessage();
		}
		$projectCriteria_de = new StdClass();
		$projectCriteria_de->id = 1;
		$projectCriteria_de->nameKey = 1;
		try {
			foreach (json_decode($swgoh->fetchData('equipmentList', 'ger_de', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$equipment->where('id', $item->id)->set(['nameKeyDe' => $item->nameKey])->update();
			}
		} catch (Exception | JsonException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * getMaterialList
	 *
	 * the materialList is part of the base data which hasn't to be updated very often (e.g. monthly).
	 * method to initially insert or update the category list.
	 *
	 * @param SwgohHelp $swgoh
	 */
	private function getMaterialList(SwgohHelp $swgoh):void
	{
		$material = new MaterialModel();
		$projectCriteria = new StdClass();
		$projectCriteria->id = 1;
		$projectCriteria->nameKey = 1;
		$projectCriteria->descKey = 1;
		$projectCriteria->iconKey = 1;
		$projectCriteria->sellValue = 1;
		$projectCriteria->lookupMissionList = 1;
		$projectCriteria->xpValue = 1;
		$projectCriteria->type = 1;
		$projectCriteria->rarity = 1;
		$projectCriteria->tier = 1;
		$projectCriteria->raidLookupList = 1;
		$projectCriteria->updated = 1;
		try {
			foreach (json_decode($swgoh->fetchData('materialList', 'eng_us', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$dt = new DateTime();
				$data = [
					'id' => $item->id,
					'nameKeyEn' => $item->nameKey,
					'descKeyEn' => $item->descKey,
					'image' => $item->iconKey,
					'sellCurrency' => $item->sellValue->currency ? : 0,
					'sellQuantity' => $item->sellValue->quantity ? : 0,
					'sellBonus' => $item->sellValue->bonusQuantity ? : 0,
					'xp' => $item->xpValue,
					'type' => $item->type,
					'rarity' => $item->rarity,
					'tier' => $item->tier,
					'updated' => $dt->setTimestamp(($item->updated) / 1000)->format('Y-m-d H:i:s')
				];
				if ($material->find($item->id)) {
					$material->save($data);
				} else {
					$material->insert($data);
				}
				if (!empty($item->lookupMissionList)) {
					$this->setMission($item->lookupMissionList, 'farm', 'materialMission', $item->id);
				}
				if (!empty($item->raidLookupList)) {
					$this->setMission($item->raidLookupList, 'raid', 'materialMission', $item->id);
				}
			}
		} catch (Exception | JsonException | ReflectionException $e) {
			echo $e->getMessage();
		}

		$projectCriteria_de = new StdClass();
		$projectCriteria_de->id = 1;
		$projectCriteria_de->nameKey = 1;
		$projectCriteria_de->descKey = 1;
		try {
			foreach (json_decode($swgoh->fetchData('materialList', 'ger_de', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$dataDe = [
					'nameKeyDe' => $item->nameKey,
					'descKeyDe' => $item->descKey,
				];
				$material->where('id', $item->id)->set($dataDe)->update();
			}
		} catch (Exception | JsonException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * getPlayerTitle
	 *
	 * the playerTitle list is part of the base data which hasn't to be updated very often (e.g. monthly).
	 * method to initially insert or update the category list.
	 *
	 * @param SwgohHelp $swgoh
	 */
	private function getPlayerTitle(SwgohHelp $swgoh):void
	{
		$title = new TitleModel();
		$projectCriteria = new StdClass();
		$projectCriteria->id = 1;
		$projectCriteria->nameKey = 1;
		$projectCriteria->descKey = 1;
		$projectCriteria->shortDescKey = 1;
		$projectCriteria->updated = 1;

		try {
			foreach (json_decode($swgoh->fetchData('playerTitleList', 'eng_us', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$dt = new DateTime();
				$idList[] = $item->id;
				$data = [
					'id' => $item->id,
					'nameKeyEn' => $item->nameKey,
					'descKeyEn' => $item->descKey,
					'shortDescKeyEn' => $item->shortDescKey,
					'updated' => $dt->setTimestamp(($item->updated) / 1000)->format('Y-m-d H:i:s')
				];
				if ($title->find($item->id)) {
					$title->save($data);
				} else {
					$title->insert($data);
				}
			}
		} catch (Exception | ReflectionException | JsonException $e) {
			echo $e->getMessage();
		}
		try {
			foreach (json_decode($swgoh->fetchData('playerTitleList', 'ger_de', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$dataDe = [
					'nameKeyDe' => $item->nameKey,
					'descKeyDe' => $item->descKey,
					'shortDescKeyDe' => $item->shortDescKey,
				];
				$title->where('id', $item->id)->set($dataDe)->update();
			}
		} catch (Exception | JsonException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * getRecipeList
	 *
	 * the recipeList is part of the base data which hasn't to be updated very often (e.g. monthly).
	 * method to initially insert or update the category list.
	 *
	 * @param SwgohHelp $swgoh
	 */
	private function getRecipeList(SwgohHelp $swgoh):void
	{
		$recipe = new RecipeModel();
		$recipeIngredient = new RecipeIngredientModel();
		$recipeResult = new RecipeResultModel();
		$projectCriteria = new StdClass();
		$projectCriteria->id = 1;
		$projectCriteria->descKey = 1;
		$projectCriteria->iconKey = 1;
		$projectCriteria->result = 1;
		$projectCriteria->ingredientsList = 1;
		$projectCriteria->type = 1;
		$projectCriteria->updated = 1;
		try {
			foreach (json_decode($swgoh->fetchData('recipeList', 'eng_us', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$dt = new DateTime();
				$data = [
					'id' => $item->id,
					'descKeyEn' => $item->descKey,
					'type' => $item->type,
					'updated' => $dt->setTimestamp(($item->updated) / 1000)->format('Y-m-d H:i:s')
				];
				if ($recipe->find($item->id)) {
					$recipe->save($data);
				} else {
					$recipe->insert($data);
				}
				if (!empty($item->ingredientsList)) {
					foreach ($item->ingredientsList as $ingredient) {
						if (!$recipeIngredient->asObject()->where('recipeId', $item->id)->where('ingredientId',
							$ingredient->id)->first()) {
							$ingredientData = [
								'recipeId' => $item->id,
								'ingredientId' => $ingredient->id,
							];
							$recipeIngredient->insert($ingredientData);
						}
					}
				}
				if (!empty($item->result)) {
					$res = $item->result;
					if (!$recipeResult->asObject()->where('id', $res->id)->first()) {
						$resultData = [
							'id' => $res->id,
							'recipeId' => $item->id,
							'type' => $res->type,
							'quantity' => $res->maxQuantity,
							'rarity' => $res->rarity
						];
						$recipeResult->insert($resultData);
					}
				}
			}
		} catch (Exception | ReflectionException | JsonException $e) {
			echo $e->getMessage();
		}
		$projectCriteria_de = new StdClass();
		$projectCriteria_de->id = 1;
		$projectCriteria_de->descKey = 1;
		try {
			foreach (json_decode($swgoh->fetchData('recipeList', 'ger_de', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$recipe->where('id', $item->id)->set(['descKeyDe' => $item->descKey])->update();
			}
		} catch (Exception | JsonException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * getSkillList
	 *
	 * the skillList is part of the base data which hasn't to be updated very often (e.g. monthly).
	 * method to initially insert or update the category list.
	 *
	 * @param SwgohHelp $swgoh
	 */
	private function getSkillList(SwgohHelp $swgoh):void
	{
		$skill = new SkillModel();
		$skillRecipe = new SkillRecipeModel();
		$projectCriteria = new StdClass();
		$projectCriteria->id = 1;
		$projectCriteria->nameKey = 1;
		$projectCriteria->iconKey = 1;
		$projectCriteria->tierList = 1;
		$projectCriteria->abilityReference = 1;
		$projectCriteria->skillType = 1;
		$projectCriteria->isZeta = 1;
		$projectCriteria->updated = 1;
		try {
			foreach (json_decode($swgoh->fetchData('skillList', 'eng_us', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$dt = new DateTime();
				$data = [
					'id' => $item->id,
					'nameKeyEn' => $item->nameKey,
					'image' => $item->iconKey,
					'abilityId' => $item->abilityReference,
					'skillType' => $item->skillType,
					'zeta' => $item->isZeta,
					'updated' => $dt->setTimestamp(($item->updated) / 1000)->format('Y-m-d H:i:s')
				];
				if ($skill->find($item->id)) {
					$skill->save($data);
				} else {
					$skill->insert($data);
				}
				if (!empty($item->tierList)) {
					$i = 0;
					foreach ($item->tierList as $tier) {
						$i++;
						$skillTier = $skillRecipe->asObject()->find($tier->recipeId);
						$tierData = [
							'recipeId' => $tier->recipeId,
							'skillId' => $item->id,
							'tier' => $i,
							'requiredUnitLevel' => $tier->requiredUnitLevel,
							'requiredUnitRarity' => $tier->requiredUnitRarity,
							'requiredUnitTier' => $tier->requiredUnitTier,
							'requiredUnitRelicTier' => $tier->requiredUnitRelicTier
						];
						if ($skillTier) {
							$skillRecipe->update($skillTier->recipeId, $tierData);
						} else {
							$skillRecipe->insert($tierData);
						}
					}
				}
			}
		} catch (Exception | ReflectionException | JsonException $e) {
			echo $e->getMessage();
		}
		$projectCriteria_de = new StdClass();
		$projectCriteria_de->id = 1;
		$projectCriteria_de->nameKey = 1;
		try {
			foreach (json_decode($swgoh->fetchData('skillList', 'ger_de', null, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$skill->where('id', $item->id)->set(['nameKeyDe' => $item->nameKey])->update();
			}
		} catch (Exception | JsonException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * getUnitsList
	 *
	 * the unitsList is part of the base data which hasn't to be updated very often (e.g. monthly).
	 * method to initially insert or update the category list.
	 *
	 * @param SwgohHelp $swgoh
	 */
	private function getUnitsList(SwgohHelp $swgoh):void
	{
		$toon = new ToonModel();
		$toonCategory = new ToonCategoryModel();
		$category = new CategoryModel();
		$toonSkill = new ToonSkillModel();
		$skill = new SkillModel();
		$equipment = new ToonEquipmentModel();
		$crew = new CrewModel();
		$match = new StdClass();
		$match->rarity = 7;
		$match->obtainableTime = 0;
		$projectCriteria = new StdClass();
		$projectCriteria->baseId = 1;
		$projectCriteria->nameKey = 1;
		$projectCriteria->descKey = 1;
		$projectCriteria->forceAlignment = 1;
		$projectCriteria->categoryIdList = 1;
		$projectCriteria->combatType = 1;
		$projectCriteria->skillReferenceList = 1;
		$projectCriteria->unitTierList = 1;
		// $projectCriteria->relicDefinition = 1;
		// $projectCriteria->modRecommendationList = 1;
		// $projectCriteria->limitBreakRefList = 1;
		$projectCriteria->crewList = 1;
		$projectCriteria->updated = 1;
		try {
			foreach (json_decode($swgoh->fetchData('unitsList', 'eng_us', $match, $projectCriteria), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$dt = new DateTime();
				$data = [
					'baseId' => $item->baseId,
					'nameKeyEn' => $item->nameKey,
					'descKeyEn' => $item->descKey,
					'forceAlignment' => $item->forceAlignment,
					'combatType' => $item->combatType,
					'updated' => $dt->setTimestamp(($item->updated) / 1000)->format('Y-m-d H:i:s')
				];
				if ($toon->find($item->baseId)) {
					$toon->save($data);
				} else {
					$toon->insert($data);
				}
				if (!empty($item->categoryIdList)) {
					foreach ($item->categoryIdList as $c) {
						if ($category->asObject()->find($c) && !$toonCategory->asObject()->where('categoryId',
								$c)->where('baseId', $item->baseId)->first()) {
							$catData = [
								'baseId' => $item->baseId,
								'categoryId' => $c
							];
							$toonCategory->insert($catData);
						}
					}
				}
				if (!empty($item->skillReferenceList)) {
					foreach ($item->skillReferenceList as $s) {
						if ($skill->asObject()->find($s->skillId) && !$toonSkill->asObject()->where('skillId',
								$s->skillId)->where('baseId', $item->baseId)->first()) {
							$skillData = [
								'baseId' => $item->baseId,
								'skillId' => $s->skillId
							];
							$toonSkill->insert($skillData);
						}
					}
				}
				if (!empty($item->unitTierList)) {
					foreach ($item->unitTierList as $tier) {
						$i = 0;
						foreach ($tier->equipmentSetList as $gear) {
							$i++;
							$equipData = [
								'baseId' => $item->baseId,
								'tier' => $tier->tier,
								'slot' => $i,
								'equipmentId' => $gear
							];
							if (!$equipment->asObject()->where('baseId', $item->baseId)->where('slot',
								$i)->where('equipmentId', $gear)->where('tier', $tier->tier)->first()) {
								$equipment->insert($equipData);
							}
						}
					}
				}
				if (!empty($item->crewList)) {
					foreach ($item->crewList as $c) {
						$crewData = [
							'baseId' => $item->baseId,
							'crewId' => $c->unitId,
							'slot' => $c->slot
						];
						if (!$crew->asObject()->where('baseId', $item->baseId)->where('crewId', $c->unitId)->first()) {
							$crew->insert($crewData);
						} else {
							$crew->where('baseId', $item->baseId)->where('crewId',
								$c->unitId)->set($crewData)->update();
						}
					}
				}
				/* ToDo: ModRecommendationList */
				/* ToDo: RelicDefinition */
			}
		} catch (Exception | ReflectionException | JsonException $e) {
			echo $e->getMessage();
		}
		$projectCriteria_de = new StdClass();
		$projectCriteria_de->baseId = 1;
		$projectCriteria_de->nameKey = 1;
		$projectCriteria_de->descKey = 1;
		try {
			foreach (json_decode($swgoh->fetchData('unitsList', 'ger_de', $match, $projectCriteria_de), false, 512,
				JSON_THROW_ON_ERROR) as $item) {
				$toonData = [
					'nameKeyDe' => $item->nameKey,
					'descKeyDe' => $item->descKey
				];
				$toon->update($item->baseId, $toonData);
			}
		} catch (Exception | JsonException | ReflectionException $e) {
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

	/**
	 * setMission
	 *
	 * the setMission method is a helper method and is part of the base data collecting actions which hasn't to be
	 * updated very often (e.g. monthly). method to initially insert or update the category list.
	 *
	 * @param $list
	 * @param $farmType
	 * @param $missionType
	 * @param $refId
	 */
	private function setMission($list, $farmType, $missionType, $refId):void
	{
		$missionId = new MissionIdentifierModel();
		foreach ($list as $mission) {
			$missionRef = $missionId->asObject()->where('campaignId',
				$mission->missionIdentifier->campaignId)->where('campaignMapId',
				$mission->missionIdentifier->campaignMapId)->where('campaignNodeId',
				$mission->missionIdentifier->campaignNodeId)->where('campaignNodeDifficulty',
				$mission->missionIdentifier->campaignNodeDifficulty)->where('campaignMissionId',
				$mission->missionIdentifier->campaignMissionId)->first();

			$missionData = [
				'campaignId' => $mission->missionIdentifier->campaignId,
				'campaignMapId' => $mission->missionIdentifier->campaignMapId,
				'campaignNodeId' => $mission->missionIdentifier->campaignNodeId,
				'campaignNodeDifficulty' => $mission->missionIdentifier->campaignNodeDifficulty,
				'campaignMissionId' => $mission->missionIdentifier->campaignMissionId
			];
			if ($missionRef) {
				try {
					$missionId->update($missionRef->id, $missionData);
				} catch (ReflectionException $e) {
					echo $e->getMessage();
				}
			} else {
				try {
					$missionId->insert($missionData);
				} catch (ReflectionException $e) {
					echo $e->getMessage();
				}
				$missionRef = $missionId->asObject()->where('campaignId',
					$mission->missionIdentifier->campaignId)->where('campaignMapId',
					$mission->missionIdentifier->campaignMapId)->where('campaignNodeId',
					$mission->missionIdentifier->campaignNodeId)->where('campaignNodeDifficulty',
					$mission->missionIdentifier->campaignNodeDifficulty)->where('campaignMissionId',
					$mission->missionIdentifier->campaignMissionId)->first();
			}
			if ($missionType === 'materialMission') {
				$materialMission = new MaterialMissionModel();
				$ref = $materialMission->asObject()->where('materialId', $refId)->where('missionId',
					$missionRef->id)->first();
				$data = [
					'materialId' => $refId,
					'missionId' => $missionRef->id,
					'missionType' => $farmType
				];
				if ($ref) {
					$materialMission->set($data)->where('materialId', $ref->materialId)->where('missionId',
						$ref->missionId)->update();
				} else {
					try {
						$materialMission->insert($data);
					} catch (ReflectionException $e) {
						echo $e->getMessage();
					}
				}
			} elseif ($missionType === 'equipmentMission') {
				$equipmentMission = new EquipmentMissionModel();
				$ref = $equipmentMission->asObject()->where('equipmentId', $refId)->where('missionId',
					$missionRef->id)->first();
				$data = [
					'equipmentId' => $refId,
					'missionId' => $missionRef->id,
					'missionType' => $farmType
				];
				if ($ref) {
					$equipmentMission->set($data)->where('equipmentId', $ref->equipmentId)->where('missionId',
						$ref->missionId)->update();
				} else {
					try {
						$equipmentMission->insert($data);
					} catch (ReflectionException $e) {
						echo $e->getMessage();
					}
				}
			}
		}
	}
}
