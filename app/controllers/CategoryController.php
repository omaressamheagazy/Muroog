<?php
declare (strict_types = 1);
namespace App\Controllers;

use App\Helpers\Auth;
use App\Libraries\Controller;

require_once "../app/helpers/Auth.php";
class categoryController extends Controller
{

    public function index()
    {
        if (!Auth::logged_in()) {
            self::redirectTo("/admin/login");
        }

        $data = [
            "title" => "category",
            "category" => [],
        ];
        $model = $this->model(MODELS_NAMESPACE . "CategoryModel");
        $data["category"] = call_user_func_array([$model, "index"], []);
        $this->view('/pages/category/allCategoryView', $data);

    }

    public function add()
    {
        if (!Auth::logged_in()) {
            self::redirectTo("/admin/login");
        }

        $data = [
            "title" => "Add category",
            "category" => [],
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["category"] = $_POST;
            $model = $this->model(MODELS_NAMESPACE . "CategoryModel");
            call_user_func_array([$model, "add"], [$data["category"]]);
            Self::redirectTo("/admin/category");

        }
        $this->view('/pages/category/addCategoryView', $data);

    }

    public function delete()
    {
        if (!Auth::logged_in()) {
            self::redirectTo("/admin/login");
        }

        $data = [
            "title" => "Add category",
            "id" => "",
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = $this->model(MODELS_NAMESPACE . "CategoryModel");
            call_user_func_array([$model, "delete"], [$_POST["id"]]);
            Self::redirectTo("/admin/category");
        }
    }

    public function update(array $param = null)
    {
        if (!Auth::logged_in()) {
            self::redirectTo("/admin/login");
        }

        $data = [
            "title" => "Update category",
            "id" => "",
            "category" => [],
        ];
        $data["id"] = $param["id"] ?? "";
        if (!empty($data["id"])) {

            $model = $this->model(MODELS_NAMESPACE . "CategoryModel");
            $data["category"] = call_user_func_array([$model, "index"], [$data["id"]])[0];
            $this->view('/pages/category/addCategoryView', $data);

        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            call_user_func_array([$model, "update"], [$_POST]);
        }

    }
}
