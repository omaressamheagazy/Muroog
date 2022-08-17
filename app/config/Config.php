<?php
  // DB Params
  declare(strict_types = 1);
  namespace App\Config;
  // App Root
  define('APPROOT', dirname(dirname(__FILE__))); // C:\xampp\htdocs\muroog\app"
  // var_dump(APPROOT);
  // var_dump(__FILE__);
  // include folder path
  define('INC', APPROOT . '/views/backend/inc');
  // URL Root
  define('URLROOT', 'http://localhost/');
  // css path
  define("CSS",  URLROOT . 'assets/css');
  // img path
  define("IMG", URLROOT . 'assets/img');
  // js path
  define("JS", URLROOT . 'assets/js');


  define("UP2", URLROOT . "uploads");
  // uploads path 
  // define("UPLOADS", "C:\xampp\htdocs\muroog\public\uploads");
  // Site Name
  define('SITENAME', '_YOUR_SITENAME_'); 
  
  class Config {
    protected array $config = [];
    public function __construct(array $env)
    {
      $this->config = [
        "host" => $env["host"],
        "user" => $env["user"],
        "password" => $env["password"],
        "db" => $env["db"],
        "port" => $env["port"]
      ];
    }
    public function getConfig(): array {
      return $this->config;
    }
  }