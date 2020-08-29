<?php namespace App\Models;

use Cassandra\Date;
use CodeIgniter\Model;

class GuildModel extends Model
{
	protected $table = 'guild';
	protected $primaryKey = 'id';

	protected string $id;
	protected int $memberCount;
	protected string $name;
	protected int $gp;
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
	 * @return int
	 */
	public function getMemberCount():int
	{
		return $this->memberCount;
	}

	/**
	 * @param int $memberCount
	 */
	public function setMemberCount(int $memberCount):void
	{
		$this->memberCount = $memberCount;
	}

	/**
	 * @return string
	 */
	public function getName():string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name):void
	{
		$this->name = $name;
	}

	/**
	 * @return int
	 */
	public function getGp():int
	{
		return $this->gp;
	}

	/**
	 * @param int $gp
	 */
	public function setGp(int $gp):void
	{
		$this->gp = $gp;
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