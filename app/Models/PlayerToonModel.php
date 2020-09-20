<?php namespace App\Models;

use CodeIgniter\Model;

class PlayerToonModel extends Model
{
	protected $table = 'playerToon';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'baseId',
		'playerId',
		'rarity',
		'level',
		'xp',
		'gear',
		'gp',
		'relictTier'
	];
}