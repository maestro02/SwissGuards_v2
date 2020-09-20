<?php namespace App\Models;

use CodeIgniter\Model;

class ToonSkillModel extends Model
{
	protected $table = 'toonSkill';
	protected $primaryKey = 'baseId, skillId';

	protected $allowedFields = [
		'baseId',
		'skillId'
	];
}