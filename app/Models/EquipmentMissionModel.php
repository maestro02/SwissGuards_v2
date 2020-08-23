<?php namespace App\Models;

use CodeIgniter\Model;

class EquipmentMissionModel extends Model
{
	protected $table = 'equipmentMission';
	protected $primaryKey = 'equipmentId, campaignId';

	protected string $equipmentId;
	protected string $campaignId;
	protected string $missionType;

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
	 * @return string
	 */
	public function getCampaignId():string
	{
		return $this->campaignId;
	}

	/**
	 * @param string $campaignId
	 */
	public function setCampaignId(string $campaignId):void
	{
		$this->campaignId = $campaignId;
	}

	/**
	 * @return string
	 */
	public function getMissionType():string
	{
		return $this->missionType;
	}

	/**
	 * @param string $missionType
	 */
	public function setMissionType(string $missionType):void
	{
		$this->missionType = $missionType;
	}

}