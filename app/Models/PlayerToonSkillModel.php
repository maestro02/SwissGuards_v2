<?php namespace App\Models;

use CodeIgniter\Model;

class PlayerToonSkillModel extends Model
{
	protected $table = 'playerToonSkill';
	protected $primaryKey = 'toonId, skillId';

	protected $allowedFields = [
		'toonId',
		'skillId',
		'tier'
	];
}