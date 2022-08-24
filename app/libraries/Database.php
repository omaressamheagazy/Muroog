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

use App\Helpers\MessageReporting;
use App\Helpers\Redirection;
use Exception;
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
        if(empty($this->dbh)) throw new Exception("errro happend");
      } catch(\PDOException $e){
        MessageReporting::dialogMessage("An error happend, while connecting to the server, please try again later");
        header("Location:index.php");
        exit();
      } catch(\Exception $e) {
        MessageReporting::dialogMessage("An error happend, while connecting to the server, please try again later");
        exit();
      }
    }
    
    public function getPDO(): PDO {
      return $this->dbh;
    }
  
  }