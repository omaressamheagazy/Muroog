<?php
  /*
   * Base Controller
   * Loads the models and views
   */
  namespace App\Libraries;
  class Controller {
    // Load model
    public function model($model): Model{
      // Require model file
      // require_once '../app/models/' . $model . '.php';

      // Instatiate model
      if(!class_exists($model)) exit("the passed class not found");
      return new $model();
    }

    // Load view
    public function view($view, $data = []){
      // Check for view file
      if(file_exists('../app/views/' . $view . '.php')){
        require_once '../app/views/' . $view . '.php';
      } else {
        // View does not exist
        die('View does not exist');
      }
    }
    public static function redirectTo (string $path) {
      header("Location:{$path}");
      exit();
    }
  }