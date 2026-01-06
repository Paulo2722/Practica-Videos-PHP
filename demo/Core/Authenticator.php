<?php

namespace Core;
use Random\RandomException;
use function Core\json;
use function Core\esJson;

class Authenticator
{
    protected $errors = [];

    //Obtengo un usuario según su email
    public function getUser($email){
        return App::resolve(Database::class)->query(
            'SELECT * FROM users WHERE email = :email',
            [
                ':email' => $email,
            ]
        )->find();
    }

    //Autenticar el usuario
    public function attempt($email, $password)
    {
        $user = $this->getUser($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        // Si la petición es JSON, creo un token
        if (esJson()) {
            return $this->crearToken($user['id']);
        }

        // Si la petición es web, inicio una sesión normal
        $this->login($user);
        return true;
    }

    //Creación de token temporal
    public function crearToken($user_id)
    {
        $token = bin2hex(random_bytes(32));

        //Esto me permite establecer una fecha de caducidad al token
        $expires = (new \DateTime('+30 minutes'))->format('Y-m-d H:i:s'); //En DateTime, he de usar la clase global

        App::resolve(Database::class)->query(
            "INSERT INTO tokens (user_id, token, expires_at)
             VALUES (:user_id, :token, :expires)",
            [
                'user_id' => $user_id,
                'token' => $token,
                'expires' => $expires
            ]
        );

        return [
            'token' => $token,
            'expires_at' => $expires
        ];
    }

    //Validación del token
    //Compruebo que el token existe y no está caducado y obengo al usuario asignado
    public function validarToken($token)
    {
        return App::resolve(Database::class)->query(
            "SELECT users.* FROM tokens
             JOIN users ON users.id = tokens.user_id
             WHERE token = :token
             AND expires_at > NOW()",
            ['token' => $token]
        )->find();
    }

    //Funciones para eliminar los tokens, una elimina un token concreto mientras que la otra, elimina todos
    public function eliminarToken($token)
    {
        App::resolve(Database::class)->query(
            "DELETE FROM tokens WHERE token = :token",
            ['token' => $token]
        );
    }

    public function eliminarTodosTokens($user_id)
    {
        App::resolve(Database::class)->query(
            "DELETE FROM tokens WHERE user_id = :id",
            ['id' => $user_id]
        );
    }
    public function guardarToken($user_id, $token){
        App::resolve(Database::class)->query(
            "INSERT INTO tokens (user_id, token) VALUES (:user_id, :token)",
            [
                'user_id' => $user_id,
                'token' => $token
            ]
        );
    }

    public function login($account) {
        $_SESSION['user'] = [
            'id' => $account["id"],
            'name' => $account["name"],
            'email' => $account["email"],
        ];
    }

    public function logout()
    {
        Session::destroy();
    }
}