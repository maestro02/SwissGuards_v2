<?php namespace App\Models;

use CodeIgniter\Model;

class TitleModel extends Model
{
	protected $table = 'title';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'nameKeyEn',
		'nameKeyDe',
		'descKeyEn',
		'descKeyDe',
		'shortDescKeyEn',
		'shortDescKeyDe',
		'updated'
	];
}