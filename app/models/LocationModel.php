<?php
declare (strict_types = 1);
namespace App\Models;

use App\Libraries\Model;
use Exception;

class LocationModel extends Model
{
    public  function getAllLocation(): array {
        try {
            $this->query("SELECT * FROM location");
            return $this->resultSet() ??  $this->resultSet() ?? [];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        } catch(Exception $e) {
            echo $e->getMessage();
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
            echo $e->getMessage();
        } catch(Exception $e) {
            echo $e->getMessage();
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
            echo $e->getMessage();
            
        }
        catch(Exception $e) {
            echo $e->getMessage();
            
        }
    }
    
    public  function delete(int $id = null): bool {
        if(empty($id)) exit();
        try {
            $this->query("DELETE FROM location where id={$id} ");
            return $this->execute() ? true : false;
        } catch(\PDOException $e) {
            echo $e->getMessage();
            
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        
    }

    public  function getLocationById(int $id): array {
        try {
            $this->query("SELECT * from location where id=:id LIMIT 1");
            $this->bind(":id", $id);
            return $this->single() ?? $this->single() ?? [];
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function isLocationTitleExist(string $title): bool {
        try {
            $this->query("SELECT COUNT(title) as total from location where title=:title LIMIT 1");
            $this->bind(":title", $title);
            return  $this->single()["total"] > 0 ? true : false;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public  function numberOfLocation() {
        try {
            $this->query("SELECT COUNT(title) as total from location");
            return $this->single()["total"];
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
