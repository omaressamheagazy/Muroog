<?php
declare (strict_types = 1);
namespace App\Models;

use App\Libraries\Model;
use Exception;

class LocationModel extends Model
{
    public function index($id = null): array
    {


        try {
            $condition = null;
            if(!empty($id))
                $condition = "WHERE id = {$id}";
            $this->query("SELECT * FROM location $condition");
            var_dump("wow");
            $this->execute();
            return $this->resultSet() ? $this->resultSet() : [];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function add(array $location = null): bool
    {
        if (empty($location)) exit();
        try {
            $this->query("INSERT INTO location(title) VALUES(:title)");
            $this->bind(":title", $location["title"]);
            return $this->execute() ? true : false;
        } catch (\PDOException $e) {
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
    public function update(array $location = null): bool {
        if(empty($location) ) exit();
        try {
            // "UPDATE MyGuests SET lastname='Doe' WHERE id=2"
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

    public function getLocationById(int $id): array {

        $this->query("SELECT * from location where id=:id LIMIT 1");
        $this->bind(":id", $id);
        return $this->single() ?? $this->single() ?? [];
    }
}
