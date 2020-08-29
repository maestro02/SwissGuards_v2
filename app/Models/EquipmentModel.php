<?php namespace App\Models;

use CodeIgniter\Model;

class EquipmentModel extends Model
{
	protected $table = 'equipment';
	protected $primaryKey = 'id';

	protected string $id;
	protected string $nameKeyEn;
	protected string $nameKeyDe;
	protected int $requiredLevel;
	protected string $recipeId;
	protected int $tier;
	protected string $mark;
	protected \DateTime $updated;
	protected int $sellCurrency;
	protected int $sellQuantity;
	protected int $sellBonus;

	/**
	 * @return string
	 */
	public function getId():string
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setId(string $id):void
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getNameKeyEn():string
	{
		return $this->nameKeyEn;
	}

	/**
	 * @param string $nameKeyEn
	 */
	public function setNameKeyEn(string $nameKeyEn):void
	{
		$this->nameKeyEn = $nameKeyEn;
	}

	/**
	 * @return string
	 */
	public function getNameKeyDe():string
	{
		return $this->nameKeyDe;
	}

	/**
	 * @param string $nameKeyDe
	 */
	public function setNameKeyDe(string $nameKeyDe):void
	{
		$this->nameKeyDe = $nameKeyDe;
	}

	/**
	 * @return int
	 */
	public function getRequiredLevel():int
	{
		return $this->requiredLevel;
	}

	/**
	 * @param int $requiredLevel
	 */
	public function setRequiredLevel(int $requiredLevel):void
	{
		$this->requiredLevel = $requiredLevel;
	}

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
	 * @return int
	 */
	public function getTier():int
	{
		return $this->tier;
	}

	/**
	 * @param int $tier
	 */
	public function setTier(int $tier):void
	{
		$this->tier = $tier;
	}

	/**
	 * @return string
	 */
	public function getMark():string
	{
		return $this->mark;
	}

	/**
	 * @param string $mark
	 */
	public function setMark(string $mark):void
	{
		$this->mark = $mark;
	}

	/**
	 * @return int
	 */
	public function getUpdated():int
	{
		return $this->updated;
	}

	/**
	 * @param int $updated
	 */
	public function setUpdated(int $updated):void
	{
		$this->updated = $updated;
	}

	/**
	 * @return int
	 */
	public function getSellCurrency():int
	{
		return $this->sellCurrency;
	}

	/**
	 * @param int $sellCurrency
	 */
	public function setSellCurrency(int $sellCurrency):void
	{
		$this->sellCurrency = $sellCurrency;
	}

	/**
	 * @return int
	 */
	public function getSellQuantity():int
	{
		return $this->sellQuantity;
	}

	/**
	 * @param int $sellQuantity
	 */
	public function setSellQuantity(int $sellQuantity):void
	{
		$this->sellQuantity = $sellQuantity;
	}

	/**
	 * @return int
	 */
	public function getSellBonus():int
	{
		return $this->sellBonus;
	}

	/**
	 * @param int $sellBonus
	 */
	public function setSellBonus(int $sellBonus):void
	{
		$this->sellBonus = $sellBonus;
	}

}