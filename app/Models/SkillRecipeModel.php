<?php namespace App\Models;

use CodeIgniter\Model;

class SkillRecipeModel extends Model
{
	protected $table = 'skillRecipe';
	protected $primaryKey = 'recipeId';

	protected $allowedFields = [
		'recipeId',
		'skillId',
		'tier',
		'requiredUnitLevel',
		'requiredUnitRarity',
		'requiredUnitTier',
		'requiredUnitRelicTier'
	];
}