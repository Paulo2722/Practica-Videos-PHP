<?php

function esJson(){
    return isset($_SERVER['HTTP_ACCEPT']) && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json');
}

function json($data, $status = 200){
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}