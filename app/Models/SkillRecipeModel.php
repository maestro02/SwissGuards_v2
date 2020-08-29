<?php namespace App\Models;

use CodeIgniter\Model;

class SkillRecipeModel extends Model
{
	protected $table = 'skillRecipe';
	protected $primaryKey = 'recipeId, skillId';

	protected string $recipeId;
	protected string $skillId;
	protected int $requiredUnitLevel;
	protected int $requiredUnitRarity;
	protected int $requiredUnitTier;
	protected int $requiredUnitRelicTier;

	/**
	 * @return string
	 */
	public function getRecipeId():string
	{
		return $this->recipeId;
	}

	/**
	 * @param string $recipeId
	 */
	public function setRecipeId(string $recipeId):void
	{
		$this->recipeId = $recipeId;
	}

	/**
	 * @return string
	 */
	public function getSkillId():string
	{
		return $this->skillId;
	}

	/**
	 * @param string $skillId
	 */
	public function setSkillId(string $skillId):void
	{
		$this->skillId = $skillId;
	}

	/**
	 * @return int
	 */
	public function getRequiredUnitLevel():int
	{
		return $this->requiredUnitLevel;
	}

	/**
	 * @param int $requiredUnitLevel
	 */
	public function setRequiredUnitLevel(int $requiredUnitLevel):void
	{
		$this->requiredUnitLevel = $requiredUnitLevel;
	}

	/**
	 * @return int
	 */
	public function getRequiredUnitRarity():int
	{
		return $this->requiredUnitRarity;
	}

	/**
	 * @param int $requiredUnitRarity
	 */
	public function setRequiredUnitRarity(int $requiredUnitRarity):void
	{
		$this->requiredUnitRarity = $requiredUnitRarity;
	}

	/**
	 * @return int
	 */
	public function getRequiredUnitTier():int
	{
		return $this->requiredUnitTier;
	}

	/**
	 * @param int $requiredUnitTier
	 */
	public function setRequiredUnitTier(int $requiredUnitTier):void
	{
		$this->requiredUnitTier = $requiredUnitTier;
	}

	/**
	 * @return int
	 */
	public function getRequiredUnitRelicTier():int
	{
		return $this->requiredUnitRelicTier;
	}

	/**
	 * @param int $requiredUnitRelicTier
	 */
	public function setRequiredUnitRelicTier(int $requiredUnitRelicTier):void
	{
		$this->requiredUnitRelicTier = $requiredUnitRelicTier;
	}

}