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
    private string $currentController = CONTROLLER_NAMESPACE . "PagesController";
    private string $currentMethod = "index";
    private array $params = [];

    public function __construct(\PDO $pdo, \AltoRouter $router)
    {
        static::$pdo = $pdo;
        $this->router = $router;
    }
    public function run(): self
    {
        list($className, $method) = explode("#", $this->router->match()["target"] ?? "#", 2);
        if (class_exists($className = CONTROLLER_NAMESPACE . $className)) {
            // var_dump($this->router->match());
            if (method_exists($className, $method)) {
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
