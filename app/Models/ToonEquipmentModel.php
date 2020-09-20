<?php namespace App\Models;

use CodeIgniter\Model;

class ToonEquipmentModel extends Model
{
	protected $table = 'toonEquipment';
	protected $primaryKey = 'baseId, tier, slot, equipmentId';

	protected $allowedFields = [
		'baseId',
		'tier',
		'slot',
		'equipmentId'
	];
}