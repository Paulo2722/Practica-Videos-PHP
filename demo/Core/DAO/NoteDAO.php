<?php

namespace Core\DAO;

use Core\Database;

class NoteDAO implements NoteDAOInterface{
    
    protected $db;
    
    public function __construct(Database $db){
        $this->db = $db;
    }
}