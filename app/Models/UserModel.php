<?php namespace App\Models;

use Myth\Auth\Models\UserModel as MythModel;

class UserModel extends MythModel
{
	// protected $table = 'player';
	// protected $primaryKey = 'id';
	protected $allowedFields = [
		'email',
		'username',
		'allyCode',
		'discord_id',
		'password_hash',
		'reset_hash',
		'reset_at',
		'reset_expires',
		'activate_hash',
		'status',
		'status_message',
		'active',
		'force_pass_reset',
		'permissions',
		'deleted_at',
		'swgoh_link',
		'updated'
	];

}