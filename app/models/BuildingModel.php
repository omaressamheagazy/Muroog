<?php
declare(strict_types = 1);
namespace App\Models;

use App\Libraries\Model;
use PDOException;

class BuildingModel extends Model {

    public function index() {

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