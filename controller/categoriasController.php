<?php
class CategoriaController {
    private $model;
    function requireAdmin() {
    if ($_SESSION['tipo'] !== 'admin') {
        die("Acesso restrito a administradores.");
        }
    }
    public function __construct() {
        if (empty($_SESSION['logado'])) {
            header("Location: index.php?page=login");
            exit;
        }

        if ($_SESSION['tipo'] !== 'admin') {
            die("Acesso restrito a administradores.");
        }

        $this->model = new Categoria();
    }

    public function index() {
        $categorias = $this->model->findAll();
        require 'views/categorias/index.php';
    }

    public function create() {
        require 'views/categorias/create.php';
    }

    public function store() {
        $this->model->save([
            'nome' => $_POST['nome']
        ]);

        header("Location: index.php?page=categorias");
    }

    public function edit() {
        $categoria = $this->model->findById($_GET['id']);
        require 'views/categorias/edit.php';
    }

    public function update() {
        $this->model->save([
            'id' => $_POST['id'],
            'nome' => $_POST['nome']
        ]);

        header("Location: index.php?page=categorias");
    }

    public function delete() {
        $this->model->delete($_GET['id']);
        header("Location: index.php?page=categorias");
    }
}
