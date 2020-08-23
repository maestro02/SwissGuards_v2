<?php namespace App\Helpers;


use http\Exception;
use stdClass;

class SwgohHelp
{
	private $user;
	private $signin = "https://api.swgoh.help/auth/signin";
	private $data = "https://api.swgoh.help/swgoh/data/";
	private $player = "https://api.swgoh.help/swgoh/player/";
	private $guild = "https://api.swgoh.help/swgoh/guild/";
	private $units = "https://api.swgoh.help/swgoh/units/";
	private $roster = "https://api.swgoh.help/swgoh/roster/";
	private $zetas = "https://api.swgoh.help/swgoh/zetas/";
	private $squads = "https://api.swgoh.help/swgoh/squads/";
	private $events = "https://api.swgoh.help/swgoh/events/";
	private $battles = "https://api.swgoh.help/swgoh/battles/";
	private $token = "";

	public function __construct()
	{
	}

	public function login():void
	{
		$opts = array(
			'http' => array(
				'method'    =>  "POST",
				'header'    =>  "Content-Type: application/x-www-form-urlencoded",
				'content'   =>  "username=".$_ENV['helpers.swgohhelp.username']."&password=".$_ENV['helpers.swgohhelp.password']."&grant_type=password&client_id=abc&client_secret=123"
			)
		);

		$context = stream_context_create($opts);
		$auth = file_get_contents($this->signin, false, $context);
		$obj = json_decode($auth);
		$this->token = $obj->access_token;
	}

	private function jwt_request($token, $post, $fetchUrl)
	{

		$ch = curl_init($fetchUrl); // INITIALISE CURL

		header('Content-Type: application/json');
		$authorization = "Authorization: Bearer ".$this->token; // **Prepare Authorization Token**
		curl_setopt($ch, CURLOPT_HTTPHEADER,
			['Content-Type: application/json', $authorization]); // **Inject Token into Header**
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	public function fetchAPI($fetchUrl, $payload)
	{
		try {
			if (!$this->token) {
				$this->login();
			}

			$authorization = "Authorization: Bearer ".$this->token;
			$request = $this->jwt_request($this->token, $payload, $fetchUrl);

			$temp = json_decode($request);
			if (isset($temp->code) && $temp->code > 200) {
				$this->login();
				$authorization = "Authorization: Bearer ".$this->token;
				$request = $this->jwt_request($this->token, $payload, $fetchUrl);
			}

			return $request;

		} catch (Exception $e) {
			throw $e;
		}
	}

	//See https://api.swgoh.help/ for possible data dumps and available languages
	//$criteria - a string that specifies which data collection
	//$lang - a string that specifies the language
	//$match - an object that specifies the value of the key desired
	//$project - an object. See https://apiv2.swgoh.help/swgoh for details
	/* example that returns all units

      $swgoh = new SwgohHelp(array($user, $password));

	   $match = new stdClass();
       $match->rarity = 7;

       $project = new stdClass();
       $project->baseId = 1;
       $project->nameKey = 1;
       $project->combatType = 1;

       $units = $swgoh->fetchData("unitsList", "spa_xm", $match, $project);
	*/
	public function fetchData(
		$criteria,
		$lang = "eng_us",
		$match = null,
		$project = null
	) //If no language specified default to English
	{
		try {
			$myObj = new stdClass();
			$myObj->collection = $criteria;
			$myObj->language = $lang;
			$myObj->match = $match;
			$myObj->project = $project;
			$myObj->enums = true;
			return $this->fetchAPI($this->data, json_encode($myObj, JSON_NUMERIC_CHECK));
		} catch (Exception $e) {
			throw $e;
		}
	}

	//This function can take several allycodes separated by commas.
	public function fetchPlayer(
		$allycode,
		$lang = "eng_us",
		$project = null
	) //If no language specified default to English
	{
		try {
			$myObj = new stdClass();
			$myObj->allycode = array_map('intval', explode(',', $allycode));
			$myObj->language = $lang;
			$myObj->enums = false;
			$myObj->structure = false;
			$myObj->project = $project;
			return $this->fetchAPI($this->player, json_encode($myObj, JSON_NUMERIC_CHECK));
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function fetchGuild(
		$allycode,
		$lang = "eng_us",
		$project = null
	) //If no language specified default to English
	{
		try {
			$myObj = new stdClass();
			$myObj->allycode = array_map('intval', explode(',', $allycode)); //(int)$allycode;
			$myObj->language = $lang;
			$myObj->enums = false;
			$myObj->structure = false;
			$myObj->project = $project;
			return $this->fetchAPI($this->guild, json_encode($myObj, JSON_NUMERIC_CHECK));
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function fetchRoster($allycode, $project = null) //If no language specified default to English
	{
		try {
			$myObj = new stdClass();
			$myObj->allycode = array_map('intval', explode(',', $allycode));;
			$myObj->enums = false;
			$myObj->structure = false;
			$myObj->project = $project;
			return $this->fetchAPI($this->roster, json_encode($myObj, JSON_NUMERIC_CHECK));
		} catch (Exception $e) {
			throw $e;
		}
	}

	//This function can take several allycodes separated by commas.
	public function fetchUnits($allycode, $project = null) //If no language specified default to English
	{
		try {
			$myObj = new stdClass();
			$myObj->allycodes = array_map('intval', explode(',', $allycode));
			$myObj->enums = false;
			$myObj->structure = false;
			$myObj->project = $project;
			return $this->fetchAPI($this->units, json_encode($myObj, JSON_NUMERIC_CHECK));
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function fetchZetas($project = null)
	{
		try {
			$myObj = new stdClass();

			$myObj->structure = false;
			$myObj->project = $project;
			return $this->fetchAPI($this->zetas, json_encode($myObj, JSON_NUMERIC_CHECK));
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function fetchSquads($project = null)
	{
		try {
			$myObj = new stdClass();

			$myObj->structure = false;
			$myObj->project = $project;
			return $this->fetchAPI($this->squads, json_encode($myObj, JSON_NUMERIC_CHECK));
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function fetchEvents($lang = "eng_us", $project = null) //If no language specified default to English
	{
		try {
			$myObj = new stdClass();
			$myObj->language = $lang;
			$myObj->enums = false;
			$myObj->structure = false;
			$myObj->project = $project;
			return $this->fetchAPI($this->events, json_encode($myObj, JSON_NUMERIC_CHECK));
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function fetchBattles($lang = "eng_us", $project = null) //If no language specified default to English
	{
		try {
			$myObj = new stdClass();
			$myObj->language = $lang;
			$myObj->enums = false;
			$myObj->structure = false;
			$myObj->project = $project;
			return $this->fetchAPI($this->battles, json_encode($myObj, JSON_NUMERIC_CHECK));
		} catch (Exception $e) {
			throw $e;
		}
	}
}