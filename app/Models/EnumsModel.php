<?php namespace App\Models;

use CodeIgniter\Model;

class EnumsModel extends Model
{
	protected $table = 'enums';
	protected $primaryKey = 'enum_key';

	protected $allowedFields = [
		'enum_key',
		'key_value',
		'nameKeyEn',
		'nameKeyDe'
	];

}