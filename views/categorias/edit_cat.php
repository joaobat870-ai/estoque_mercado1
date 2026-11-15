<?php
include_once __DIR__ . '/../../controllers/CategoriaController.php';

$controller = new CategoriaController();

$id = isset($_GET['id']) ? $_GET['id'] : die('ID da categoria não fornecido.');

$categoria = $controller->readOne($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    if ($controller->update($id, $nome)) {
        header('Location: /estoque_mercado/public/index.php?page=categorias');
        exit();
    } else {
        echo "<div class='alert-error'>Não foi possível atualizar o setor.</div>";
    }
}

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="page-header">
    <div>
        <h2>Editar Setor #<?php echo str_pad($id, 2, '0', STR_PAD_LEFT); ?></h2>
        <p class="subtitle">Altere a nomenclatura do departamento selecionado</p>
    </div>
    <a href="/estoque_mercado/public/index.php?page=categorias" class="btn btn-secondary">Voltar à Lista</a>
</div>

<form action="/estoque_mercado/public/index.php?page=categorias&action=edit&id=<?php echo $id; ?>" method="POST" class="modern-form">
    <div class="form-group">
        <label for="nome">Nome do Setor (Categoria)</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($categoria->nome, ENT_QUOTES); ?>" required>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="/estoque_mercado/public/index.php?page=categorias" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
