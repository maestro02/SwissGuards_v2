<?php namespace App\Models;

use CodeIgniter\Model;

class SecondaryStatModModel extends Model
{
	protected $table = 'secondaryStatMod';
	protected $primaryKey = 'id';

	protected int $id;
	protected string $modId;
	protected int $statType;
	protected int $statValue;
	protected int $roll;

	/**
	 * @return int
	 */
	public function getId():int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getModId():string
	{
		return $this->modId;
	}

	/**
	 * @param string $modId
	 */
	public function setModId(string $modId):void
	{
		$this->modId = $modId;
	}

	/**
	 * @return int
	 */
	public function getStatType():int
	{
		return $this->statType;
	}

	/**
	 * @param int $statType
	 */
	public function setStatType(int $statType):void
	{
		$this->statType = $statType;
	}

	/**
	 * @return int
	 */
	public function getStatValue():int
	{
		return $this->statValue;
	}

	/**
	 * @param int $statValue
	 */
	public function setStatValue(int $statValue):void
	{
		$this->statValue = $statValue;
	}

	/**
	 * @return int
	 */
	public function getRoll():int
	{
		return $this->roll;
	}

	/**
	 * @param int $roll
	 */
	public function setRoll(int $roll):void
	{
		$this->roll = $roll;
	}

}