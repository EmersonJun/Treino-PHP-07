<?php
class Chamado extends Model {
    protected $table = "chamados";

    public function save($data) {
        $conn = Banco::getConnection();

        if (isset($data['id'])) {
            $sql = "UPDATE chamados SET 
                        titulo = ?, 
                        descricao = ?, 
                        prioridade = ?, 
                        statuss = ?, 
                        arquivo = ?, 
                        id_categoria = ? 
                    WHERE id = ?";
            $params = [
                $data['titulo'],
                $data['descricao'],
                $data['prioridade'],
                $data['statuss'],
                $data['arquivo'] ?? null,
                $data['id_categoria'],
                $data['id']
            ];
        } else {
            $sql = "INSERT INTO chamados 
                    (titulo, descricao, prioridade, statuss, arquivo, id_cliente, id_categoria)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $params = [
                $data['titulo'],
                $data['descricao'],
                $data['prioridade'],
                $data['statuss'],
                $data['arquivo'] ?? null,
                $data['id_cliente'],
                $data['id_categoria']
            ];
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
    }

    public function findByCliente($id_cliente) {
    $sql = "SELECT c.*, 
                   t.nome AS tecnico_nome,
                   cat.nome AS categoria_nome 
            FROM chamados c
            LEFT JOIN usuarios t ON t.id = c.id_tecnico
            JOIN categorias cat ON cat.id = c.id_categoria
            WHERE c.id_cliente = ?
            ORDER BY c.id DESC";
    $stmt = Banco::getConnection()->prepare($sql);
    $stmt->execute([$id_cliente]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



    public function atribuirTecnico($id_chamado, $id_tecnico) {
        $sql = "UPDATE chamados 
                SET id_tecnico = ?, statuss = 'em_andamento' 
                WHERE id = ?";
        $stmt = Banco::getConnection()->prepare($sql);
        $stmt->execute([$id_tecnico, $id_chamado]);
    }

    public function resolver($id_chamado) {
        $sql = "UPDATE chamados 
                SET statuss = 'resolvido', data_fechamento = NOW() 
                WHERE id = ?";
        $stmt = Banco::getConnection()->prepare($sql);
        $stmt->execute([$id_chamado]);
    }

    public function findById($id) {
        $sql = "SELECT * FROM chamados WHERE id = ?";
        $stmt = Banco::getConnection()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = Banco::getConnection()->prepare("DELETE FROM chamados WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function findAll() {
    $sql = "SELECT c.*, 
                   u.nome AS cliente_nome, 
                   t.nome AS tecnico_nome,
                   cat.nome AS categoria_nome
            FROM chamados c
            JOIN usuarios u ON u.id = c.id_cliente
            LEFT JOIN usuarios t ON t.id = c.id_tecnico
            JOIN categorias cat ON cat.id = c.id_categoria
            ORDER BY c.id DESC";
    return Banco::getConnection()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

}

