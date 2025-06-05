<?php

//listar serviços
require_once '../conexao.php';

// Listar todos ou um específico
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM servicos WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $resultado = $stmt->fetch();
} else {
    $stmt = $pdo->query("SELECT * FROM servicos");
    $resultado = $stmt->fetchAll();
}

echo json_encode($resultado);
?>