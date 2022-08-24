<?php
declare (strict_types = 1);
namespace App\Models;

use App\Helpers\Enums\MessagesName;
use App\Helpers\Enums\MessageType;
use App\Helpers\Logger;
use App\Helpers\MessageReporting;
use App\Helpers\Redirection;
use App\Libraries\Model;
use Exception;

class LocationModel extends Model
{
    public  function getAllLocation(): array {
        try {
            $this->query("SELECT * FROM location");
            return $this->resultSet() ??  $this->resultSet() ?? [];
        } catch (\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while loading all locations, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin");
        } 
    }

    public function add(array $location = null): bool
    {
        if (empty($location)) exit();
        try {
            if($this->isLocationTitleExist($location["title"])) return false; 
            $this->query("INSERT INTO location(title) VALUES(:title)");
            $this->bind(":title", $location["title"]);
            return $this->execute() ? true : false;
        } catch (\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while adding a new location, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/location/add");
        } 
    }
    public function update(array $location = null): bool {
        if(empty($location) ) exit();
        try {
            if($this->isLocationTitleExist($location["title"])) return false; 
            $this->query("UPDATE location set title = :title where id= :id  ");
            $this->bind("title", $location["title"]);
            $this->bind("id", $location["id"]);
            return $this->execute() ? true : false;
        } catch(\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while updating the location, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/location");
            
        }

    }
    
    public  function delete(int $id = null): bool {
        if(empty($id)) exit();
        try {
            $this->query("DELETE FROM location where id={$id} ");
            return $this->execute() ? true : false;
        } catch(\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while deleting the location, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/location");
            
        }

    }

    public  function getLocationById(int $id): array {
        
        try {
            $this->query("SELECT * from location where id=:id LIMIT 1");
            $this->bind(":id", $id);
            return $this->single() ?? $this->single() ?? [];
        } catch (\PDOException ) {
            throw new \PDOException();
        }
    }


    public function isLocationTitleExist(string $title): bool {
        try {
            $this->query("SELECT COUNT(title) as total from location where title=:title LIMIT 1");
            $this->bind(":title", $title);
            return  $this->single()["total"] > 0 ? true : false;
        } catch (\PDOException ) {
            throw new \PDOException();
        }
    }

    public  function numberOfLocation() {
        try {
            $this->query("SELECT COUNT(title) as total from location");
            return $this->single()["total"];
        } catch (\PDOException ) {
            throw new \PDOException();
        }
    }
}
