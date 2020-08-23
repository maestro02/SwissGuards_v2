<?php namespace App\Models;

use CodeIgniter\Model;

class RecipeResultModel extends Model
{
	protected $table = 'recipeResult';
	protected $primaryKey = 'recipeId, ingredientId';

	protected string $recipeId;
	protected string $ingredientId;

	/**
	 * @return string
	 */
	public function getRecipeId():string
	{
		return $this->recipeId;
	}

	/**
	 * @param string $recipeId
	 */
	public function setRecipeId(string $recipeId):void
	{
		$this->recipeId = $recipeId;
	}

	/**
	 * @return string
	 */
	public function getIngredientId():string
	{
		return $this->ingredientId;
	}

	/**
	 * @param string $ingredientId
	 */
	public function setIngredientId(string $ingredientId):void
	{
		$this->ingredientId = $ingredientId;
	}

}