<?php

class Auth
{
	public static function handleLogin()
	{
		$logged = Session::get('member');
		if ($logged == false) {
			Session::destroy();
			header('location: ' . URL . 'login');
			exit;
		}
	}
}
