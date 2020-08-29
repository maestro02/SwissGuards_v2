<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
	protected $table = 'category';
	protected $primaryKey = 'id';

	protected string $id;
	protected string $descKeyEn;
	protected string $descKeyDe;
	protected bool $toonFilter; // uiFilterList = 1
	protected bool $shipFilter; // uiFilterList = 2
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
	 * @return bool
	 */
	public function isToonFilter():bool
	{
		return $this->toonFilter;
	}

	/**
	 * @param bool $toonFilter
	 */
	public function setToonFilter(bool $toonFilter):void
	{
		$this->toonFilter = $toonFilter;
	}

	/**
	 * @return bool
	 */
	public function isShipFilter():bool
	{
		return $this->shipFilter;
	}

	/**
	 * @param bool $shipFilter
	 */
	public function setShipFilter(bool $shipFilter):void
	{
		$this->shipFilter = $shipFilter;
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