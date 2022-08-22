<?php
require __DIR__ . "/../app/bootstrap.php";
// load all the registered  routes
$router = new AltoRouter();
$router->addRoutes(App\Routes::registeredRoutes());

$config = new App\Config\Config($_ENV);
$db = new App\Libraries\Database($config->getConfig());

// run the program
(new App\App($db->getPDO(), $router))->run();

