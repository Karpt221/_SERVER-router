<?php
spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\','/',$class_name);
    require __DIR__ . '/../' . $class_name . '.php';
});


$router = new classes\Router();

$router->register('/',[classes\Home::class, 'getHomePage']);

$router->register('/invoice',function (){
    echo 'Invoice';
});

$router->register('/invoice/create',function (){
    echo 'Invoice created';
});

try {
    $router->resolve($_SERVER['REQUEST_URI']);
} catch (\Throwable $th) {
    echo $th->getMessage();
}

