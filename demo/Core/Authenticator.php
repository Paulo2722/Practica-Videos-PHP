<?php

namespace Core;

class Authenticator
{
    protected $errors = [];
    public function attempt($email, $password)
    {
        $account = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            ':email' => $email,
        ])->find();

        if ($account && password_verify($password, $account["password"])) {
            $this->login($account);

            return true;
        }

        return false;
    }

    public function login($account) {
        $_SESSION['user'] = [
            'name' => $account["name"],
            'email' => $account["email"],
        ];
    }

    public function logout()
    {
        Session::destroy();
    }
}