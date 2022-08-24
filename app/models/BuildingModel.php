<?php
declare(strict_types = 1);
namespace App\Models;

use App\Helpers\Enums\MessagesName;
use App\Helpers\Enums\MessageType;
use App\Helpers\Logger;
use App\Helpers\MessageReporting;
use App\Helpers\Redirection;
use App\Libraries\Model;
use Exception;
use PDOException;

class BuildingModel extends Model {

    public function getAllBuilding() : array {
        try {
            $this->query("SELECT 
                                building.id,
                                building.title,
                                building.client,
                                building.area,
                                building.budget,
                                building.scope,
                                location.title as location,
                                category.title as category,
                                building.year,
                                building.description,
                                building.main_image,
                                building.auxiliary_images,
                                building.latest_project
                                FROM building
                                INNER JOIN location
                                    ON building.location_id=location.id
                                INNER JOIN category
                                    ON building.category_id=category.id
            ");
            return $this->resultSet() ??  $this->resultSet() ?? [];
        } catch (\PDOException) {
            throw new \PDOException();
        } 
    }
    public function add(array $building): bool {

        try {
            $this->query("INSERT INTO   building(title, client, scope, area, budget, location_id, category_id, year, description, main_image , auxiliary_images, latest_project)
                                        VALUES(:title, :client, :scope, :area, :budget, :location_id, :category_id, :year, :description, :main_image, :auxiliary_images, :latest_project)");
            $this->bind(":title", $building["title"]);
            $this->bind(":client", $building["client"]);
            $this->bind(":scope", $building["scope"]);
            $this->bind(":area", $building["area"]);
            $this->bind(":budget", $building["budget"]);
            $this->bind(":location_id", $building["location_id"]);
            $this->bind(":category_id", $building["category_id"]);
            $this->bind(":year", $building["year"]);
            $this->bind(":description", $building["description"]);
            $this->bind(":main_image", $building["main_image"]);
            $this->bind(":auxiliary_images", $building["auxiliary_images"]);
            $this->bind(":latest_project", $building["latest_project"] ?? null);
            return $this->execute() ? true : false;
        } catch(PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while adding a new building, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/building");
        } 
    }   

    public function update(array $building): bool {
        try{

            $this->query("UPDATE building 
                                SET title=:title,
                                client=:client,
                                area=:area,
                                budget=:budget,
                                scope=:scope,
                                year=:year,
                                description=:description,
                                main_image=:main_image,
                                auxiliary_images=:auxiliary_images,
                                category_id=:category_id,
                                location_id=:location_id,
                                latest_project=:latest_project
                            WHERE id=:id");     

            $this->bind(":title", $building["title"]);
            $this->bind(":client", $building["client"]);
            $this->bind(":area", $building["area"]);
            $this->bind(":budget", $building["budget"]);
            $this->bind(":scope", $building["scope"]);
            $this->bind(":year", $building["year"]);
            $this->bind(":description", $building["description"]);
            $this->bind(":main_image", $building["main_image"]);
            $this->bind(":auxiliary_images", $building["auxiliary_images"]);
            $this->bind(":category_id", $building["category_id"]);
            $this->bind(":location_id", $building["location_id"]);
            $this->bind(":latest_project", $building["latest_project"] ?? null );
            $this->bind(":id", $building["id"]);
            return $this->execute() ? true : false;
        } catch(\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while updating a building, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/building");
        } 
    } 
    public function delete(int $id) {
        try {
            $this->query("DELETE FROM building where id={$id} ");
            return $this->execute() ? true : false;
        } catch(\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend while deleting a building, please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin/building");
        } 
    }
    public function getBuildingById(int $id) {
        try {
            $this->query("SELECT 
                                building.id,
                                building.title,
                                building.client,
                                building.area,
                                building.budget,
                                building.scope,
                                location.title as location,
                                category.title as category,
                                building.year,
                                building.description,
                                building.main_image,
                                building.auxiliary_images,
                                building.category_id,
                                building.location_id,
                                building.latest_project
                                FROM building
                                INNER JOIN location
                                    ON building.location_id=location.id
                                INNER JOIN category
                                    ON building.category_id=category.id
                                WHERE building.id = :id
            ");
            $this->bind(":id", $id);
            return $this->single() ??  $this->single() ?? [];
        } catch (\PDOException $e) {
            throw new \PDOException();
        } 
    }
    public function getLatestBuilding() {
        try {
            $this->query("SELECT 
                                building.id,
                                building.title,
                                building.client,
                                building.area,
                                building.budget,
                                building.scope,
                                location.title as location,
                                category.title as category,
                                building.year,
                                building.description,
                                building.main_image,
                                building.auxiliary_images,
                                building.category_id,
                                building.location_id,
                                building.latest_project
                                FROM building
                                INNER JOIN location
                                    ON building.location_id=location.id
                                INNER JOIN category
                                    ON building.category_id=category.id
                                WHERE building.latest_project = 'on'
            ");
            return $this->resultSet() ??  $this->resultSet() ?? [];
        } catch (\PDOException $e) {
            throw new \PDOException();
        } 
    }

    public  function numberOfBuilding() {
        try {
            $this->query("SELECT COUNT(title) as total from building");
            return $this->single()["total"];
        } catch (\PDOException $e) {
            throw new \PDOException();
        } 
    }


}