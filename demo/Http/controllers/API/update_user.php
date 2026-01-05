<?php
use Core\App;
use Core\Database;
use Core\Middleware\Middleware;
use function Core\json;

Middleware::resolve('auth_api');

$data = json_decode(file_get_contents('php://input'), true);

App::resolve(Database::class)->query(
    "UPDATE users SET birth_date = :birth, phone = :phone WHERE id = :id",
    [
        'birth' => $data['birth_date'],
        'phone' => $data['phone'],
        'id' => $_SERVER['api_user']['id']
    ]
);

json(['message' => 'Datos actualizados']);