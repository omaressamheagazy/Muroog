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
class CategoryController extends Controller
{

    public function index()
    {
        if (!Auth::logged_in()) {
            self::redirectTo("/admin/login");
        }

        $data = [
            "title" => "Category",
            "category" => [],
        ];
        $model = $this->model(MODELS_NAMESPACE . "CategoryModel");
        $data["category"] = call_user_func_array([$model, "getAllCategory"], []);
        $this->view('backend//pages/category/allCategoryView', $data);

    }

    public function add()
    {
        if (!Auth::logged_in()) self::redirectTo("/admin/login");
        $data = [
            "title" => "Add Category",
            "category" => [],
            "error" => []
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["category"] = ["title" => trim($_POST["title"])];
            $model = $this->model(MODELS_NAMESPACE . "CategoryModel");
            if(call_user_func_array([$model, "add"], [$data["category"]])) {
                MessageReporting::flash(MessagesName::CATEGORY, "category added succfully");
                Self::redirectTo("/admin/category");
            } else { // failed to add
                $data["error"]["duplicate_category"] = "the category that you entered is already exist";
            }
        }
        $this->view('backend//pages/category/addCategoryView', $data);  // get request -> to show the add form page
    }
    public function update(array $param = null)
    {
        if (!Auth::logged_in()) self::redirectTo("/admin/login");
        $data = [
            "pageTitle" => "update Category",
            "category" => [],
            "error" => []
        ];
        $model = $this->model(MODELS_NAMESPACE . "CategoryModel");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["category"] = [
                    "title" => trim($_POST["title"]),
                    "id" => $_POST["id"]
            ];
            if (call_user_func_array([$model, "update"], [$data["category"]])) { // return true if category succfully updated
                MessageReporting::flash(MessagesName::CATEGORY, "category updated succfully");
                Self::redirectTo("/admin/category");
            } else 
                $data["error"]["duplicate_category"] = "the category that you entered is already exist";

        } else { // get request -> retireve the data from the database 
            try {

                if(!call_user_func_array([$model, "isIdValid"],['category', $param["id"]])) self::redirectTo("/admin");
                $category = call_user_func_array([$model, "getCategoryById"], [$param["id"]]);
                $data["category"] = [
                        "title" => trim($category["title"]),
                        "id" => $category["id"]
                ];
            } catch(\PDOException $e) {
                $error = $e->getMessage();
                Logger::add($error);
                MessageReporting::flash(MessagesName::ERROR, "An error happend while updating a new category, please try again", MessageType::FAIL);
                Redirection::redirectTo("/admin/category");
            }
        }
        $this->view('backend//pages/category/editCategoryView', $data);
    }


    public function delete()
    {
        if (!Auth::logged_in()) self::redirectTo("/admin/login");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = $this->model(MODELS_NAMESPACE . "CategoryModel");
            if (call_user_func_array([$model, "delete"], [$_POST["id"]])) {
                MessageReporting::flash(MessagesName::CATEGORY, "category deleted succfully");
                Self::redirectTo("/admin/category");
            }
        }
    }
}
