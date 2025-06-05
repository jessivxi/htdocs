<?php
require_once '../conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

if (!empty($dados['id'])) {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    if ($stmt->execute([$dados['id']])) {
        echo json_encode(['sucesso' => 'Usuário deletado']);
    } else {
        echo json_encode(['erro' => 'Erro ao deletar']);
    }
} else {
    echo json_encode(['erro' => 'ID não informado']);
}
?>