<?php namespace App\Models;

use CodeIgniter\Model;

class PlayerToonModel extends Model
{
	protected $table = 'playerToon';
	protected $primaryKey = 'id';

	protected string $id;
	protected string $baseId;
	protected string $playerId;
	protected int $rarity;
	protected int $level;
	protected int $xp;
	protected int $gear;
	protected int $gp;
	protected int $relictTier;

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

	/**
	 * @return int
	 */
	public function getRarity():int
	{
		return $this->rarity;
	}

	/**
	 * @param int $rarity
	 */
	public function setRarity(int $rarity):void
	{
		$this->rarity = $rarity;
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
	public function getXp():int
	{
		return $this->xp;
	}

	/**
	 * @param int $xp
	 */
	public function setXp(int $xp):void
	{
		$this->xp = $xp;
	}

	/**
	 * @return int
	 */
	public function getGear():int
	{
		return $this->gear;
	}

	/**
	 * @param int $gear
	 */
	public function setGear(int $gear):void
	{
		$this->gear = $gear;
	}

	/**
	 * @return int
	 */
	public function getGp():int
	{
		return $this->gp;
	}

	/**
	 * @param int $gp
	 */
	public function setGp(int $gp):void
	{
		$this->gp = $gp;
	}

	/**
	 * @return int
	 */
	public function getRelictTier():int
	{
		return $this->relictTier;
	}

	/**
	 * @param int $relictTier
	 */
	public function setRelictTier(int $relictTier):void
	{
		$this->relictTier = $relictTier;
	}
}