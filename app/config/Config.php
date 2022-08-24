<?php
  // DB Params
  declare(strict_types = 1);
  namespace App\Config;
  // App Root
  define('APPROOT', dirname(dirname(__FILE__))); // C:\xampp\htdocs\muroog\app"
  // include folder path
  define('INC_BACKEND', APPROOT . '/views/backend/inc');
  define('INC_FRONTEND', APPROOT . '/views/frontend/inc');
  // URL Root
  define('URLROOT', 'http://localhost/');
  // Log file path
  // css path
  define("CSS_BACKEND",  URLROOT . 'assets/backend/css');
  define("CSS_FRONTEND",  URLROOT . 'assets/frontend/css');
  // img path
  define("IMG_BACKEND", URLROOT . 'assets/backend/img');
  define("IMG_FRONTEND", URLROOT . 'assets/frontend/img');
  // js path
  define("JS_BACKEND", URLROOT . 'assets/backend/js');
  define("JS_FRONTEND", URLROOT . 'assets/frontend/js');

  // fronted vendor 
  define("VENDOR", URLROOT . "assets/frontend/vendor");

  // uploads path 
  define("UP2", URLROOT . "uploads");
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