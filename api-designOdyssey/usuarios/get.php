<?php
require_once '../conexao.php';

// Verificar se é admin (simplificado)
if (!isset($_SERVER['HTTP_TOKEN']) || $_SERVER['HTTP_TOKEN'] !== 'TOKEN_ADMIN') {
    echo json_encode(['erro' => 'Acesso não autorizado']);
    exit;
}

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT id, nome, email, tipo, whatsapp FROM usuarios WHERE id = ?");
    $stmt->execute([$_GET['id']]);
} else {
    $stmt = $pdo->query("SELECT id, nome, email, tipo, whatsapp FROM usuarios");
}

echo json_encode($stmt->fetchAll());
?>