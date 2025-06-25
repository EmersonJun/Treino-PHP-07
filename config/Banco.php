<?php
class Banco {
    private static $instance;

    public static function getConnection() {
        if (!self::$instance) {
            try {
                self::$instance = new PDO("mysql:host=localhost;port=3307;dbname=chamados_tecnicos;charset=utf8mb4", "root", "");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
?>
