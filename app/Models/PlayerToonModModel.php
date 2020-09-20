<?php namespace App\Models;

use CodeIgniter\Model;

class PlayerToonModModel extends Model
{
	protected $table = 'playerToonMod';
	protected $primaryKey = 'toonId, modId';

	protected $allowedFields = [
		'toonId',
		'modId'
	];

}