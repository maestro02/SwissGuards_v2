<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
	protected $table = 'category';
	protected $primaryKey = 'id';

	protected string $id;
	protected string $descKeyEn;
	protected string $descKeyDe;
	protected array $filterList;
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
	 * @return array
	 */
	public function getFilterList():array
	{
		return $this->filterList;
	}

	/**
	 * @param array $filterList
	 */
	public function setFilterList(array $filterList):void
	{
		$this->filterList = $filterList;
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