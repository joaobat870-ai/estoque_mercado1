<?php
include_once __DIR__ . '/../../controllers/AuthController.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

    $auth = new AuthController();
    if ($auth->login($usuario, $senha)) {
        header("Location: /estoque_mercado/public/index.php?page=produtos");
        exit();
    } else {
        $erro = "Usuário ou senha inválidos. Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SuperMercado Gestão de Estoque</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/estoque_mercado/public/css/style.css">
</head>
<body class="login-body">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <span class="brand-badge login-badge">SM</span>
                <h1>SuperMercado</h1>
                <p>Acesso Restrito ao Controle de Estoque</p>
            </div>

            <?php if (!empty($erro)): ?>
                <div class="alert-error"><?php echo htmlspecialchars($erro); ?></div>
            <?php endif; ?>

            <form action="/estoque_mercado/public/index.php?page=login" method="POST" class="modern-form">
                <div class="form-group">
                    <label for="usuario">Usuário</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Digite seu usuário (ex: admin)" required autofocus>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Entrar no Sistema</button>
            </form>

            <div class="login-hint">
                <span>Acesso padrão: <strong>admin</strong> / Senha: <strong>123456</strong></span>
            </div>
        </div>
    </div>
</body>
</html>
