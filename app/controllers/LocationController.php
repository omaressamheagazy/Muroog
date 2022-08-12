<?php
declare (strict_types = 1);
namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Enums\Messages;
use App\Helpers\Enums\MessagesName;
use App\Helpers\MessageReporting;
use App\Libraries\Controller;
// require_once "../app/helpers/Auth.php";
class LocationController extends Controller
{

    public function index()
    {
        if (!Auth::logged_in())  self::redirectTo("/admin/login");
        $data = [
            "title" => "Location",
            "location" => []
        ];
        $model = $this->model(MODELS_NAMESPACE . "LocationModel");
        $data["location"] = call_user_func_array([$model, "index"], []);
        $this->view('/pages/location/allLocationView', $data);

    }

    public function add()
    {
        if (!Auth::logged_in())  self::redirectTo("/admin/login");
        $data = [
            "title" => "Add Location",
            "location" => []
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["location"] = $_POST;
            $model = $this->model(MODELS_NAMESPACE . "LocationModel");
            call_user_func_array([$model, "add"],[$data["location"]]);
            Self::redirectTo("/admin/location");
            
        }
        $this->view('/pages/location/addLocationView', $data);
    
    }

    public function delete() {
        if (!Auth::logged_in())  self::redirectTo("/admin/login");
        $data = [
            "title" => "Add Location",
            "id" => "",
            "action" => ""
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = $this->model(MODELS_NAMESPACE . "LocationModel");
            if(call_user_func_array([$model, "delete"],[$_POST["id"]])) {
                MessageReporting::flash(MessagesName::LOCATION,"location deleted succfully");
                Self::redirectTo("/admin/location"); 
            }

        }
    }

    public function update(array $param = null) {
        if (!Auth::logged_in())  self::redirectTo("/admin/login");
        
        $model = $this->model(MODELS_NAMESPACE . "LocationModel");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $data = [
                "pageTitle" => "update location",
                "title" => trim($_POST["title"]),
                "id" =>  $_POST["id"]
            ];
            if(call_user_func_array([$model, "update"], [$data])) { // return true if location succfully updated
                MessageReporting::flash(MessagesName::LOCATION, "location updated succfully");
                Self::redirectTo("/admin/location");
            }
        } else {
            $location = call_user_func_array([$model, "getLocationById"], [$param["id"]]);
            $data = [
            "pageTitle" => "update location",
            "title" => trim($location["title"]),
            "id" =>  $location["id"]
            ];
            $this->view('/pages/location/editLocationView', $data);
        }

    }
}
