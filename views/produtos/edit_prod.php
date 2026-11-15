<?php
include_once __DIR__ . '/../../controllers/ProdutoController.php';

$controller = new ProdutoController();

$id = isset($_GET['id']) ? $_GET['id'] : die('ID do produto não fornecido.');

$produto = $controller->readOne($id);
$categorias_stmt = $controller->getCategorias();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $categoria_id = $_POST['categoria_id'];

    if ($controller->update($id, $descricao, $preco, $estoque, $categoria_id)) {
        header('Location: /estoque_mercado/public/index.php?page=produtos');
        exit();
    } else {
        echo "<div class='alert-error'>Não foi possível atualizar o produto.</div>";
    }
}

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="page-header">
    <div>
        <h2>Editar Produto #<?php echo str_pad($id, 3, '0', STR_PAD_LEFT); ?></h2>
        <p class="subtitle">Atualize preço, quantidade em estoque ou setor do item</p>
    </div>
    <a href="/estoque_mercado/public/index.php?page=produtos" class="btn btn-secondary">Voltar à Lista</a>
</div>

<form action="/estoque_mercado/public/index.php?page=produtos&action=edit&id=<?php echo $id; ?>" method="POST" class="modern-form">
    <div class="form-group">
        <label for="descricao">Descrição do Produto</label>
        <input type="text" id="descricao" name="descricao" value="<?php echo htmlspecialchars($produto->descricao, ENT_QUOTES); ?>" required>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="preco">Preço de Venda (R$)</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0" value="<?php echo htmlspecialchars($produto->preco, ENT_QUOTES); ?>" required>
        </div>

        <div class="form-group">
            <label for="estoque">Quantidade em Estoque</label>
            <input type="number" id="estoque" name="estoque" step="1" min="0" value="<?php echo htmlspecialchars($produto->estoque, ENT_QUOTES); ?>" required>
        </div>

        <div class="form-group">
            <label for="categoria_id">Setor / Categoria</label>
            <select id="categoria_id" name="categoria_id" required>
                <?php
                while ($categoria = $categorias_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($categoria['id'] == $produto->categoria_id) ? 'selected' : '';
                    echo "<option value=\"" . $categoria['id'] . "\" {$selected}>" . htmlspecialchars($categoria['nome']) . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="/estoque_mercado/public/index.php?page=produtos" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
