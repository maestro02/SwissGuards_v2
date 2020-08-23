<?php namespace App\Models;

use CodeIgniter\Model;

class AbilityTierModel extends Model
{
	protected $table = 'abilityTier';
	protected $primaryKey = 'id';

	protected int $id;
	protected int $abilityId;
	protected int $tier;
	protected string $descKeyEn;
	protected string $descKeyDe;
	protected string $upgradeDescKeyEn;
	protected string $upgradeDescKeyDe;

	/**
	 * @return int
	 */
	public function getId():int
	{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getAbilityId():int
	{
		return $this->abilityId;
	}

	/**
	 * @param int $abilityId
	 */
	public function setAbilityId(int $abilityId):void
	{
		$this->abilityId = $abilityId;
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
	public function getUpgradeDescKeyEn():string
	{
		return $this->upgradeDescKeyEn;
	}

	/**
	 * @param string $upgradeDescKeyEn
	 */
	public function setUpgradeDescKeyEn(string $upgradeDescKeyEn):void
	{
		$this->upgradeDescKeyEn = $upgradeDescKeyEn;
	}

	/**
	 * @return string
	 */
	public function getUpgradeDescKeyDe():string
	{
		return $this->upgradeDescKeyDe;
	}

	/**
	 * @param string $upgradeDescKeyDe
	 */
	public function setUpgradeDescKeyDe(string $upgradeDescKeyDe):void
	{
		$this->upgradeDescKeyDe = $upgradeDescKeyDe;
	}

}