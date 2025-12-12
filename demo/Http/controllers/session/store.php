<?php

use Core\Authenticator;
use Http\Forms\LoginForm;
//Funciones de token
use function Core\json;
use function Core\esJson;

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$auth = new Authenticator();

$token = $auth->attempt($attributes['email'], $attributes['password']);

if(!$token) {

    //Respuesta JSON
    if(esJson()){
        return json(['error' => 'Credenciales invalidas'], 401);
    }

    //Respuesta REST
    $form->error('email', 'Credenciales invalidas');
}

//Si es JSON devolvemos el token
if (esJson()) {
    return json([
        'success' => true,
        'token' => $token
    ]);
}

// Web normal
redirect('/');