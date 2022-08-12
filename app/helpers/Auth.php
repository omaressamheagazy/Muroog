<?php
declare(strict_types = 1);
namespace App\Helpers;
class Auth
{
	
	public static function authenticate($row)
	{
		// code...
		// var_dump("should be autheticated");
		$_SESSION['USER'] = $row;
		echo "<br>";
		// var_dump($_SESSION);
		echo "<br>";
	}

	public static function logout()
	{
		// code...
		if(isset($_SESSION['USER']))
		{
			unset($_SESSION['USER']);
		}
	}

	public static function logged_in(): bool
	{
		// code...
        return isset($_SESSION['USER'])? true : false;
	}
}