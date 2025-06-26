<?php
class Categoria extends Model {
    protected $table = "categorias";

    public function findAll() {
        $sql = "SELECT * FROM categorias ORDER BY nome";
        return Banco::getConnection()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = Banco::getConnection()->prepare("SELECT * FROM categorias WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save($data) {
        if (isset($data['id'])) {
            $sql = "UPDATE categorias SET nome = ? WHERE id = ?";
            $params = [$data['nome'], $data['id']];
        } else {
            $sql = "INSERT INTO categorias (nome) VALUES (?)";
            $params = [$data['nome']];
        }

        $stmt = Banco::getConnection()->prepare($sql);
        $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = Banco::getConnection()->prepare("DELETE FROM categorias WHERE id = ?");
        $stmt->execute([$id]);
    }
}
