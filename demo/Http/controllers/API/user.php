<?php
use Core\Middleware\Middleware;
use function Core\json;

Middleware::resolve('auth_api');

json($_SERVER['api_user']);