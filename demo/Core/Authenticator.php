<?php

namespace Core;

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