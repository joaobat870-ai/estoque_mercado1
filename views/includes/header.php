<?php
$current_page = isset($_GET['page']) ? $_GET['page'] : 'produtos';
$nome_operador = isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : 'Operador';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperStock | Gestão de Mercado</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/estoque_mercado/public/css/style.css">
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <div class="brand">
                <span class="brand-badge">SM</span>
                <div>
                    <h1>SuperMercado</h1>
                    <span class="brand-subtitle">Gestão de Estoque & Setores</span>
                </div>
            </div>
            <nav class="main-nav">
                <a href="/estoque_mercado/public/index.php?page=produtos" class="<?php echo $current_page === 'produtos' ? 'active' : ''; ?>">
                    📦 Produtos em Estoque
                </a>
                <a href="/estoque_mercado/public/index.php?page=categorias" class="<?php echo $current_page === 'categorias' ? 'active' : ''; ?>">
                    🏷️ Setores (Categorias)
                </a>
                <div class="user-menu">
                    <span class="user-greeting">👤 <?php echo htmlspecialchars($nome_operador); ?></span>
                    <a href="/estoque_mercado/public/index.php?page=logout" class="btn-logout">Sair</a>
                </div>
            </nav>
        </div>
    </header>
    <main class="main-wrapper">
        <div class="content-card">
