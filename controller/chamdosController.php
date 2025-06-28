<?php
class ChamadoController {
    private $model;
    private $categoriaModel;

    public function __construct() {
        if (empty($_SESSION['logado'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $this->model = new Chamado();
        $this->categoriaModel = new Categoria();
    }

    // Cliente: lista apenas seus chamados
    // Técnico: lista todos os chamados
    public function index() {
        $tipo = $_SESSION['tipo'];  
        $id_usuario = $_SESSION['id'];
        

        if ($tipo == 'cliente') {
            $chamados = $this->model->findByCliente($id_usuario);
        } else {
            $chamados = $this->model->findAll();
        }

        require 'views/chamados/index.php';
    }

    public function create() {
        if ($_SESSION['tipo'] !== 'cliente') {
    die("Acesso restrito a clientes.");
}

        $categorias = $this->categoriaModel->findAll();
        require 'views/chamados/create.php';
    }

    public function store() {

        $this->model->save([
            
            'titulo' => $_POST['titulo'],
            'descricao' => $_POST['descricao'],
            'prioridade' => $_POST['prioridade'],
            'id_categoria' => $_POST['id_categoria'],
            'id_cliente' => $_SESSION['id']
        ]);

        header("Location: index.php?page=chamados");
    }

    public function edit() {
        if ($_SESSION['tipo'] !== 'cliente') {
    die("Acesso restrito a clientes.");
}

        $chamado = $this->model->findById($_GET['id']);
        $categorias = $this->categoriaModel->findAll();

        // Cliente só pode editar os próprios chamados
        if ($_SESSION['tipo'] == 'cliente' && $chamado['id_cliente'] != $_SESSION['id']) {
            die("Acesso negado.");
        }

        require 'views/chamados/edit.php';
    }

    public function update() {
        if ($_SESSION['tipo'] !== 'cliente') {
    die("Acesso restrito a administradores.");
}

        $chamado = $this->model->findById($_POST['id']);
        $this->model->save([
            'id' => $_POST['id'],
            'titulo' => $_POST['titulo'],
            'descricao' => $_POST['descricao'],
            'prioridade' => $_POST['prioridade'],
            'id_categoria' => $_POST['id_categoria'],
            'status' => $_POST['status']
        ]);

        header("Location: index.php?page=chamados");
    }

    // Técnico assume o chamado
    public function assumir() {
    if ($_SESSION['tipo'] !== 'tecnico') {
        die("Acesso restrito a técnicos.");
    }

    $chamado = $this->model->findById($_GET['id']);
    $categoria = new Categoria();
    $cat = $categoria->findById($chamado['id_categoria']);
    $categoria_nome = $cat['nome'] ?? '—';

    require 'views/chamados/assumir.php';
}
public function confirmar_assumir() {
    if ($_SESSION['tipo'] !== 'tecnico') {
        die("Acesso restrito a técnicos.");
    }

    $this->model->atribuirTecnico($_POST['id'], $_SESSION['id']);
    header("Location: index.php?page=chamados");
}


    public function resolver() {
    if ($_SESSION['tipo'] !== 'tecnico') {
        die("Acesso restrito a técnicos.");
    }

    $chamado = $this->model->findById($_GET['id']);
    require 'views/chamados/resolver.php';
}

public function confirmar_resolver() {
    if ($_SESSION['tipo'] !== 'tecnico') {
        die("Acesso restrito a técnicos.");
    }

    $chamado = $this->model->findById($_POST['id']);

    if ($chamado['statuss'] === 'resolvido') {
        die("Este chamado já foi resolvido.");
    }

    $this->model->resolver($_POST['id']);
    header("Location: index.php?page=chamados");
}




    public function delete() {
        $chamado = $this->model->findById($_GET['id']);
        if ($_SESSION['tipo'] == 'cliente' && $chamado['id_cliente'] != $_SESSION['id']) {
    die("Acesso negado.");
}
// admin pode excluir qualquer um, então não bloqueia

        $this->model->delete($_GET['id']);
        header("Location: index.php?page=chamados");
    }
}
