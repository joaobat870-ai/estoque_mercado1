<?php
include_once __DIR__ . '/../../controllers/CategoriaController.php';

$controller = new CategoriaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    if ($controller->create($nome)) {
        header('Location: /estoque_mercado/public/index.php?page=categorias');
        exit();
    } else {
        echo "<div class='alert-error'>Não foi possível criar o setor.</div>";
    }
}

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="page-header">
    <div>
        <h2>Novo Setor do Mercado</h2>
        <p class="subtitle">Cadastre uma nova categoria para agrupar produtos</p>
    </div>
    <a href="/estoque_mercado/public/index.php?page=categorias" class="btn btn-secondary">Voltar à Lista</a>
</div>

<form action="/estoque_mercado/public/index.php?page=categorias&action=create" method="POST" class="modern-form">
    <div class="form-group">
        <label for="nome">Nome do Setor (Categoria)</label>
        <input type="text" id="nome" name="nome" placeholder="Ex: Bebidas, Frios e Laticínios..." required>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Salvar Setor</button>
        <a href="/estoque_mercado/public/index.php?page=categorias" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
