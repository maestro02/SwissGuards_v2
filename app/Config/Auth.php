<?php namespace Config;

use Myth\Auth\Authentication\Passwords\CompositionValidator;
use Myth\Auth\Authentication\Passwords\NothingPersonalValidator;
use Myth\Auth\Authentication\Passwords\DictionaryValidator;
use Myth\Auth\Authentication\Passwords\PwnedValidator;

class Auth extends \Myth\Auth\Config\Auth
{
	public $defaultUserGroup = 0;
	public $views = [
		'emailForgot' => 'Myth\Auth\Views\emails\forgot',
		'emailActivation' => 'Myth\Auth\Views\emails\activation',
		'login' => 'Myth\Auth\Views\login',
		'register' => 'Myth\Auth\Views\register',
		'forgot' => 'Myth\Auth\Views\forgot',
		'reset' => 'Myth\Auth\Views\reset'
	];
	public $viewLayout = 'Views/Templates/Default_View';
	public $validFields = [
		'email',
		'username'
	];
	public $allowRemembering = true;
	public $rememberLength = 30 * YEAR;
// - PASSWORD_DEFAULT (default)
// - PASSWORD_BCRYPT
	public $hashAlgorithm = PASSWORD_BCRYPT;
	public $hashCost = 10; // Default = 10
	public $minimumPasswordLength = 8;
	public $passwordValidators = [
		CompositionValidator::class,
		NothingPersonalValidator::class,
		DictionaryValidator::class,
		PwnedValidator::class,
	];

}