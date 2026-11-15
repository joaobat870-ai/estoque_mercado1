<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $nome;
    public $usuario;
    public $senha;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Valida usuário e senha no banco
    public function autenticar($usuario, $senha) {
        $query = "SELECT id, nome, usuario, senha FROM " . $this->table_name . " WHERE usuario = :usuario LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        $usuario = htmlspecialchars(strip_tags($usuario));
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verifica se a senha bate (suporta texto plano didático ou hash se usado futuramente)
            if ($senha === $row['senha'] || password_verify($senha, $row['senha'])) {
                $this->id = $row['id'];
                $this->nome = $row['nome'];
                $this->usuario = $row['usuario'];
                return true;
            }
        }
        return false;
    }
}
?>
