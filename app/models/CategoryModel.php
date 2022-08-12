<?php
declare (strict_types = 1);
namespace App\Models;

use App\Libraries\Model;
use Exception;

class CategoryModel extends Model
{
    public function index($id = null): array
    {


        try {
            $condition = null;
            if(!empty($id))
                $condition = "WHERE id = {$id}";
            $this->query("SELECT * FROM category $condition");
            var_dump("wow");
            $this->execute();
            return $this->resultSet() ? $this->resultSet() : [];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function add(array $category = null): bool
    {
        if (empty($category)) exit();
        try {
            if($this->isCategoryTitleExist($category["title"])) return false; 
            $this->query("INSERT INTO category(title) VALUES(:title)");
            $this->bind(":title", $category["title"]);
            return $this->execute() ? true : false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function update(array $category = null): bool {
        if(empty($category) ) exit();
        try {
            if($this->isCategoryTitleExist($category["title"])) return false; 
            $this->query("UPDATE category set title = :title where id= :id  ");
            $this->bind("title", $category["title"]);
            $this->bind("id", $category["id"]);
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
            $this->query("DELETE FROM category where id={$id} ");
            return $this->execute() ? true : false;
        } catch(\PDOException $e) {
            echo $e->getMessage();
            
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        
    }

    public function getCategoryById(int $id): array {

        $this->query("SELECT * from category where id=:id LIMIT 1");
        $this->bind(":id", $id);
        return $this->single() ?? $this->single() ?? [];
    }

    public function isCategoryTitleExist(string $title): bool {
        $this->query("SELECT * from category where title=:title LIMIT 1");
        $this->bind(":title", $title);
        $this->execute();
        return  $this->rowCount() > 0 ? true : false;
    }
}