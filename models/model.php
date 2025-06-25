<?php
class Model {
    protected $table;

    public function findAll() {
        $sql = "SELECT * FROM $this->table";
        $stmt = Banco::getConnection()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = Banco::getConnection()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $stmt = Banco::getConnection()->prepare($sql);
        return $stmt->execute([$id]);
    }
}
