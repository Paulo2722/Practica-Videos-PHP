<?php

use Core\Authenticator;
use function Core\json;

$auth = new Authenticator();

$result = $auth->attempt($_POST['email'], $_POST['password']);

if (!$result) {
    json(['error' => 'Credenciales incorrectas'], 401);
}

json($result);