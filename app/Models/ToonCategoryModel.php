<?php namespace App\Models;

use CodeIgniter\Model;

class ToonCategoryModel extends Model
{
	protected $table = 'toonCategory';
	protected $primaryKey = 'baseId, categoryId';

	protected $allowedFields = [
		'baseId',
		'categoryId'
	];
}