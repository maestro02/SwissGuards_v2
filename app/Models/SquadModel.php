<?php namespace App\Models;

use CodeIgniter\Model;

class SquadModel extends Model
{
	protected $table = 'squad';
	protected $primaryKey = 'id';

	protected int $arenaId;
	protected string $toonId;
	protected int $squadType;

	/**
	 * @return int
	 */
	public function getArenaId():int
	{
		return $this->arenaId;
	}

	/**
	 * @param int $arenaId
	 */
	public function setArenaId(int $arenaId):void
	{
		$this->arenaId = $arenaId;
	}

	/**
	 * @return string
	 */
	public function getToonId():string
	{
		return $this->toonId;
	}

	/**
	 * @param string $toonId
	 */
	public function setToonId(string $toonId):void
	{
		$this->toonId = $toonId;
	}

	/**
	 * @return int
	 */
	public function getSquadType():int
	{
		return $this->squadType;
	}

	/**
	 * @param int $squadType
	 */
	public function setSquadType(int $squadType):void
	{
		$this->squadType = $squadType;
	}


}