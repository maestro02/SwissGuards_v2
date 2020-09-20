<?php namespace App\Models;

use CodeIgniter\Model;

class RecipeResultModel extends Model
{
	protected $table = 'recipeResult';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'recipeId',
		'type',
		'quantity',
		'rarity'
	];
}