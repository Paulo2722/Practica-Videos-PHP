<?php
namespace Core\Middleware;

use Core\Authenticator;
use function Core\json;

class AuthApi
{
    public function handle()
    {
        //Compruebo que viene el header Authorization
        $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (!$header) {
            $headers = apache_request_headers();
            $header = $headers['Authorization'] ?? '';
        }

        if (!str_starts_with($header, 'Bearer ')) {
            json(['error' => 'Token no proporcionado'], 401);
        }

        //Extraigo el token
        $token = str_replace('Bearer ', '', $header);

        //Valido el token
        $auth = new Authenticator();
        $user = $auth->validarToken($token);

        if (!$user) {
            json(['error' => 'Token inválido o caducado'], 401);
        }

        //Guardo el usuario y el token
        $_SERVER['api_user'] = $user;
        $_SERVER['api_token'] = $token;
    }
}