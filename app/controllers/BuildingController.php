<?php 
declare(strict_types = 1);
namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Enums\MessagesName;
use App\Libraries\Controller;
use App\Helpers\File;
use App\Helpers\MessageReporting;

class BuildingController extends Controller {

    public function index() {
        if(!Auth::logged_in()) Self::redirectTo("/admin/login");
        $data = [
            "title" => "Buildings",
            "building" => [],
        ];
        $model = $this->model(MODELS_NAMESPACE . "BuildingModel");
        $data["building"] = call_user_func_array([$model, "getAllBuilding"], []);
        $this->view("/pages/building/allBuildingView",$data);
    }

    public function add() {
        if(!Auth::logged_in()) Self::redirectTo("/admin/login");
        $data = ["Pagetitle" => "Add Building"];
        if($_SERVER["REQUEST_METHOD"] == "GET") { 
            $categoryModel = $this->model(MODELS_NAMESPACE . "CategoryModel");
            $locationModel = $this->model(MODELS_NAMESPACE . "LocationModel");
            $data["location"] = call_user_func([$locationModel, "getAllLocation"]);
            $data["category"] = call_user_func([$categoryModel, "getAllCategory"]);
            $this->view("/pages/building/addBuildingView", $data);
        } else {
            $data = array_map(fn($element) => trim($element), $_POST ); // assign post to data, and make sure that every value is trimmeds
            $data["error"] = [];
            $data["auxiliary_images"] = "";
            $data["main_image"] = "";

            if(!empty($_FILES["main_image"]["name"])) { // main image validation
                $errorMsg = File::validateFiles($_FILES["main_image"], "validateImage");
                if(empty($errorMsg) ) $data["main_image"] = File::handleValidatedFiles($_FILES["main_image"], UPLOADS);
                else $data["error"]["main_image"] =  $errorMsg;
            }
        
            if (!empty($_FILES["file"]["name"][0]))  { // auxiliary_images validation
                $errorMsg = File::validateFiles($_FILES["file"], "validateImage");
                if(empty($errorMsg) ) $data["auxiliary_images"] = File::handleValidatedFiles($_FILES["file"], UPLOADS);
                else $data["error"]["auxiliary_images"] =  $errorMsg;
            }
            
            if (empty($data["error"])) {
                $model = $this->model(MODELS_NAMESPACE . "BuildingModel");
                if(call_user_func_array([$model, "add"], [$data])) {
                    MessageReporting::flash(MessagesName::Building, "building added succfully");
                }
                Self::redirectTo("/admin/building");
            }
        }
    }

    public function update(array $param = null) {
        if(!Auth::logged_in()) Self::redirectTo("/admin/login");
        $model = $this->model(MODELS_NAMESPACE . "BuildingModel");

        $data = [
            "Pagetitle" => "update building",
            "building" => [],
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
            $data = array_map(fn($element) => trim($element), $_POST ); // assign post to data, and make sure that every value is trimmeds
            $data["error"] = [];
            if(!empty($_FILES["main_image"]["name"])) { // main image validation
                $errorMsg = File::validateFiles($_FILES["main_image"], "validateImage");
                if(empty($errorMsg) ) {
                    unlink(UPLOADS . '/' . $data["main_image"]);
                    $data["main_image"] = File::handleValidatedFiles($_FILES["main_image"], UPLOADS);
                } 
                else $data["error"]["main_image"] =  $errorMsg;
            }
        
            if (!empty($_FILES["file"]["name"][0]))  { // auxiliary_images validation
                $errorMsg = File::validateFiles($_FILES["file"], "validateImage");
                if(empty($errorMsg) ) {
                    $images = explode(" ", $data["auxiliary_images"]);
                    foreach($images as $image) {
                        unlink(UPLOADS . '/' . $image);
                    }
                    $data["auxiliary_images"] = File::handleValidatedFiles($_FILES["file"], UPLOADS);
                } 
                else $data["error"]["auxiliary_images"] =  $errorMsg;
            }
            
            if (empty($data["error"])) {
                $model = $this->model(MODELS_NAMESPACE . "BuildingModel");
                if(call_user_func_array([$model, "update"], [$data])) {
                    MessageReporting::flash(MessagesName::Building, "building updated succfully");
                }
                Self::redirectTo("/admin/building");
            }
        } else {
            $building = call_user_func_array([$model, "getBuildingById"], [$param["id"]]);
            $categoryModel = $this->model(MODELS_NAMESPACE . "CategoryModel");
            $locationModel = $this->model(MODELS_NAMESPACE . "LocationModel");
            
            $data["location"] = call_user_func([$locationModel, "getAllLocation"]);
            $data["category"] = call_user_func([$categoryModel, "getAllCategory"]);
            $data["building"] = array_map(fn($element) => $element, $building);
            $this->view("/pages/building/editBuildingView", $data);
        }
    }

    public function delete() {
    {
        if (!Auth::logged_in()) self::redirectTo("/admin/login");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = $this->model(MODELS_NAMESPACE . "BuildingModel");
            if (call_user_func_array([$model, "delete"], [$_POST["id"]])) {
                MessageReporting::flash(MessagesName::Building, "building deleted succfully");
                Self::redirectTo("/admin/building");
            }
        }
    }
    }
}
