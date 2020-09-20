<?php namespace App\Models;

use CodeIgniter\Model;

class ToonModel extends Model
{
	protected $table = 'toon';
	protected $primaryKey = 'baseId';

	protected $allowedFields = [
		'baseId',
		'nameKeyEn',
		'nameKeyDe',
		'descKeyEn',
		'descKeyDe',
		'image',
		'maxRarity',
		'forceAlignment',
		'combatType',
		'updated',
		'ggImg'
	];
}