<?php namespace App\Models;

use CodeIgniter\Model;

class MissionIdentifierModel extends Model
{
	protected $table = 'missionIdentifier';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'campaignId',
		'campaignMapId',
		'campaignNodeId',
		'campaignNodeDifficulty',
		'campaignMissionId'
	];
}