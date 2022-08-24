<?php
declare( strict_types = 1);

namespace App\Helpers;

class Logger {
    const FILENAME = APPROOT. "/Mylog.txt";

    public static function  add(string $error) {
        if(!file_exists(self::FILENAME)) file_put_contents(self::FILENAME, ' sfd');
        file_put_contents(self::FILENAME,$error."\n", FILE_APPEND);
    }
}