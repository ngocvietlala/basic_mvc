<?php

require_once __DIR__. './../models/Todo.php';


class TodoController extends Controller
{
    public $todo;

    public function __construct()
    {
        parent::__construct();
        $this->todo = new Todo();
    }

    public function index()
    {
        $todos = $this->todo->getTodo();

        return $this->view->render('index', compact('todos'));
    }

    public function create()
    {
        // TODO: Define route and handle exception in separated file.
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->responseMethodNotAllowed();
        }

        // TODO: put validation logic.

        if (!$this->todo->add($_POST['start_at'], $_POST['end_at'], $_POST['event_name'])) {
            return $this->responseServerError();
        }

        return $this->responseCreated(['status' => true]);
    }
}
