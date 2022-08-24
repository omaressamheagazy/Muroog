<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 */
declare (strict_types = 1);
namespace App;

class App
{
    private static \PDO $pdo;
    private \AltoRouter $router;
    private string $currentController = CONTROLLER_NAMESPACE . "ErrorController";
    private string $currentMethod = "index";
    private array $params = [];

    public function __construct(\PDO $pdo, \AltoRouter $router)
    {
        static::$pdo = $pdo;
        $this->router = $router;

    }
    public function run(): self
    {
        $this->router->addMatchTypes(array('codeId' => '[^/]++'));
        list($className, $method) = explode("#", $this->router->match()["target"] ?? "#", 2);
        if (class_exists($className = CONTROLLER_NAMESPACE . $className)) { // controller exst
            if (method_exists($className, $method)) { // action exist
                $this->currentController = $className;
                $this->currentMethod = $method;
                $this->params = $this->router->match()["params"];
            } 
        } 
        call_user_func_array([new $this->currentController, $this->currentMethod], [$this->params]);
        return $this;
    }

    public static function db(): \PDO {
        return static::$pdo;
    }

}
