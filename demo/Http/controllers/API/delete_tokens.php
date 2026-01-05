<?php
use Core\Authenticator;
use Core\Middleware\Middleware;
use function Core\json;

Middleware::resolve('auth.api');

(new Authenticator)->eliminarTodosTokens($_SERVER['api_user']['id']);

json(['message' => 'Todos los tokens eliminados']);