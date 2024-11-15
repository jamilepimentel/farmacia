<?php

include '../includes/conexao.php';
$stmt = $pdo->query("SELECT * FROM medicamentos ORDER BY nome");
$medicamentos = $stmt->fetchAll();
?>
<table id="medicamentos" class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Categoria</th>
            <th>Validade</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($medicamentos as $med): ?>
        <tr>
            <td><?= $med['nome'] ?></td>
            <td>R$ <?= number_format($med['preco'], 2) ?></td>
            <td><?= $med['quantidade'] ?></td>
            <td><?= $med['categoria'] ?></td>
            <td><?= date('d/m/Y', strtotime($med['validade'])) ?></td>
        </tr>

        <?php endforeach; ?>
        
    </tbody>
</table>