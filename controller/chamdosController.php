<?php
class ProjetoController {
    private $chamadoModel;
    private $usuarioModel;
    private $relacionamentoModel;

    public function __construct() {
        if (empty($_SESSION['logado']) || $_SESSION['tipo'] !== 'tecnico') {
            header("Location: index.php?page=login");
            exit;
        }
        $this->chamadoModel = new Chamado();
        $this->usuarioModel = new Usuario();
        $this->relacionamentoModel = new EquipeProjeto();
    }

    public function index() {
        $projetos = $this->chamadoModel->findAll();
        require 'views/projeto/index.php';
    }

    public function create() {
        $chamados = $this->equipeModel->findAll();
        require 'views/projeto/create.php';
    }

    public function store() {
        $titulo = $_POST['titulo'] ?? null;
        $descricao = $_POST['descricao'] ?? null;
        $equipes = $_POST['equipes'] ?? [];

        if (empty($titulo)) {
            die("O campo 'título' é obrigatório.");
        }

        $this->chamadoModel->save([
            'titulo' => $titulo,
            'descricao' => $descricao,
        ]);

        $projeto_id = Banco::getConnection()->lastInsertId();

        foreach ($equipes as $equipe_id) {
            $this->relacionamentoModel->save($equipe_id, $projeto_id);
        }

        header("Location: index.php?page=projetos");
    }

    public function edit() {
        $id = $_GET['id'];
        $chamado = $this->chamadoModel->findById($id);
        $equipes = $this->equipeModel->findAll();
        $equipesSelecionadas = array_column($this->relacionamentoModel->getEquipesByProjeto($id), 'id');
        require 'views/projeto/edit.php';
    }

    public function update() {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'] ?? null;
        $descricao = $_POST['descricao'] ?? null;
        $equipes = $_POST['equipes'] ?? [];

        if (empty($titulo)) {
            die("O campo 'título' é obrigatório.");
        }

        $chamado = $this->chamadoModel->findById($id);

        $this->chamadoModel->save([
            'id' => $id,
            'titulo' => $titulo,
            'descricao' => $descricao,
        ]);

        $this->relacionamentoModel->deleteByProjeto($id);
        foreach ($equipes as $equipe_id) {
            $this->relacionamentoModel->save($equipe_id, $id);
        }

        header("Location: index.php?page=projetos");
    }

    public function delete() {
        $id = $_GET['id'];
        $this->relacionamentoModel->deleteByProjeto($id);
        $this->chamadoModel->delete($id);
        header("Location: index.php?page=projetos");
    }
}
