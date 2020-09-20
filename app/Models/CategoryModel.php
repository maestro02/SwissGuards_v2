<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
	protected $table = 'category';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'id',
		'descKeyEn',
		'descKeyDe',
		'toonFilter',
		'shipFilter',
		'updated'
	];

}