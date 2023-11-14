<?php
    require_once 'config.php';
    require_once 'libs/router.php';

    require_once 'src/controllers/producto.api.controller.php';
    
    $router = new Router();

    $router->addRoute('productos',     'GET',    'ProductoApiController', 'get'   ); 
    $router->addRoute('productos',     'POST',   'ProductoApiController', 'create');
    $router->addRoute('productos/:ID', 'GET',    'ProductoApiController', 'get'   );
    $router->addRoute('productos/:ID/:subrecurso', 'GET',    'ProductoApiController', 'get');
    $router->addRoute('productos/:ID', 'PUT',    'ProductoApiController', 'update');
    $router->addRoute('productos/:ID', 'DELETE', 'ProductoApiController', 'delete');
    

    
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);