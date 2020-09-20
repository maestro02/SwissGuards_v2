<?php namespace App\Models;

use CodeIgniter\Model;

class AbilityModel extends Model
{
	protected $table = 'ability';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'nameKeyEn',
		'nameKeyDe',
		'descKeyEn',
		'descKeyDe',
		'cooldown',
		'image',
		'ultimateChargeRequired',
		'updated'
	];

}