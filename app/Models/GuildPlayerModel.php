<?php namespace App\Models;

use CodeIgniter\Model;

class GuildPlayerModel extends Model
{
	protected $table = 'guildPlayer';
	protected $primaryKey = 'playerId';

	protected $allowedFields = [
		'guildId',
		'playerId',
		'guildMemberStatus'
	];

}