<?php

namespace Core\DAO;

interface NoteDAOInterface{
    public function findById($id);
    public function findByUser($user);
    public function createNote($body);
    public function updateNote($id, $body);
    public function deleteNote($id);
}