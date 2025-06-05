<?php
require_once '../conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

// Apenas admin principal pode deletar
if (!isset($_SERVER['HTTP_TOKEN']) || $_SERVER['HTTP_TOKEN'] !== 'TOKEN_ADMIN_PRINCIPAL') {
    echo json_encode(['erro' => 'Acesso não autorizado']);
    exit;
}

if (!empty($dados['id'])) {
    $stmt = $pdo->prepare("DELETE FROM administradores WHERE id = ?");
    if ($stmt->execute([$dados['id']])) {
        echo json_encode(['sucesso' => 'Admin deletado']);
    } else {
        echo json_encode(['erro' => 'Erro ao deletar']);
    }
} else {
    echo json_encode(['erro' => 'ID não informado']);
}
?>