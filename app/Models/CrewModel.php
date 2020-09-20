<?php namespace App\Models;

use CodeIgniter\Model;

class CrewModel extends Model
{
	protected $table = 'crew';
	protected $primaryKey = 'baseId, crewId';

	protected $allowedFields = [
		'baseId',
		'crewId',
		'slot'
	];
}