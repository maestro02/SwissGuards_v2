<?php namespace App\Models;

use CodeIgniter\Model;

class AbilityTierModel extends Model
{
	protected $table = 'abilityTier';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'abilityId',
		'tier',
		'descKeyEn',
		'descKeyDe',
		'upgradeDescKeyEn',
		'upgradeDescKeyDe',
	];

}