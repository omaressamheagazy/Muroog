<?php
declare(strict_types = 1);
namespace App\Helpers;

class Redirection {
    public static function redirectTo (string $path) {
        header("Location:{$path}");
        exit();
    }
}