<?php
namespace Http\controllers;

use Core\Factory\FactoryDAO;
require_once BASE_PATH . 'Core/Identificador.php';
use function Core\json;
use function Core\esJson;

class NotesController {

    protected $dao;
    protected $user_id;

    public function __construct() {
        if (esJson()){
            $this->user_id = $_REQUEST['auth_user_id'] ?? null;
        }else{
            $this->user_id = $_SESSION['user']['id'] ?? null;
        }
        $this->dao = FactoryDAO::getDAONote();
    }

    public function index() {
        $notes = $this->dao->findByUser($this->user_id);

        if(esJson()){
            return json($notes);
        }

        return view("notes/index.view.php", [
            'heading' => "Notes",
            'notes' => $notes
        ]);
    }

    public function store() {
        $body = $_POST['body'];

        $this->dao->createNote($this->user_id, $body);

        if(esJson()){
            return json(['success' => true]);
        }

        redirect('/notes');
    }

    public function show($id) {
        $note = $this->dao->findById($id);
        authorize($note["user_id"] === $this->user_id);

        if(esJson()){
            return json($note);
        }

        return view("notes/show.view.php", [
            'heading' => "Note #$id",
            'note' => $note,
        ]);
    }

    public function update($id) {
        $note = $this->dao->findById($id);
        authorize($note['user_id'] === $this->user_id);

        $this->dao->updateNote($id, $_POST['body']);

        if(esJson()){
            return json(['success' => true]);
        }

        redirect('/notes');
    }

    public function destroy($id) {
        $note = $this->dao->findById($id);
        authorize($note["user_id"] === $this->user_id);

        $this->dao->deleteNote($id);

        if(esJson()){
            return json(['success' => true]);
        }

        redirect('/notes');
    }
}
