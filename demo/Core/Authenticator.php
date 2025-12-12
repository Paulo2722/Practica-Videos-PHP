<?php

namespace Core;
use Random\RandomException;
use function Core\json;
use function Core\esJson;

class Authenticator
{
    protected $errors = [];

    public function getUser($email){
        return App::resolve(Database::class)->query(
            'SELECT * FROM users WHERE email = :email',
            [
                ':email' => $email,
            ]
        )->find();
    }
    public function attempt($email, $password)
    {
        $user = $this->getUser($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        // Si la petición es JSON, creo un token
        if (esJson()) {
            return $this->nuevoToken($user['id']);
        }

        // Si la petición es web, inicio una sesión normal
        $this->login($user);
        return true;
    }

    //Creación del token
    public function nuevoToken($user_id){
        $token = bin2hex(random_bytes(32));
        $this->guardarToken($user_id, $token);
        return $token;
    }

    //Crear un token de otra forma

    /**
     * @throws RandomException
     */
    public function crearNuevoToken($user_id, $longitud){
        if ($longitud < 4) {
            $longitud = 4;
        }

        $token = bin2hex(random_bytes($longitud));
        $this->guardarToken($user_id, $token);
        return $this;
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