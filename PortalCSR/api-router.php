<?php
require_once './libs/Router.php';
require_once './app/controller/controllerNews.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('news', 'GET', 'NewApiController', 'getNews');
$router->addRoute('news/:ID', 'GET', 'NewApiController', 'getNew');
$router->addRoute('news/:ID', 'DELETE', 'NewApiController', 'deleteNew');
$router->addRoute('news', 'POST', 'NewApiController', 'insertNew'); 

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);