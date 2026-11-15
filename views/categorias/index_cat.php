<?php
include_once __DIR__ . '/../../controllers/CategoriaController.php';

$controller = new CategoriaController();
$data = $controller->index();
$stmt = $data['stmt'];
$num = $data['num'];

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="page-header">
    <div>
        <h2>Setores do Mercado</h2>
        <p class="subtitle">Gerencie os departamentos de classificação dos produtos</p>
    </div>
    <a href="/estoque_mercado/public/index.php?page=categorias&action=create" class="btn btn-primary">+ Novo Setor</a>
</div>

<?php if($num > 0): ?>
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome do Setor / Categoria</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): 
                extract($row);
            ?>
                <tr>
                    <td class="col-id">#<?php echo str_pad($id, 2, '0', STR_PAD_LEFT); ?></td>
                    <td class="col-desc"><span class="badge badge-category"><?php echo htmlspecialchars($nome); ?></span></td>
                    <td class="col-actions">
                        <a href="/estoque_mercado/public/index.php?page=categorias&action=edit&id=<?php echo $id; ?>" class="btn btn-sm btn-edit">Editar</a>
                        <a href="/estoque_mercado/public/index.php?page=categorias&action=delete&id=<?php echo $id; ?>" class="btn btn-sm btn-delete" onclick="return confirm('Atenção: Excluir um setor apagará também os produtos vinculados a ele. Continuar?');">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="empty-state">
        <p>Nenhum setor cadastrado.</p>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
