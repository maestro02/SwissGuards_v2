<?php namespace App\Models;

use CodeIgniter\Model;

class ToonEquipmentModel extends Model
{
	protected $table = 'toonEquipment';
	protected $primaryKey = 'toonId, equipmentId';

	protected string $toonId;
	protected string $equipmentId;
	protected int $slot;

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
	public function getEquipmentId():string
	{
		return $this->equipmentId;
	}

	/**
	 * @param string $equipmentId
	 */
	public function setEquipmentId(string $equipmentId):void
	{
		$this->equipmentId = $equipmentId;
	}

	/**
	 * @return int
	 */
	public function getSlot():int
	{
		return $this->slot;
	}

	/**
	 * @param int $slot
	 */
	public function setSlot(int $slot):void
	{
		$this->slot = $slot;
	}


}