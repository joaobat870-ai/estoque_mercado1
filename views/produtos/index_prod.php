<?php
include_once __DIR__ . '/../../controllers/ProdutoController.php';

$controller = new ProdutoController();
$data = $controller->index();
$stmt = $data['stmt'];
$num = $data['num'];

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_itens = count($produtos);
$total_unidades = 0;
$valor_inventario = 0;

foreach ($produtos as $p) {
    $total_unidades += (int)$p['estoque'];
    $valor_inventario += ((float)$p['preco'] * (int)$p['estoque']);
}

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="summary-grid">
    <div class="stat-card">
        <span class="stat-label">Mix de Produtos</span>
        <strong class="stat-value"><?php echo $total_itens; ?> SKUs</strong>
    </div>
    <div class="stat-card">
        <span class="stat-label">Volume Total em Loja</span>
        <strong class="stat-value"><?php echo $total_unidades; ?> un./kg</strong>
    </div>
    <div class="stat-card highlight">
        <span class="stat-label">Valor Estimado em Estoque</span>
        <strong class="stat-value">R$ <?php echo number_format($valor_inventario, 2, ',', '.'); ?></strong>
    </div>
</div>

<div class="page-header">
    <div>
        <h2>Inventário de Produtos</h2>
        <p class="subtitle">Controle de preços, saldos de estoque e setores do mercado</p>
    </div>
    <a href="/estoque_mercado/public/index.php?page=produtos&action=create" class="btn btn-primary">+ Novo Produto</a>
</div>

<?php if($num > 0): ?>
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição do Produto</th>
                    <th>Setor</th>
                    <th>Preço Unit.</th>
                    <th>Saldo em Estoque</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($produtos as $row): 
                extract($row);
                $badge_stock = ($estoque <= 20) ? 'badge-warning' : 'badge-success';
                $status_text = ($estoque <= 20) ? 'Reposição (' . $estoque . ')' : $estoque . ' disp.';
            ?>
                <tr>
                    <td class="col-id">#<?php echo str_pad($id, 3, '0', STR_PAD_LEFT); ?></td>
                    <td class="col-desc"><strong><?php echo htmlspecialchars($descricao); ?></strong></td>
                    <td><span class="badge badge-category"><?php echo htmlspecialchars($categoria_nome); ?></span></td>
                    <td class="col-price">R$ <?php echo number_format($preco, 2, ',', '.'); ?></td>
                    <td><span class="badge <?php echo $badge_stock; ?>"><?php echo $status_text; ?></span></td>
                    <td class="col-actions">
                        <a href="/estoque_mercado/public/index.php?page=produtos&action=edit&id=<?php echo $id; ?>" class="btn btn-sm btn-edit">Editar</a>
                        <a href="/estoque_mercado/public/index.php?page=produtos&action=delete&id=<?php echo $id; ?>" class="btn btn-sm btn-delete" onclick="return confirm('Tem certeza que deseja remover este item do estoque?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="empty-state">
        <p>Nenhum produto cadastrado no estoque no momento.</p>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
