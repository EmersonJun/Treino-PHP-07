<?php
class Chamado extends Model {
    protected $table = "chamados";

    public function save($data) {
        if (isset($data['id'])) {
            $sql = "UPDATE chamados SET titulo = ?, descricao = ?, prioridade = ?, statuss = ?, arquivo = ?, id_cliente = ?, id_tecnico = ?, id_categoria = ? WHERE id = ?";
            $params = [$data['titulo'], $data['descricao'], $data['prioridade'], $data['statuss'], $data['arquivo'], $data['id_cliente'], $data['id_tecnico'], $data['id_categoria']];
        } else {
            $sql = "INSERT INTO chamados (titulo, descricao, prioridade, statuss, arquivo, id_cliente, id_tecnico, id_categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $params = [$data['titulo'], $data['descricao'], $data['prioridade'], $data['statuss'], $data['arquivo'], $data['id_cliente'], $data['id_tecnico'], $data['id_categoria']];
        }
        $stmt = Banco::getConnection()->prepare($sql);
        $stmt->execute($params);
    }
}
