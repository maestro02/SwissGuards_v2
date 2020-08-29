<?php namespace App\Models;

use CodeIgniter\Model;

class SkillModel extends Model
{
	protected $table = 'skill';
	protected $primaryKey = 'id';

	protected string $id;
	protected string $nameKeyEn;
	protected string $nameKeyDe;
	protected string $image;
	protected string $abilityId;
	protected string $skillType;
	protected bool $zeta;
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
	 * @return string
	 */
	public function getAbilityId():string
	{
		return $this->abilityId;
	}

	/**
	 * @param string $abilityId
	 */
	public function setAbilityId(string $abilityId):void
	{
		$this->abilityId = $abilityId;
	}

	/**
	 * @return string
	 */
	public function getSkillType():string
	{
		return $this->skillType;
	}

	/**
	 * @param string $skillType
	 */
	public function setSkillType(string $skillType):void
	{
		$this->skillType = $skillType;
	}

	/**
	 * @return bool
	 */
	public function isZeta():bool
	{
		return $this->zeta;
	}

	/**
	 * @param bool $zeta
	 */
	public function setZeta(bool $zeta):void
	{
		$this->zeta = $zeta;
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