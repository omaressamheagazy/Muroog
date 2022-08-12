<?php
declare (strict_types = 1);

namespace App\Controllers;

use App\Helpers\Auth;
use App\Libraries\Controller;

// require_once "../app/helpers/Auth.php";

class AdminController extends Controller
{

    public function index()
    {
        var_dump($_SESSION);
        if (!Auth::logged_in())  self::redirectTo("/admin/login");
        $data = [
            "title" => "admin dashbopoard",
        ];
        $this->view('pages/admin/dashboardView', $data);
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
        $this->view('pages/admin/loginView', $data);
    }
}
