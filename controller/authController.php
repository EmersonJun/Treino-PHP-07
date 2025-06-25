<?php
class AuthController {
    public function index() {
        include 'views/auth/Login.php';
    }

    public function login() {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $conn = Banco::getConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['logado'] = true; // <<< ESSENCIAL PARA OUTRAS PÁGINAS
            $_SESSION['id'] = $user['id'];
            header('Location: index.php?page=projetos');
            } else {
            $erro = "Usuário ou senha inválidos.";
            include 'views/auth/Login.php';
        
            }
        }

    public function logout() {
        session_destroy();
        header('Location: index.php?page=login');
    }

    public function showRegister() {
        include 'views/auth/Register.php';
    }

    public function register() {
        $usuario = $_POST['usuario'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $tipo = $_POST['tipo'] ?? '';

        if (empty($usuario) || empty($senha) || empty($email) || empty($tipo)) {
            $erro = "Todos os campos são obrigatórios.";
            include 'views/auth/Register.php';
            return;
        }

        $conn = Banco::getConnection();

        // Verificar se usuário já existe
        $verifica = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $verifica->execute([$email]);
        if ($verifica->rowCount() > 0) {
            $erro = "Usuário já existe.";
            include 'views/auth/Register.php';
            return;
        }

        // Inserção segura
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt->execute([$usuario, $email, $senhaHash, $tipo]);

        $sucesso = "Cadastro realizado com sucesso. Faça login.";
        include 'views/auth/Login.php';
    }
}
