<?php namespace App\Models;

use CodeIgniter\Model;

class PlayerPortraitModel extends Model
{
	protected $table = 'playerPortrait';
	protected $primaryKey = 'playerId, portraitId';

	protected $allowedFields = [
		'playerId',
		'portraitId',
		'selected'
	];
}