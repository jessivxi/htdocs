<?php
require_once '../conexao.php';

//listar administradores

// Apenas admin principal pode listar
if (!isset($_SERVER['HTTP_TOKEN']) || $_SERVER['HTTP_TOKEN'] !== 'TOKEN_ADMIN_PRINCIPAL') {
    echo json_encode(['erro' => 'Acesso não autorizado']);
    exit;
}

$stmt = $pdo->query("SELECT id, nome, email, nivel_acesso, status FROM administradores");
echo json_encode($stmt->fetchAll());
?>