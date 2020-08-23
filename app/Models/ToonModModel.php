<?php namespace App\Models;

use CodeIgniter\Model;

class ToonModModel extends Model
{
	protected $table = 'toonMod';
	protected $primaryKey = 'toonId, modId';

	protected string $toonId;
	protected string $modId;

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

}