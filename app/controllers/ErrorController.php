<?php 
declare(strict_types = 1);
namespace App\Controllers;

use App\Libraries\Controller;

class ErrorController extends Controller {
    public function index() {
        $this->view('errors/404', []);
    }
}


?>