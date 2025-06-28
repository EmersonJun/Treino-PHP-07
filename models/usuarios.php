<?php 
class Usuario extends Model {
    protected $table = "usuarios";
    private $db;
    public function construct() {
        $this->db = Banco::getConnection();
    }
    public function cadastrar($nome, $email, $senha, $tipo) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $email, $hash, $tipo]);
    }
    public function autenticar($email, $senha) {
    $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        return $usuario;
    }

    return false;
    }
}
?>