<?php
declare (strict_types = 1);

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Enums\MessagesName;
use App\Helpers\Enums\MessageType;
use App\Helpers\Logger;
use App\Helpers\MessageReporting;
use App\Helpers\Redirection;
use App\Libraries\Controller;

// require_once "../app/helpers/Auth.php";

class AdminController extends Controller
{

    public function index()
    {
        if (!Auth::logged_in())  self::redirectTo("/admin/login");
        $data = [
            "title" => "admin dashbopoard",
        ];
        try {
            $categoryModel = $this->model(MODELS_NAMESPACE . "categoryModel");
            $locationModel = $this->model(MODELS_NAMESPACE . "locationModel");
            $adminModel = $this->model(MODELS_NAMESPACE . "AdminModel");
            $buildingModel = $this->model(MODELS_NAMESPACE . "buildingModel");
            $data["category"] = call_user_func([$categoryModel, "numberOfCategory"]);
            $data["location"] = call_user_func([$locationModel, "numberOfLocation"]);
            $data["admin"] = call_user_func([$adminModel, "numberOfAdmin"]);
            $data["building"] = call_user_func([$buildingModel, "numberOfBuilding"]);
            $this->view('backend/pages/admin/dashboardView', $data);
        } catch(\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            MessageReporting::flash(MessagesName::ERROR, "An error happend trying to load the dashboard please try again", MessageType::FAIL);
            Redirection::redirectTo("/admin");
        }
    }

    public function login()
    {
        $data = [
            "title" => "admin login",
            "email" => "",
            "password" => "",
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["email"] = $_POST["email"];
            $data["password"] = $_POST["password"];
            $model = $this->model(MODELS_NAMESPACE . "AdminModel");
            if(!call_user_func_array([$model, "login"], [$data])) 
                MessageReporting::flash(MessagesName::ERROR, "The email or password is incorrect", MessageType::FAIL);
        }
        if (Auth::logged_in()) self::redirectTo("/admin/");
        $this->view('backend/pages/admin/loginView', $data);
    }

    public function logout() {
        Auth::logout();
        self::redirectTo("/admin");
    }

    public function allAdmin() {
        if (!Auth::logged_in())  self::redirectTo("/admin/login");
        if(!Auth::isSuperAdmin()) self::redirectTo("/admin");
        $data = [
            "title" => "All admin",
        ];
        $model = $this->model(MODELS_NAMESPACE . "AdminModel");
        $data["admin"] = call_user_func_array([$model, "getAlladmin"], []);
        $this->view('backend/pages/admin/allAdminView',$data);
    }

    public function add() {
        if (!Auth::logged_in())  self::redirectTo("/admin/login");
        if(!Auth::isSuperAdmin()) self::redirectTo("/admin");

        $data = [
            "title" => "add admin",
            "error" => []
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array_map(fn($element) => trim($element), $_POST);
            $model = $this->model(MODELS_NAMESPACE . "AdminModel");
            

                if(call_user_func_array([$model, "add"], [$data])) {
                    MessageReporting::flash(MessagesName::ADMIN, "admin added succesfully");
                    self::redirectTo("/admin/all");
                } else {
                    $data["error"]["email"] = "The email that you entered is exist";
                }
            
        }
        $data["title"] = "add admin";
        $this->view('backend/pages/admin/addAdminView', $data);
    }

    public function update(array $param = null) {
        if (!Auth::logged_in())  self::redirectTo("/admin/login");
        if(!Auth::isSuperAdmin()) self::redirectTo("/admin");

        $data = [
            "title" => "update admin",
            "error" => []
        ];
        $model = $this->model(MODELS_NAMESPACE . "AdminModel");
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["admin"] = array_map(fn($element) => trim($element), $_POST);

                if(call_user_func_array([$model, "update"], [$data["admin"]])) {
                    MessageReporting::flash(MessagesName::ADMIN, "admin updated succesfully");
                    self::redirectTo("/admin/all");
                } else {
                    $data["error"]["email"] = "The email that you entered is exist";
                }
        } else {
            if(!call_user_func_array([$model, "isIdValid"],['admin', $param["id"]]) || $param["id"] == $_SESSION["USER"]) self::redirectTo("/admin");
            $data["admin"] = call_user_func_array([$model, "getAdminById"], [$param["id"]]);
        }
        $this->view('backend/pages/admin/editAdminView', $data);
    }

    public function editProfile(array $param = null) {
        if (!Auth::logged_in())  self::redirectTo("/admin/login");

        $data = [
            "title" => "edit profile",
            "error" => []
        ];
        $model = $this->model(MODELS_NAMESPACE . "AdminModel");
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["admin"] = array_map(fn($element) => trim($element), $_POST);

                if(call_user_func_array([$model, "update"], [$data["admin"]])) {
                    MessageReporting::flash(MessagesName::ADMIN, "profile updated succesfully");
                    self::redirectTo("/admin");
                } else {
                    $data["error"]["email"] = "The email that you entered is exist";
                }
        } else {
            if(!call_user_func_array([$model, "isIdValid"],['admin', $param["id"]])) self::redirectTo("/admin");
            $data["admin"] = call_user_func_array([$model, "getAdminById"], [$param["id"]]);
        }
        $this->view('backend/pages/admin/editProfileView', $data);
    }





        public function delete() {
        if (!Auth::logged_in())  self::redirectTo("/admin/login");
        if(!Auth::isSuperAdmin()) self::redirectTo("/admin");

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $model = $this->model(MODELS_NAMESPACE . "AdminModel");
            if(call_user_func_array([$model, "delete"], [$_POST["id"]])) {
                MessageReporting::flash(MessagesName::ADMIN, "admin deleted succfully");
            } else {
                MessageReporting::flash(MessagesName::ADMIN, "An error happened", MessageType::FAIL);
            }
            Self::redirectTo("/admin/all");
        }
        
    }
}
