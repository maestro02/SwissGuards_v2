<?php namespace App\Models;

use CodeIgniter\Model;

class ToonCategoryModel extends Model
{
	protected $table = 'toonCategory';
	protected $primaryKey = 'baseId, categoryId';

	protected string $baseId;
	protected string $categoryId;

	/**
	 * @return string
	 */
	public function getBaseId():string
	{
		return $this->baseId;
	}

	/**
	 * @param string $baseId
	 */
	public function setBaseId(string $baseId):void
	{
		$this->baseId = $baseId;
	}

	/**
	 * @return string
	 */
	public function getCategoryId():string
	{
		return $this->categoryId;
	}

	/**
	 * @param string $categoryId
	 */
	public function setCategoryId(string $categoryId):void
	{
		$this->categoryId = $categoryId;
	}


}