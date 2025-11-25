<?php

namespace Core\DAO;

use Core\Database;

class NoteDAO implements NoteDAOInterface{
    
    protected $db;
    
    public function __construct(Database $db){
        $this->db = $db;
    }


    public function findAll(){
        return $this->db->query("select * from notes order by id desc")->get();
    }

    public function findById($id){
        return $this->db->query("select * from notes where id = :id", [
            ':id' => $id
        ])->find();
    }

    public function findByUser($user_id){
        return $this->db->query("select * from notes where user_id = :user_id", [
            ':user_id' => $user_id
        ])->find();
    }

    public function createNote($body){

    }

    public function updateNote($id, $body){

    }

    public function deleteNote($id){

    }
}