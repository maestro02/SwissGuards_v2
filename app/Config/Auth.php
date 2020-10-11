<?php namespace Config;

use Myth\Auth\Authentication\Passwords\CompositionValidator;
use Myth\Auth\Authentication\Passwords\NothingPersonalValidator;
use Myth\Auth\Authentication\Passwords\DictionaryValidator;
use Myth\Auth\Authentication\Passwords\PwnedValidator;

class Auth extends \Myth\Auth\Config\Auth
{
	public $defaultUserGroup = 'guest';
	public $views = [
		'login' => 'Myth\Auth\Views\login',
		'register' => 'Views/Auth/register',
		'forgot' => 'Myth\Auth\Views\forgot',
		'reset' => 'Myth\Auth\Views\reset',
		'emailForgot' => 'Myth\Auth\Views\emails\forgot',
		'emailActivation' => 'Myth\Auth\Views\emails\activation',
	];
	public $viewLayout = 'Myth\Auth\Views\layout';
	public $validFields = [
		'email',
		'username',
	];
	public $allowRemembering = true;
	public $rememberLength = 30 * YEAR;
// - PASSWORD_DEFAULT (default)
// - PASSWORD_BCRYPT
	public $hashAlgorithm = PASSWORD_BCRYPT;
	public $hashCost = 20;
	public $minimumPasswordLength = 8;
	public $passwordValidators = [
		CompositionValidator::class,
		NothingPersonalValidator::class,
		DictionaryValidator::class,
		PwnedValidator::class,
	];

}