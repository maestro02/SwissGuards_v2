<?php namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model
{
	protected $table = 'ingredient';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'type',
		'weight',
		'quantity',
		'rarity'
	];
}