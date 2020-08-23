<?php namespace App\Models;

use CodeIgniter\Model;

class ModModel extends Model
{
	protected $table = 'mod';
	protected $primaryKey = 'id';

	protected string $id;
	protected int $level;
	protected int $tier;
	protected int $set;
	protected int $pips;
	protected int $primaryStatType;
	protected int $primaryStatValue;
	protected int $slot;

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
	 * @return int
	 */
	public function getLevel():int
	{
		return $this->level;
	}

	/**
	 * @param int $level
	 */
	public function setLevel(int $level):void
	{
		$this->level = $level;
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
	 * @return int
	 */
	public function getSet():int
	{
		return $this->set;
	}

	/**
	 * @param int $set
	 */
	public function setSet(int $set):void
	{
		$this->set = $set;
	}

	/**
	 * @return int
	 */
	public function getPips():int
	{
		return $this->pips;
	}

	/**
	 * @param int $pips
	 */
	public function setPips(int $pips):void
	{
		$this->pips = $pips;
	}

	/**
	 * @return int
	 */
	public function getPrimaryStatType():int
	{
		return $this->primaryStatType;
	}

	/**
	 * @param int $primaryStatType
	 */
	public function setPrimaryStatType(int $primaryStatType):void
	{
		$this->primaryStatType = $primaryStatType;
	}

	/**
	 * @return int
	 */
	public function getPrimaryStatValue():int
	{
		return $this->primaryStatValue;
	}

	/**
	 * @param int $primaryStatValue
	 */
	public function setPrimaryStatValue(int $primaryStatValue):void
	{
		$this->primaryStatValue = $primaryStatValue;
	}

	/**
	 * @return int
	 */
	public function getSlot():int
	{
		return $this->slot;
	}

	/**
	 * @param int $slot
	 */
	public function setSlot(int $slot):void
	{
		$this->slot = $slot;
	}

}