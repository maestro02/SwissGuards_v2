<?php namespace App\Models;

use CodeIgniter\Model;

class PlayerTitleModel extends Model
{
	protected $table = 'playerTitle';
	protected $primaryKey = 'playerId, titleId';



}