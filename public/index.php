<?php
session_start();

$page = isset($_GET["page"]) ? $_GET["page"] : "produtos";
$action = isset($_GET["action"]) ? $_GET["action"] : "index";
$id = isset($_GET["id"]) ? $_GET["id"] : null;

// Rota de Logout
if ($page === "logout") {
    include_once __DIR__ . '/../controllers/AuthController.php';
    $auth = new AuthController();
    $auth->logout();
    header("Location: /estoque_mercado/public/index.php?page=login");
    exit();
}

// Verifica se o usuário está logado (se não estiver, força a página de login)
if (!isset($_SESSION['usuario_id']) && $page !== "login") {
    header("Location: /estoque_mercado/public/index.php?page=login");
    exit();
}

// Se já estiver logado e tentar acessar a tela de login, manda para produtos
if (isset($_SESSION['usuario_id']) && $page === "login") {
    header("Location: /estoque_mercado/public/index.php?page=produtos");
    exit();
}

switch ($page) {
    case "login":
        include __DIR__ . '/../views/auth/login.php';
        break;
    case "produtos":
        switch ($action) {
            case "index":
                include __DIR__ . '/../views/produtos/index_prod.php';
                break;
            case "create":
                include __DIR__ . '/../views/produtos/create_prod.php';
                break;
            case "edit":
                include __DIR__ . '/../views/produtos/edit_prod.php';
                break;
            case "delete":
                include_once __DIR__ . '/../controllers/ProdutoController.php';
                $controller = new ProdutoController();
                if ($controller->delete($id)) {
                    header("Location: /estoque_mercado/public/index.php?page=produtos");
                    exit();
                } else {
                    echo "<p class='alert-error'>Não foi possível deletar o produto.</p>";
                }
                break;
            default:
                include __DIR__ . '/../views/produtos/index_prod.php';
                break;
        }
        break;
    case "categorias":
        switch ($action) {
            case "index":
                include __DIR__ . '/../views/categorias/index_cat.php';
                break;
            case "create":
                include __DIR__ . '/../views/categorias/create_cat.php';
                break;
            case "edit":
                include __DIR__ . '/../views/categorias/edit_cat.php';
                break;
            case "delete":
                include_once __DIR__ . '/../controllers/CategoriaController.php';
                $controller = new CategoriaController();
                if ($controller->delete($id)) {
                    header("Location: /estoque_mercado/public/index.php?page=categorias");
                    exit();
                } else {
                    echo "<p class='alert-error'>Não foi possível deletar a categoria.</p>";
                }
                break;
            default:
                include __DIR__ . '/../views/categorias/index_cat.php';
                break;
        }
        break;
    default:
        include __DIR__ . '/../views/produtos/index_prod.php';
        break;
}
?>
