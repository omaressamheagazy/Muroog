<?php
namespace App\Controllers;

use App\Helpers\Email;
use App\Helpers\Enums\MessagesName;
use App\Helpers\Enums\MessageType;
use App\Helpers\Logger;
use App\Helpers\MessageReporting;
use App\Helpers\Redirection;
use App\Libraries\Controller;
class PagesController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'TraversyMVC',
            'active' => 'home'
        ];
        try {

            $buildingModel = $this->model(MODELS_NAMESPACE . "BuildingModel");
            $data["building"] = call_user_func([$buildingModel, "getLatestBuilding"]);
            $this->view('frontend/pages/index', $data);
        } catch (\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            Redirection::redirectTo("/error/404");
        } 
    }

    public  function project() {
        $data = [
            'title' => 'TraversyMVC',
            'active' => 'project'
        ];  
        try {

            $categoryModel = $this->model(MODELS_NAMESPACE . "CategoryModel");
            $buildingModel = $this->model(MODELS_NAMESPACE . "BuildingModel");
            $data["building"] = call_user_func([$buildingModel, "getAllBuilding"]);
            $data["category"] = call_user_func([$categoryModel, "getAllCategory"]);
            $this->view('frontend/pages/project', $data);
        }
        catch (\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            Redirection::redirectTo("/error/404");
        } 
    }

    public function projectDetail(array $param) {
        $data = [
            'title' => 'TraversyMVC',
            'active' => 'project'
        ];  
        try {
            $buildingModel = $this->model(MODELS_NAMESPACE . "BuildingModel");
            if(!call_user_func_array([$buildingModel, "isIdValid"],['building', $param["id"]])) self::redirectTo("/error/404");
            $data["building"] = call_user_func_array([$buildingModel, "getBuildingById"], [$param["id"]]);
            $this->view('frontend/pages/projectDetail', $data);
        } catch(\PDOException $e) {
            $error = $e->getMessage();
            Logger::add($error);
            Redirection::redirectTo("/error/404");
        }
    }
    public function about()
    {
        $data = [
            'title' => 'About Us',
            'active' => "about"
        ];

        $this->view('frontend/pages/about', $data);
    }

    public function service() {
        $data = [
            'title' => 'Serivces',
            'active' => "service"
        ];
        $this->view('frontend/pages/service', $data);
    }
    public function contact()
    {
        $data = [
            'title' => 'About Us',
            'active' => "contact",
            "error" => [] 
        ];

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $data["contact"] = array_map(fn($element) => trim($element), $_POST);
            foreach($data["contact"] as $input) { // check if any input is empty
                if(empty($input)) {
                    $data["error"]["empty"] = "All fields are required";
                    break;
                }
            }
            $data["contact"]["email"] = filter_var($data["contact"]["email"], FILTER_SANITIZE_EMAIL); // validate and sanitize the email
            if(!empty($data["contact"]["email"])) 
                if(!filter_var($data["contact"]["email"], FILTER_VALIDATE_EMAIL)) $data["error"]["email"] = "email is not valid";
            if(empty($data["error"])) {
                $serverSetting = [
                    "server" => "smtp.gmail.com",
                    "username" => $_ENV["SMTP_USER"],
                    "password" => $_ENV["SMTP_PASSWORD"]
                ];
                $recipients = [
                    "fromEmail" => $data["contact"]["email"],
                    "fromName" =>  $data["contact"]["email"],
                    "recipientEmail" => $data["contact"]["email"] ,
                ];
                $content = [
                    "subject" => $data["contact"]["subject"],
                    "body" => $data["contact"]["body"]
                ];
                var_dump($recipients["fromEmail"]);
                $mail = new Email();
                $mail->sendEmail($serverSetting, $recipients, $content, false);
                exit();
            }
        }

        $this->view('frontend/pages/contact', $data);
    }


}
