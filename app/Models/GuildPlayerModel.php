<?php namespace App\Models;

use CodeIgniter\Model;

class GuildPlayerModel extends Model
{
	protected $table = 'guildPlayer';
	protected $primaryKey = 'id, allyCode';

	protected string $id;
	protected int $allyCode;
	protected int $guildMemberStatus;

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
	public function getGuildMemberStatus():int
	{
		return $this->guildMemberStatus;
	}

	/**
	 * @param int $guildMemberStatus
	 */
	public function setGuildMemberStatus(int $guildMemberStatus):void
	{
		$this->guildMemberStatus = $guildMemberStatus;
	}


}