<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
	protected $table = 'material';
	protected $primaryKey = 'id';

	protected string $id;
	protected string $nameKeyEn;
	protected string $nameKeyDe;
	protected string $descKeyEn;
	protected string $descKeyDe;
	protected string $image;
	protected int $sellCurrency;
	protected int $sellQuantity;
	protected int $sellBonus;
	protected int $xp;
	protected int $type;
	protected int $rarity;
	protected int $tier;
	protected string $recipeId;
	protected \DateTime $updated;

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
	 * @return string
	 */
	public function getNameKeyEn():string
	{
		return $this->nameKeyEn;
	}

	/**
	 * @param string $nameKeyEn
	 */
	public function setNameKeyEn(string $nameKeyEn):void
	{
		$this->nameKeyEn = $nameKeyEn;
	}

	/**
	 * @return string
	 */
	public function getNameKeyDe():string
	{
		return $this->nameKeyDe;
	}

	/**
	 * @param string $nameKeyDe
	 */
	public function setNameKeyDe(string $nameKeyDe):void
	{
		$this->nameKeyDe = $nameKeyDe;
	}

	/**
	 * @return string
	 */
	public function getDescKeyEn():string
	{
		return $this->descKeyEn;
	}

	/**
	 * @param string $descKeyEn
	 */
	public function setDescKeyEn(string $descKeyEn):void
	{
		$this->descKeyEn = $descKeyEn;
	}

	/**
	 * @return string
	 */
	public function getDescKeyDe():string
	{
		return $this->descKeyDe;
	}

	/**
	 * @param string $descKeyDe
	 */
	public function setDescKeyDe(string $descKeyDe):void
	{
		$this->descKeyDe = $descKeyDe;
	}

	/**
	 * @return string
	 */
	public function getImage():string
	{
		return $this->image;
	}

	/**
	 * @param string $image
	 */
	public function setImage(string $image):void
	{
		$this->image = $image;
	}

	/**
	 * @return int
	 */
	public function getSellCurrency():int
	{
		return $this->sellCurrency;
	}

	/**
	 * @param int $sellCurrency
	 */
	public function setSellCurrency(int $sellCurrency):void
	{
		$this->sellCurrency = $sellCurrency;
	}

	/**
	 * @return int
	 */
	public function getSellQuantity():int
	{
		return $this->sellQuantity;
	}

	/**
	 * @param int $sellQuantity
	 */
	public function setSellQuantity(int $sellQuantity):void
	{
		$this->sellQuantity = $sellQuantity;
	}

	/**
	 * @return int
	 */
	public function getSellBonus():int
	{
		return $this->sellBonus;
	}

	/**
	 * @param int $sellBonus
	 */
	public function setSellBonus(int $sellBonus):void
	{
		$this->sellBonus = $sellBonus;
	}

	/**
	 * @return int
	 */
	public function getXp():int
	{
		return $this->xp;
	}

	/**
	 * @param int $xp
	 */
	public function setXp(int $xp):void
	{
		$this->xp = $xp;
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

	/**
	 * @return int
	 */
	public function getTier():int
	{
		return $this->tier;
	}

	/**
	 * @param int $tier
	 */
	public function setTier(int $tier):void
	{
		$this->tier = $tier;
	}

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
	 * @return int
	 */
	public function getUpdated():int
	{
		return $this->updated;
	}

	/**
	 * @param int $updated
	 */
	public function setUpdated(int $updated):void
	{
		$this->updated = $updated;
	}

}