<?php
declare (strict_types = 1);

namespace App\Controllers;
require_once "../app/helpers/File.php";
use App\Helper\File;
class ProductController extends \App\Libraries\Controller

{
    public function index()
    {
        $data = [
            "title" => "products",
        ];
        $model = $this->model(MODELS_NAMESPACE . "ProductModel");
        $data["products"] = call_user_func_array([$model, "index"], []);
        $this->view('pages/products/allProdcutsView', $data);
    }

    public function add(): void
    {
        $data = [
            "title" => "prodcut form",
            "productTitle" => "",
            "price" => "",
            "descriptoin" => "",
            "errorMsg" => [],
            "file" => "",
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data["productTitle"] = $_POST["title"];
            $data["price"] = $_POST["price"];
            $data["descriptoin"] = $_POST["description"];
            if (empty($data["title"])) {
                $data["errorMsg"]["productTitle"] = "product title is required";
            }
            if (empty($data["price"])) {
                $data["errorMsg"]["price"] = "product price is required";
            }
            if (!empty($_FILES["file"]["name"])) {
                $data["file"]= $_FILES["file"];
                if(File::checkFileError($data["file"], "validateImage", $data["errorMsg"] )) {
                    $fileE = explode(".", $data["file"]["name"]);
                    $fileExtension = strtolower(end($fileE));
                    $data["file"]["name"] = uniqid("product", true) . ".{$fileExtension}";
                    $fileDest = UPLOADS."/{$data["file"]["name"]}";
                    move_uploaded_file($data["file"]["tmp_name"], $fileDest);
                }
            }
            if (empty($data["errorMsg"])) {
                $model = $this->model(MODELS_NAMESPACE . "ProductModel");
                call_user_func_array([$model, "add"], [$data]);
            }
        }
        $this->view('pages/products/addProductView', $data);
    }

    public function edit(): void
    {
        $data = [
            "title" => "edit prodcut",
        ];
        $this->view('pages/products/addProductView', $data);
    }
    public function delete(): void
    {
        $data = [
            "title" => "prodcut",
        ];
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            exit();
        }

        $model = $this->model(MODELS_NAMESPACE . "ProductModel");
        echo "<br>";
        var_dump($_POST);
        echo "<br>";
        call_user_func_array([$model, "delete"], [$_POST["id"]]);
        $data["products"] = call_user_func_array([$model, "index"], []);
        $this->view('pages/products/allProdcutsView', $data);
    }

    public function update(): void {
        $data = [
            "title" => "prodcut",
        ];

    }

}
