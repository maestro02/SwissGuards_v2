<?php namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
	protected $table = 'recipe';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'id',
		'descKeyEn',
		'descKeyDe',
		'image',
		'type',
		'updated'
	];
}