<?php
include_once __DIR__ . '/../../controllers/ProdutoController.php';

$controller = new ProdutoController();
$categorias_stmt = $controller->getCategorias();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $categoria_id = $_POST['categoria_id'];

    if ($controller->create($descricao, $preco, $estoque, $categoria_id)) {
        header('Location: /estoque_mercado/public/index.php?page=produtos');
        exit();
    } else {
        echo "<div class='alert-error'>Não foi possível cadastrar o produto.</div>";
    }
}

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="page-header">
    <div>
        <h2>Cadastrar Novo Produto</h2>
        <p class="subtitle">Adicione um novo item ao catálogo e defina seu saldo inicial</p>
    </div>
    <a href="/estoque_mercado/public/index.php?page=produtos" class="btn btn-secondary">Voltar à Lista</a>
</div>

<form action="/estoque_mercado/public/index.php?page=produtos&action=create" method="POST" class="modern-form">
    <div class="form-group">
        <label for="descricao">Descrição do Produto</label>
        <input type="text" id="descricao" name="descricao" placeholder="Ex: Arroz Branco Tipo 1 5kg" required>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="preco">Preço de Venda (R$)</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0" placeholder="0,00" required>
        </div>

        <div class="form-group">
            <label for="estoque">Quantidade em Estoque</label>
            <input type="number" id="estoque" name="estoque" step="1" min="0" placeholder="0" required>
        </div>

        <div class="form-group">
            <label for="categoria_id">Setor / Categoria</label>
            <select id="categoria_id" name="categoria_id" required>
                <option value="" disabled selected>Selecione um setor...</option>
                <?php
                while ($categoria = $categorias_stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"" . $categoria['id'] . "\">" . htmlspecialchars($categoria['nome']) . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Salvar Produto</button>
        <a href="/estoque_mercado/public/index.php?page=produtos" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
