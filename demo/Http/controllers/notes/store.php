<?php

use Core\Database;
use Core\Validator;
use Core\App;

$db = App::resolve(Database::class);
$errors = [];

if (!Validator::string($_POST["body"], 1, 1000)) {
    $errors['body'] = "A body of no more than 1,000 characters is required";
}

if (!empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => "Create Note",
        'errors' => $errors
    ]);
}

if (!isset($_SESSION['user'])) {
    die('No hay sesión de usuario válida');
}

$userName = $_SESSION['user']['name'];
$user = $db->query("SELECT id FROM users WHERE name = :username", [
    'username' => $userName
])->find();

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
    'body'    => $_POST['body'],
    'user_id' => $user['id']
]);

header('location: /notes');
exit();
