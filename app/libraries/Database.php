<?php
  /*
   * PDO Database Class
   * Connect to database
   * Create prepared statements
   * Bind values
   * Return rows and results
   */

declare(strict_types = 1);
namespace App\Libraries;
use PDO;
  class Database {
    private array $config;

    private $dbh;
    private $error;

    public function __construct(array $config = []){
      // Set DSN
      $this->config = $config;
      $dsn = "mysql:host={$this->config["host"]};dbname={$this->config["db"]};port={$this->config["port"]}";
      $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );

      // Create PDO instance
      try{
        $this->dbh = new PDO($dsn, $this->config["user"], $this->config["password"], $options);
      } catch(\PDOException $e){
        $this->error = $e->getMessage();
        echo $this->error;
      }
    }
    
    public function getPDO(): PDO {
      return $this->dbh;
    }
  
  }