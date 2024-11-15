<?php

include '../includes/conexao.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medicamento_id = $_POST['medicamento_id'];
    $quantidade = $_POST['quantidade'];

    $stmt = $pdo->prepare("SELECT quantidade FROM medicamentos WHERE id = ?");
    $stmt->execute([$medicamento_id]);
    $med = $stmt->fetch();

    if ($med['quantidade'] >= $quantidade) {
        $stmt = $pdo->prepare("UPDATE medicamentos SET quantidade = quantidade - ? WHERE id = ?");
        $stmt->execute([$quantidade, $medicamento_id]);

        $stmt = $pdo->prepare("INSERT INTO vendas (medicamento_id, quantidade, total) VALUES (?, ?, ?)");
        $stmt->execute([$medicamento_id, $quantidade, $quantidade * $med['preco']]);
    } else {
        echo "Estoque insuficiente!";
    }
}

?>