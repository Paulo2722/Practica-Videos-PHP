<!-- create.php !-->
<?php

//Todos los use
use Core\Factory\FactoryDAO;
use Core\Validator;

class NotesController{
    protected $dao;
    protected $user_id;

    public function __construct(){
        $this->dao = FactoryDAO::getDAONote();
        
        $this->user_id = $_SESSION['user']['id'];
    }

    public function index(){
        $notes = $this->dao->findByUser($this->user_id);

        return view("notes/index.view.php", [
        'heading' => "Notes",
        'notes' => $notes
        ]);
    }

    public function create(){
        return view("notes/create.view.php", [
            'heading' => "Create Notes",
            'errors' => []
        ]);
    }

    public function update(){
        $note = $this->dao->findById($id);

        authorize($note['user_id'] === $this->user_id);

        return view("notes/edit.view.php", [
            'heading' => "Edit Note",
            'errors' => [],
            'note' => $note,
        ]);
    }

    public function destroy($id){
        $note = $this->dao->findById($id);

        authorize($note["user_id"] === $this->user_id);

        $this->dao->deleteNote($id);

        redirect("/notes");
    }

    public function show(){
        $note = $this->dao->findBydId($id);

        authorize($note["user_id"] === $this->user_id);
    
        return view("notes/show.view.php", [
            'heading' => "Note #$id",
            'note' => $note,
        ]);
    }

    public function edit(){
        $note = $this->dao->findBydId($id);

        authorize($note["user_id"] === $this->user_id);
    
        return view("notes/edit.view.php", [
            'heading' => "Edit Note",
            'errors' => [],
            'note' => $note,
        ]);

    }

}