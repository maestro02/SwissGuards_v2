<?php namespace App\Models;

use CodeIgniter\Model;

class ToonModel extends Model
{
	protected $table = 'toon';
	protected $primaryKey = 'baseId';

	protected string $baseId;
	protected string $nameKeyEn;
	protected string $nameKeyDe;
	protected string $descKeyEn;
	protected string $descKeyDe;
	protected string $iconName;
	protected int $maxRarity;
	protected string $forceAlignment;
	protected string $combatType;
	protected int $updated;

	/**
	 * @return string
	 */
	public function getBaseId():string
	{
		return $this->baseId;
	}

	/**
	 * @param string $baseId
	 */
	public function setBaseId(string $baseId):void
	{
		$this->baseId = $baseId;
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
	 * @return string
	 */
	public function getDescKeyEn():string
	{
		return $this->descKeyEn;
	}

	/**
	 * @param string $descKeyEn
	 */
	public function setDescKeyEn(string $descKeyEn):void
	{
		$this->descKeyEn = $descKeyEn;
	}

	/**
	 * @return string
	 */
	public function getDescKeyDe():string
	{
		return $this->descKeyDe;
	}

	/**
	 * @param string $descKeyDe
	 */
	public function setDescKeyDe(string $descKeyDe):void
	{
		$this->descKeyDe = $descKeyDe;
	}

	/**
	 * @return string
	 */
	public function getIconName():string
	{
		return $this->iconName;
	}

	/**
	 * @param string $iconName
	 */
	public function setIconName(string $iconName):void
	{
		$this->iconName = $iconName;
	}

	/**
	 * @return int
	 */
	public function getMaxRarity():int
	{
		return $this->maxRarity;
	}

	/**
	 * @param int $maxRarity
	 */
	public function setMaxRarity(int $maxRarity):void
	{
		$this->maxRarity = $maxRarity;
	}

	/**
	 * @return string
	 */
	public function getForceAlignment():string
	{
		return $this->forceAlignment;
	}

	/**
	 * @param string $forceAlignment
	 */
	public function setForceAlignment(string $forceAlignment):void
	{
		$this->forceAlignment = $forceAlignment;
	}

	/**
	 * @return string
	 */
	public function getCombatType():string
	{
		return $this->combatType;
	}

	/**
	 * @param string $combatType
	 */
	public function setCombatType(string $combatType):void
	{
		$this->combatType = $combatType;
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

}