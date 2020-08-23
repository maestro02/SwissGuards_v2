<?php namespace App\Models;

use CodeIgniter\Model;

class crewModel extends Model
{
	protected $table = 'crew';
	protected $primaryKey = 'id';

	protected int $id;
	protected string $baseId;
	protected int $slot;

	/**
	 * @return int
	 */
	public function getId():int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id):void
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