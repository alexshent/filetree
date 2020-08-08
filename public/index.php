<?php

#print_r($_SERVER);exit;

spl_autoload_register(
    function ($class) {
        $root = dirname(__DIR__);
        $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
        
        if (is_readable($file)) {
            require $file;
        }
    }
);

$router = new core\Router();

$router->add('/', ['controller' => 'Main', 'action' => 'index']);
$router->add('/{controller}', ['action' => 'index']);
$router->add('/{controller}/{action}');
$router->add('/ajax/children/{parentid:.+}', ['controller' => 'Ajax', 'action' => 'children']);

#echo '<pre>'; echo htmlspecialchars(print_r($router->getRoutes(), true)); echo '</pre>';

$url = $_SERVER['REQUEST_URI'];
$router->dispatch($url);
