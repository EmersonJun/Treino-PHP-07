<?php
class UsuarioController {
    private $model;

    public function __construct() {
        if (empty($_SESSION['logado']) || $_SESSION['tipo'] !== 'admin') {
            die("Acesso restrito a administradores.");
        }
        $this->model = new Usuario(); // veja nota abaixo
    }

    public function index() {
        $usuarios = $this->model->findAll();
        require 'views/usuario/index.php';
    }

    public function delete() {
        $this->model->delete($_GET['id']);
        header("Location: index.php?page=usuarios");
    }
}
