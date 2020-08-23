<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialMissionModel extends Model
{
	protected $table = 'materialMission';
	protected $primaryKey = 'materialId, campaignId';

	protected string $materialId;
	protected string $campaignId;
	protected string $missionType;

	/**
	 * @return string
	 */
	public function getMaterialId():string
	{
		return $this->materialId;
	}

	/**
	 * @param string $materialId
	 */
	public function setMaterialId(string $materialId):void
	{
		$this->materialId = $materialId;
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