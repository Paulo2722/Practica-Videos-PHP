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
        $this->db->query("insert into notes(user_id, body) values(:user_id, :body)", [
            ':user_id' => $user_id,
            'body' => $body
        ]);

        return $this->db->id();
    }

    public function updateNote($id, $body){
        return $this->db->query("update notes set body = :body where id = :id", [
            'body' => $body,
            ':id' => $id
        ]);
    }

    public function deleteNote($id){
        return $this->db->query("delete from notes where id = :id", [
            ':id' => $id
        ]);
    }
}