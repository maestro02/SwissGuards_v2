<?php namespace App\Models;

use CodeIgniter\Model;

class PlayerTitleModel extends Model
{
	protected $table = 'playerTitle';
	protected $primaryKey = 'playerId, titleId';

	protected string $playerId;
	protected string $titleId;
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
	public function getTitleId():string
	{
		return $this->titleId;
	}

	/**
	 * @param string $titleId
	 */
	public function setTitleId(string $titleId):void
	{
		$this->titleId = $titleId;
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