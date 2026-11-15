<?php
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private $conn;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->usuario = new Usuario($this->conn);
    }

    public function login($user, $pass) {
        if ($this->usuario->autenticar($user, $pass)) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['usuario_id'] = $this->usuario->id;
            $_SESSION['usuario_nome'] = $this->usuario->nome;
            $_SESSION['usuario_login'] = $this->usuario->usuario;
            return true;
        }
        return false;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
    }
}
?>
