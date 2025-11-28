<?php

namespace Core\DAO;

interface NoteDAOInterface{
    public function findAll();
    public function findById($id);
    public function findByUser($user_id);
    public function createNote($user_id, $body);
    public function updateNote($id, $body);
    public function deleteNote($id);
}