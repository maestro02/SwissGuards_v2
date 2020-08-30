<?php namespace App\Models;

use CodeIgniter\Model;

class PlayerModel extends Model
{
	protected $table = 'player';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'id',
		'name',
		'allyCode',
		'level',
		'guildId',
		'lastActivity',
		'gpTotal',
		'gpToon',
		'gpShip',
		'lifetimeChampionshipScore',
		'fleetArenaBattlesWon',
		'squadArenaBattlesWon',
		'totalBattlesWon',
		'hardBattlesWon',
		'galacticWarBattlesWon',
		'guildRaidsWon',
		'guildTokensEarned',
		'gearDonatedinGuildExchange',
		'championshipPromotionsEarned',
		'championshipOffensiveBattlesWon',
		'championshipSuccessfulBattleDefends',
		'championshipBannersEarned',
		'championshipFullRoundsCleared',
		'championshipUndersizedSquadBattlesWon',
		'championshipTerritoriesDefeated',
		'updated'
	];

}