<?php namespace App\Models;

use CodeIgniter\Model;

class MissionIdentifierModel extends Model
{
	protected $table = 'missionIdentifier';
	protected $primaryKey = 'campaignId';

	protected string $campaignId;
	protected string $campaignMapId;
	protected string $campaignModeId;
	protected string $campaignNodeDifficulty;
	protected string $campaignMissionId;

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
	public function getCampaignMapId():string
	{
		return $this->campaignMapId;
	}

	/**
	 * @param string $campaignMapId
	 */
	public function setCampaignMapId(string $campaignMapId):void
	{
		$this->campaignMapId = $campaignMapId;
	}

	/**
	 * @return string
	 */
	public function getCampaignModeId():string
	{
		return $this->campaignModeId;
	}

	/**
	 * @param string $campaignModeId
	 */
	public function setCampaignModeId(string $campaignModeId):void
	{
		$this->campaignModeId = $campaignModeId;
	}

	/**
	 * @return string
	 */
	public function getCampaignNodeDifficulty():string
	{
		return $this->campaignNodeDifficulty;
	}

	/**
	 * @param string $campaignNodeDifficulty
	 */
	public function setCampaignNodeDifficulty(string $campaignNodeDifficulty):void
	{
		$this->campaignNodeDifficulty = $campaignNodeDifficulty;
	}

	/**
	 * @return string
	 */
	public function getCampaignMissionId():string
	{
		return $this->campaignMissionId;
	}

	/**
	 * @param string $campaignMissionId
	 */
	public function setCampaignMissionId(string $campaignMissionId):void
	{
		$this->campaignMissionId = $campaignMissionId;
	}

}