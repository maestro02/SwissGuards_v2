<?php namespace App\Models;

use CodeIgniter\Model;

class ToonSkillModel extends Model
{
	protected $table = 'toonSkill';
	protected $primaryKey = 'toonId, skillId';

	protected string $toonId;
	protected string $skillId;
	protected int $tier;

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
	 * @return string
	 */
	public function getSkillId():string
	{
		return $this->skillId;
	}

	/**
	 * @param string $skillId
	 */
	public function setSkillId(string $skillId):void
	{
		$this->skillId = $skillId;
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

}