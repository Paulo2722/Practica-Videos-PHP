<?php
use Core\Middleware\Middleware;
use function Core\json;

Middleware::resolve('auth.api');

json($_SERVER['api_user']);