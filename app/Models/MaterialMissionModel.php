<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialMissionModel extends Model
{
	protected $table = 'materialMission';
	protected $primaryKey = 'materialId, campaignId';

	protected $allowedFields = [
		'materialId',
		'missionId',
		'missionType'
	];
}