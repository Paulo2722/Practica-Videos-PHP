<?php
namespace Http\controllers;

use Core\Factory\FactoryDAO;

class NotesController {

    protected $dao;
    protected $user_id;

    public function __construct() {
        $this->user_id = $_SESSION['user']['id'] ?? null;
        $this->dao = FactoryDAO::getDAONote();
    }

    public function index() {
        $notes = $this->dao->findByUser($this->user_id);

        return view("notes/index.view.php", [
            'heading' => "Notes",
            'notes' => $notes
        ]);
    }

    public function create() {
        return view("notes/create.view.php", [
            'heading' => "Create Notes",
            'errors' => []
        ]);
    }

    public function store() {
        $body = $_POST['body'];

        $this->dao->createNote($this->user_id, $body);

        redirect('/notes');
    }

    public function show($id) {
        $note = $this->dao->findById($id);
        authorize($note["user_id"] === $this->user_id);

        return view("notes/show.view.php", [
            'heading' => "Note #$id",
            'note' => $note,
        ]);
    }

    public function edit($id) {
        $note = $this->dao->findById($id);
        authorize($note["user_id"] === $this->user_id);

        return view("notes/edit.view.php", [
            'heading' => "Edit Note",
            'errors' => [],
            'note' => $note,
        ]);
    }

    public function update($id) {
        $note = $this->dao->findById($id);
        authorize($note['user_id'] === $this->user_id);

        $this->dao->updateNote($id, $_POST['body']);
        redirect('/notes');
    }

    public function destroy($id) {
        $note = $this->dao->findById($id);
        authorize($note["user_id"] === $this->user_id);

        $this->dao->deleteNote($id);
        redirect('/notes');
    }
}
