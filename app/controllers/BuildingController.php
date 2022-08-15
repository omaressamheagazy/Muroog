<?php 
declare(strict_types = 1);
namespace App\Controllers;

use App\Helpers\Auth;
use App\Libraries\Controller;
use App\Helpers\File;

class BuildingController extends Controller {

    public function index() {
        if(!Auth::logged_in()) Self::redirectTo("/admin/login");
        $this->view("/pages/building/addBuildingView",[]);
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
                call_user_func_array([$model, "add"], [$data]);
            }
        }
    }
}
