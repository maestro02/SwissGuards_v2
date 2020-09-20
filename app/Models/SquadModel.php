<?php namespace App\Models;

use CodeIgniter\Model;

class SquadModel extends Model
{
	protected $table = 'squad';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'arenaId',
		'toonId',
		'squadType'
	];
}