<?php
session_start();
// define the constants
define("CONTROLLER_NAMESPACE", "\App\Controllers\\");
define("MODELS_NAMESPACE", "\App\Models\\");
define("UPLOADS", __DIR__ . "/../public/uploads");
// laod Autoloader
require_once __DIR__ . "/../vendor/autoload.php";
// load the .env file
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
