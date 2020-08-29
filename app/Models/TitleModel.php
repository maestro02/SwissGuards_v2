<?php namespace App\Models;

use CodeIgniter\Model;

class TitleModel extends Model
{
	protected $table = 'title';
	protected $primaryKey = 'id';

	protected string $id;
	protected string $nameKeyEn;
	protected string $nameKeyDe;
	protected string $descKeyEn;
	protected string $descKeyDe;
	protected string $shortDescKeyEn;
	protected string $shortDescKeyDe;
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
	public function getShortDescKeyEn():string
	{
		return $this->shortDescKeyEn;
	}

	/**
	 * @param string $shortDescKeyEn
	 */
	public function setShortDescKeyEn(string $shortDescKeyEn):void
	{
		$this->shortDescKeyEn = $shortDescKeyEn;
	}

	/**
	 * @return string
	 */
	public function getShortDescKeyDe():string
	{
		return $this->shortDescKeyDe;
	}

	/**
	 * @param string $shortDescKeyDe
	 */
	public function setShortDescKeyDe(string $shortDescKeyDe):void
	{
		$this->shortDescKeyDe = $shortDescKeyDe;
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