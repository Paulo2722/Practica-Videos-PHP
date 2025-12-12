<?php

use Core\Session;
use Core\ValidationException;
use function Core\esJson;
use function Core\json;

session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';
require BASE_PATH . 'Core/Identificador.php'; // <-- Esto agrega esJson() y json()

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

require BASE_PATH . 'bootstrap.php';

$router = new \Core\Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

//Parte de token
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$request = $_SERVER['REQUEST_METHOD'];

switch ($request) {
    case 'POST':
        include("users/post.php");
        break;
    default:
        echo json_encode(["message" => "Método no permitido"]);
}


Session::unflash();


