<?php namespace App\Models;

use CodeIgniter\Model;

class EquipmentMissionModel extends Model
{
	protected $table = 'equipmentMission';
	protected $primaryKey = 'equipmentId, missionId';

	protected $allowedFields = [
		'equipmentId',
		'missionId',
		'missionType'
	];
}