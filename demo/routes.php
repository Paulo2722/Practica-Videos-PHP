<?php

use Http\controllers\NotesController;

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/notes', [NotesController::class, 'index'])->only('auth');
$router->get('/notes/create', [NotesController::class, 'create'])->only('auth');
$router->post('/notes', [NotesController::class, 'store'])->only('auth');
$router->get('/notes/{id}', [NotesController::class, 'show'])->only('auth');
$router->get('/notes/{id}/edit', [NotesController::class, 'edit'])->only('auth');
$router->patch('/notes/{id}', [NotesController::class, 'update'])->only('auth');
$router->delete('/notes/{id}', [NotesController::class, 'destroy'])->only('auth');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');

