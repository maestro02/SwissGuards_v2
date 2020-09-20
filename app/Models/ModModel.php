<?php namespace App\Models;

use CodeIgniter\Model;

class ModModel extends Model
{
	protected $table = 'mods';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'level',
		'tier',
		'setType',
		'pips',
		'primaryStatType',
		'primaryStatValue',
		'slot'
	];
}