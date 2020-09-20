<?php namespace App\Models;

use Cassandra\Date;
use CodeIgniter\Model;

class GuildModel extends Model
{
	protected $table = 'guild';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'memberCount',
		'name',
		'gp',
		'updated'
	];

}