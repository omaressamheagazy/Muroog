<?php
declare(strict_types = 1);
namespace App\Helpers;
class Auth
{
	
	public static function authenticate( array $row)
	{
		$_SESSION['USER'] = $row["id"];
		$_SESSION['ROLE'] = $row["role"];
	}

	public static function logout()
	{
		// code...
		if(isset($_SESSION['USER']))
		{
			unset($_SESSION['USER']);
			unset($_SESSION['ROLE']);
		}
	}

	public static function logged_in(): bool
	{
		// code...
        return isset($_SESSION['USER'])? true : false;
	}

	public static function isSuperAdmin(): bool {
		return $_SESSION["ROLE"] == 2 ? true : false;
	}
}