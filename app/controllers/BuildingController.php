<?php 
declare(strict_types = 1);
namespace App\Controllers;

use App\Libraries\Controller;

class BuildingController extends Controller {
    public function index() {
        $this->view("/pages/building/addBuildingView",[]);
    }
}
