<?php
declare (strict_types = 1);

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Enums\MessagesName;
use App\Helpers\Enums\MessageType;
use App\Helpers\MessageReporting;
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
        $this->view('backend/pages/admin/dashboardView', $data);
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
            call_user_func_array([$model, "login"], [$data]);
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
            $data["admin"] = call_user_func_array([$model, "getAdminById"], [$param["id"]]);
        }
        $this->view('backend/pages/admin/editAdminView', $data);
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
