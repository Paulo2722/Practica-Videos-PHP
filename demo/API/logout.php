<?php
use Core\Authenticator;
use Core\Middleware\Middleware;
use function Core\json;

Middleware::resolve('auth.api');

(new Authenticator)->eliminarToken($_SERVER['api_token']);

json(['message' => 'Token eliminado']);