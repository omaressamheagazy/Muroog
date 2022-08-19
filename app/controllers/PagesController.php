<?php
namespace App\Controllers;
use App\Libraries\Controller;
class PagesController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'TraversyMVC',
            'active' => 'home'
        ];
            $buildingModel = $this->model(MODELS_NAMESPACE . "BuildingModel");
            $data["building"] = call_user_func([$buildingModel, "getAllBuilding"]);
        $this->view('frontend/pages/index', $data);
    }

    public  function project() {
        $data = [
            'title' => 'TraversyMVC',
            'active' => 'project'
        ];  
            $categoryModel = $this->model(MODELS_NAMESPACE . "CategoryModel");
            $buildingModel = $this->model(MODELS_NAMESPACE . "BuildingModel");
            $data["building"] = call_user_func([$buildingModel, "getAllBuilding"]);
            $data["category"] = call_user_func([$categoryModel, "getAllCategory"]);
            $this->view('frontend/pages/project', $data);
    }

    public function projectDetail(array $param) {
        $data = [
            'title' => 'TraversyMVC',
            'active' => 'project'
        ];  
        $buildingModel = $this->model(MODELS_NAMESPACE . "BuildingModel");
        $data["building"] = call_user_func_array([$buildingModel, "getBuildingById"], [$param["id"]]);
        $this->view('frontend/pages/projectDetail', $data);



    }
    public function about()
    {
        $data = [
            'title' => 'About Us',
            'active' => "about"
        ];

        $this->view('frontend/pages/about', $data);
    }
    public function contact()
    {
        $data = [
            'title' => 'About Us',
            'active' => "contact"
        ];

        $this->view('frontend/pages/contact', $data);
    }


}
