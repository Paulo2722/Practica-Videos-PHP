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

}



/*
//destroy.php

$db = App::resolve(Database::class);

$currentUserId = 2;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id'],
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query("DELETE FROM notes WHERE id = :id", ["id" => $_GET["id"]]);

header('location: /notes');
exit();

//edit.php

$db = App::resolve(Database::class);

$currentUserId = 2;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id'],
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view("notes/edit.view.php", [
    'heading' => "Edit Note",
    'errors' => [],
    'note' => $note,
]);

//index.php

$db = App::resolve(Database::class);

$userName = $_SESSION['user']['name'];

$user = $db->query("SELECT id FROM users WHERE name = :username", [
    'username' => $userName
])->find();

$notes = $db->query('SELECT * FROM notes WHERE user_id = :user_id', [
    'user_id' => $user['id']
])->get();

view("notes/index.view.php", [
    'heading' => "Notes",
    'notes' => $notes,
]);

//show.php

$db = App::resolve(Database::class);

$currentUserId = 2;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id'],
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view("notes/show.view.php", [
    'heading' => "Note nº" . $_GET['id'],
    'note' => $note,
]);

//store.php

$db = App::resolve(Database::class);
$errors = [];

if (!Validator::string($_POST["body"], 1, 1000)) {
    $errors['body'] = "A body of no more than 1,000 characters is required";
}

if (!empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => "Create Note",
        'errors' => $errors
    ]);
}

if (!isset($_SESSION['user'])) {
    die('No hay sesión de usuario válida');
}

$userName = $_SESSION['user']['name'];
$user = $db->query("SELECT id FROM users WHERE name = :username", [
    'username' => $userName
])->find();

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
    'body'    => $_POST['body'],
    'user_id' => $user['id']
]);

header('location: /notes');
exit();

//update.php

$db = App::resolve(Database::class);

$currentUserId = 2;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    ':id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if (!Validator::string($_POST["body"], 1, 1000)) {
    $errors['body'] = "A body of no more than 1,000 characters is required";
}

if (count($errors)) {
    return view("notes/edit.view.php", [
        'heading' => 'Edit note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

header("location: /notes");
die();
*/
