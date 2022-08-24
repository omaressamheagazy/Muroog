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

class CategoryModel extends Model
{
    public function getAllCategory() : array {
        try {
            $this->query("SELECT * FROM category");
            return $this->resultSet() ??  $this->resultSet() ?? [];
        } catch (\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend viewing all categories, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin");
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
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while adding a new category, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/category/add");
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
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while updating a  category, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/category");
        } 
    }
    
    public  function delete(int $id): bool {
        try {
            $this->query("DELETE FROM category where id={$id} ");
            return $this->execute() ? true : false;
        } catch(\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while deleting a category, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/category");
        } 
        
    }

    public function getCategoryById(int $id): array {

        try {
            $this->query("SELECT * from category where id=:id LIMIT 1");
            $this->bind(":id", $id);
            return $this->single() ?? $this->single() ?? [];
        } catch (\PDOException $e) {
            throw new \PDOException();
        } 
    }



    public function isCategoryTitleExist(string $title): bool {
        try {
            $this->query("SELECT COUNT(title) as total from category where title=:title LIMIT 1");
            $this->bind(":title", $title);
            return  $this->single()["total"] > 0 ? true : false;
        } catch (\Exception $e) {
            throw new \PDOException();
        }
    }

    public  function numberOfCategory() {
        try {
            $this->query("SELECT COUNT(title) as total from category");
            return $this->single()["total"];
        } catch (\Exception $e) {
            throw new \PDOException();
        }
    }

    

}
