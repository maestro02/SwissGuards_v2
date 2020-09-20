<?php namespace App\Models;

use CodeIgniter\Model;

class ArenaModel extends Model
{
	protected $table = 'arena';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'arenaType',
		'rank',
		'squadId',
		'playerId'
	];
}