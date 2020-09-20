<?php namespace App\Models;

use CodeIgniter\Model;

class SkillModel extends Model
{
	protected $table = 'skill';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'nameKeyEn',
		'nameKeyDe',
		'image',
		'abilityId',
		'skillType',
		'zeta',
		'updated'
	];
}