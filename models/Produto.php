<?php
class Produto {
    private $conn;
    private $table_name = "produtos";

    public $id;
    public $descricao;
    public $preco;
    public $estoque;
    public $categoria_id;
    public $categoria_nome;

    public function __construct($db){
        $this->conn = $db;
    }

    // Usado para ler produtos do estoque
    function read(){
        $query = "SELECT
                    c.nome as categoria_nome, p.id, p.descricao, p.preco, p.estoque, p.categoria_id
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        categorias c
                            ON p.categoria_id = c.id
                ORDER BY
                    p.descricao ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Usado para criar produto
    function create(){
        $query = "INSERT INTO " . $this->table_name . " SET descricao=:descricao, preco=:preco, estoque=:estoque, categoria_id=:categoria_id";
        $stmt = $this->conn->prepare($query);

        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->preco = htmlspecialchars(strip_tags($this->preco));
        $this->estoque = htmlspecialchars(strip_tags($this->estoque));
        $this->categoria_id = htmlspecialchars(strip_tags($this->categoria_id));

        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":estoque", $this->estoque);
        $stmt->bindParam(":categoria_id", $this->categoria_id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Usado para ler um único produto
    function readOne(){
        $query = "SELECT
                    c.nome as categoria_nome, p.id, p.descricao, p.preco, p.estoque, p.categoria_id
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        categorias c
                            ON p.categoria_id = c.id
                WHERE
                    p.id = ?
                LIMIT
                    0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->descricao = $row["descricao"];
        $this->preco = $row["preco"];
        $this->estoque = $row["estoque"];
        $this->categoria_id = $row["categoria_id"];
        $this->categoria_nome = $row["categoria_nome"];
    }

    // Usado para atualizar o produto
    function update(){
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    descricao = :descricao,
                    preco = :preco,
                    estoque = :estoque,
                    categoria_id = :categoria_id
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($query);

        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->preco = htmlspecialchars(strip_tags($this->preco));
        $this->estoque = htmlspecialchars(strip_tags($this->estoque));
        $this->categoria_id = htmlspecialchars(strip_tags($this->categoria_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":estoque", $this->estoque);
        $stmt->bindParam(":categoria_id", $this->categoria_id);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Usado para deletar o produto
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>
