<?php namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model
{
	protected $table = 'ingredient';
	protected $primaryKey = 'id';

	protected string $id;
	protected int $type;
	protected int $weight;
	protected int $quantity;
	protected int $rarity;

	/**
	 * @return string
	 */
	public function getId():string
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setId(string $id):void
	{
		$this->id = $id;
	}

	/**
	 * @return int
	 */
	public function getType():int
	{
		return $this->type;
	}

	/**
	 * @param int $type
	 */
	public function setType(int $type):void
	{
		$this->type = $type;
	}

	/**
	 * @return int
	 */
	public function getWeight():int
	{
		return $this->weight;
	}

	/**
	 * @param int $weight
	 */
	public function setWeight(int $weight):void
	{
		$this->weight = $weight;
	}

	/**
	 * @return int
	 */
	public function getQuantity():int
	{
		return $this->quantity;
	}

	/**
	 * @param int $quantity
	 */
	public function setQuantity(int $quantity):void
	{
		$this->quantity = $quantity;
	}

	/**
	 * @return int
	 */
	public function getRarity():int
	{
		return $this->rarity;
	}

	/**
	 * @param int $rarity
	 */
	public function setRarity(int $rarity):void
	{
		$this->rarity = $rarity;
	}

}