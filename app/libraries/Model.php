<?php
declare (strict_types = 1);
namespace App\Libraries;

abstract class Model
{
    protected \PDO $dbh;
    protected  $stmt;

    public function __construct()
    {
        $this->dbh = \App\App::db();
    }
    // Prepare statement with query
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }
    
    // Bind values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Get single record as object
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Get row count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
