<?php

namespace Core\Factory;

use Core\App;
use Core\Database;
use Core\DAO\NoteDAO;

class FactoryDAO{
    public static function getDAONote(){
        return new NoteDAO(App::resolve(Database::class));
    }
}