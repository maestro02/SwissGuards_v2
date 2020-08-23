<?php namespace App\Models;

use CodeIgniter\Model;

class PlayerModel extends Model
{
	protected $table = 'player';
	protected $primaryKey = 'id';

	protected string $id;
	protected string $name;
	protected int $allyCode;
	protected int $level;
	protected string $guildId;
	protected int $lastActivity;
	protected int $updated;

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
	public function getName():string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name):void
	{
		$this->name = $name;
	}

	/**
	 * @return int
	 */
	public function getAllyCode():int
	{
		return $this->allyCode;
	}

	/**
	 * @param int $allyCode
	 */
	public function setAllyCode(int $allyCode):void
	{
		$this->allyCode = $allyCode;
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
	 * @return string
	 */
	public function getGuildId():string
	{
		return $this->guildId;
	}

	/**
	 * @param string $guildId
	 */
	public function setGuildId(string $guildId):void
	{
		$this->guildId = $guildId;
	}

	/**
	 * @return int
	 */
	public function getLastActivity():int
	{
		return $this->lastActivity;
	}

	/**
	 * @param int $lastActivity
	 */
	public function setLastActivity(int $lastActivity):void
	{
		$this->lastActivity = $lastActivity;
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