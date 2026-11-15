<?php
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/Produto.php';
include_once __DIR__ . '/../models/Categoria.php';

class ProdutoController {
    private $conn;
    private $produto;
    private $categoria;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->produto = new Produto($this->conn);
        $this->categoria = new Categoria($this->conn);
    }

    public function index() {
        $stmt = $this->produto->read();
        $num = $stmt->rowCount();
        return ['stmt' => $stmt, 'num' => $num];
    }

    public function create($descricao, $preco, $estoque, $categoria_id) {
        $this->produto->descricao = $descricao;
        $this->produto->preco = $preco;
        $this->produto->estoque = $estoque;
        $this->produto->categoria_id = $categoria_id;
        if($this->produto->create()) {
            return true;
        }
        return false;
    }

    public function readOne($id) {
        $this->produto->id = $id;
        $this->produto->readOne();
        return $this->produto;
    }

    public function update($id, $descricao, $preco, $estoque, $categoria_id) {
        $this->produto->id = $id;
        $this->produto->descricao = $descricao;
        $this->produto->preco = $preco;
        $this->produto->estoque = $estoque;
        $this->produto->categoria_id = $categoria_id;
        if($this->produto->update()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $this->produto->id = $id;
        if($this->produto->delete()) {
            return true;
        }
        return false;
    }

    public function getCategorias() {
        $stmt = $this->categoria->read();
        return $stmt;
    }
}
?>
