<?php namespace App\Models;

use CodeIgniter\Model;

class EquipmentModel extends Model
{
	protected $table = 'equipment';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'nameKeyEn',
		'nameKeyDe',
		'image',
		'requiredLevel',
		'recipeId',
		'tier',
		'mark',
		'updated',
		'sellCurrency',
		'sellQuantity',
		'sellBonus'
	];
}