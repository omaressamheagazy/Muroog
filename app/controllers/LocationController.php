<?php
declare (strict_types = 1);
namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Enums\MessagesName;
use App\Helpers\MessageReporting;
use App\Libraries\Controller;

// require_once "../app/helpers/Auth.php";
class LocationController extends Controller
{

    public function index()
    {
        if (!Auth::logged_in()) {
            self::redirectTo("/admin/login");
        }
        $data = [
            "title" => "Location",
            "location" => [],
        ];
        $model = $this->model(MODELS_NAMESPACE . "LocationModel");
        $data["location"] = call_user_func_array([$model, "getAllLocation"], []);
        $this->view('backend//pages/location/allLocationView', $data);

    }

    public function add()
    {
        if (!Auth::logged_in()) self::redirectTo("/admin/login");
        $data = [
            "title" => "Add Location",
            "location" => [],
            "error" => []
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["location"] = ["title" => trim($_POST["title"])];
            $model = $this->model(MODELS_NAMESPACE . "LocationModel");
            if(call_user_func_array([$model, "add"], [$data["location"]])) {
                MessageReporting::flash(MessagesName::LOCATION, "location added succfully");
                Self::redirectTo("/admin/location");
            } else { // failed to add
                $data["error"]["duplicate_location"] = "the location that you entered is already exist";
            }
        }
        $this->view('backend//pages/location/addLocationView', $data);  // get request -> to show the add form page
    }
    public function update(array $param = null)
    {
        if (!Auth::logged_in()) self::redirectTo("/admin/login");
        $data = [
            "pageTitle" => "update location",
            "location" => [],
            "error" => []
        ];
        $model = $this->model(MODELS_NAMESPACE . "LocationModel");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["location"] = [
                    "title" => trim($_POST["title"]),
                    "id" => $_POST["id"]
            ];
            if (call_user_func_array([$model, "update"], [$data["location"]])) { // return true if location succfully updated
                MessageReporting::flash(MessagesName::LOCATION, "location updated succfully");
                Self::redirectTo("/admin/location");
            } else 
                $data["error"]["duplicate_location"] = "the location that you entered is already exist";

        } else { // get request -> retireve the data from the database 
            $location = call_user_func_array([$model, "getLocationById"], [$param["id"]]);
            $data["location"] = [
                    "title" => trim($location["title"]),
                    "id" => $location["id"]
            ];
        }
        $this->view('backend//pages/location/editLocationView', $data);
    }


    public function delete()
    {
        if (!Auth::logged_in()) self::redirectTo("/admin/login");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = $this->model(MODELS_NAMESPACE . "LocationModel");
            if (call_user_func_array([$model, "delete"], [$_POST["id"]])) {
                MessageReporting::flash(MessagesName::LOCATION, "location deleted succfully");
                Self::redirectTo("/admin/location");
            }
        }
    }
}
