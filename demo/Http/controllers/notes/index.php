<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

$userName = $_SESSION['user']['name'];

$user = $db->query("SELECT id FROM users WHERE name = :username", [
    'username' => $userName
])->find();

$notes = $db->query('SELECT * FROM notes WHERE user_id = :user_id', [
    'user_id' => $user['id']
])->get();

view("notes/index.view.php", [
    'heading' => "Notes",
    'notes' => $notes,
]);