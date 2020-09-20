<?php namespace App\Models;

use CodeIgniter\Model;

class SecondaryStatModModel extends Model
{
	protected $table = 'secondaryStatMod';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'modId',
		'statType',
		'statValue',
		'roll'
	];
}