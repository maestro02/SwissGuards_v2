<?php namespace App\Models;

use CodeIgniter\Model;

class AbilityModel extends Model
{
	protected $table = 'ability';
	protected $primaryKey = 'id';

	protected string $id;
	protected string $nameKeyEn;
	protected string $nameKeyDe;
	protected string $descKeyEn;
	protected string $descKeyDe;
	protected int $cooldown;
	protected string $image;
	protected int $ultimateChargeRequired;
	protected int $updated;

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
	 * @return int
	 */
	public function getCooldown():int
	{
		return $this->cooldown;
	}

	/**
	 * @param int $cooldown
	 */
	public function setCooldown(int $cooldown):void
	{
		$this->cooldown = $cooldown;
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
	public function getUltimateChargeRequired():int
	{
		return $this->ultimateChargeRequired;
	}

	/**
	 * @param int $ultimateChargeRequired
	 */
	public function setUltimateChargeRequired(int $ultimateChargeRequired):void
	{
		$this->ultimateChargeRequired = $ultimateChargeRequired;
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