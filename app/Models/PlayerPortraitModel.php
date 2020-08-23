<?php namespace App\Models;

use CodeIgniter\Model;

class PlayerPortraitModel extends Model
{
	protected $table = 'playerPortrait';
	protected $primaryKey = 'playerId, portraitId';

	protected string $playerId;
	protected string $portraitId;
	protected bool $selected;

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
	 * @return string
	 */
	public function getPortraitId():string
	{
		return $this->portraitId;
	}

	/**
	 * @param string $portraitId
	 */
	public function setPortraitId(string $portraitId):void
	{
		$this->portraitId = $portraitId;
	}

	/**
	 * @return bool
	 */
	public function isSelected():bool
	{
		return $this->selected;
	}

	/**
	 * @param bool $selected
	 */
	public function setSelected(bool $selected):void
	{
		$this->selected = $selected;
	}

}