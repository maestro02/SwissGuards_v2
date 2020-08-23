<?php namespace App\Models;

use CodeIgniter\Model;

class ArenaModel extends Model
{
	protected $table = 'arena';
	protected $primaryKey = 'id';

	protected int $id;
	protected int $arenaType;
	protected int $rank;
	protected int $squadId;
	protected string $playerId;

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
	public function getArenaType():int
	{
		return $this->arenaType;
	}

	/**
	 * @param int $arenaType
	 */
	public function setArenaType(int $arenaType):void
	{
		$this->arenaType = $arenaType;
	}

	/**
	 * @return int
	 */
	public function getRank():int
	{
		return $this->rank;
	}

	/**
	 * @param int $rank
	 */
	public function setRank(int $rank):void
	{
		$this->rank = $rank;
	}

	/**
	 * @return int
	 */
	public function getSquadId():int
	{
		return $this->squadId;
	}

	/**
	 * @param int $squadId
	 */
	public function setSquadId(int $squadId):void
	{
		$this->squadId = $squadId;
	}

	/**
	 * @return string
	 */
	public function getPlayerId():string
	{
		return $this->playerId;
	}

	/**
	 * @param string $playerId
	 */
	public function setPlayerId(string $playerId):void
	{
		$this->playerId = $playerId;
	}


}