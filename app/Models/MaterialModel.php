<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
	protected $table = 'material';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'nameKeyEn',
		'nameKeyDe',
		'descKeyEn',
		'descKeyDe',
		'image',
		'sellCurrency',
		'sellQuantity',
		'sellBonus',
		'xp',
		'type',
		'rarity',
		'tier',
		'updated'
	];
}