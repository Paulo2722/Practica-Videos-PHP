<?php
namespace Core;

// Devuelve true si la petición espera JSON
function esJson() {
    return isset($_SERVER['HTTP_ACCEPT']) && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json');
}

// Responde con JSON y código HTTP
function json($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}