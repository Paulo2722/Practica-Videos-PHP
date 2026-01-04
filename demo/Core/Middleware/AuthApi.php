<?php
namespace Core\Middleware;

use Core\Authenticator;
use function Core\json;

class AuthApi
{
    public function handle()
    {
        //Obtengo el header
        $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        //Compruebo al usuario que porta el token
        if (!str_starts_with($header, 'Bearer ')) {
            json(['error' => 'Token requerido'], 401);
        }

        //Obtengo el token y lo valido
        $token = substr($header, 7);

        $user = (new Authenticator)->validarToken($token);

        //Compruebo si el token es válido o no
        if (!$user) {
            json(['error' => 'Token inválido o caducado'], 401);
        }

        $_SERVER['api_user'] = $user;
        $_SERVER['api_token'] = $token;
    }
}