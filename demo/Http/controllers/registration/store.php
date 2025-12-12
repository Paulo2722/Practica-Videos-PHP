<?php

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$date_birth = $_POST["date_birth"];
$number = $_POST["number"];

use Core\Database;
use Core\Validator;
use Core\App;

$db = App::resolve(Database::class);
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = "A valid email address is required";
}

if (!Validator::string($_POST["password"], 7, 40)) {
    $errors['password'] = "A password of between 7 and 40 characters is required";
}

if (!empty($errors)) {
    return view("registration/create.view.php", [
        'errors' => $errors
    ]);
}

$account = $db->query('SELECT * FROM users WHERE email = :email', [
    ':email' => $email,
])->find();

if (!empty($account)) {
    header('location: /login');
}

$db->query('INSERT INTO users (name, email, password, date_birth, number) VALUES (:name, :email, :password, :date_birth, :number)', [
    ':name' => $name,
    ':email' => $email,
    ':password' => password_hash($password, PASSWORD_BCRYPT),
    ':date_birth' => $date_birth,
    ':number' => $number
]);

$userId = $db->lastInsertId();

$_SESSION['user'] = [
    'id' => $userId,
    'name' => $name,
    'email' => $email,
    'date_birth' => $date_birth,
    'number' => $number
];

header('location: /');
exit();
