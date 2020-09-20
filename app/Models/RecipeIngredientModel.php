<?php namespace App\Models;

use CodeIgniter\Model;

class RecipeIngredientModel extends Model
{
	protected $table = 'recipeIngredient';
	protected $primaryKey = 'recipeId, ingredientId';

	protected $allowedFields = [
		'recipeId',
		'ingredientId'
	];
}