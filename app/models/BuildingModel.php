<?php
declare(strict_types = 1);
namespace App\Models;

use App\Libraries\Model;
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
                                building.latest_project
                                FROM building
                                INNER JOIN location
                                    ON building.location_id=location.id
                                INNER JOIN category
                                    ON building.category_id=category.id
            ");
            return $this->resultSet() ??  $this->resultSet() ?? [];
        } catch (\PDOException $e) {
            echo $e->getMessage();
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
            echo $e->getMessage();
        }
    }   


}