<?php
require_once '../conexao.php';
//deletar um serviço
$dados = json_decode(file_get_contents('php://input'), true);

if (!empty($dados['id'])) {
    $stmt = $pdo->prepare("DELETE FROM servicos WHERE id = ?");
    if ($stmt->execute([$dados['id']])) {
        echo json_encode(['sucesso' => 'Serviço deletado']);
    } else {
        echo json_encode(['erro' => 'Erro ao deletar']);
    }
} else {
    echo json_encode(['erro' => 'ID não informado']);
}
?>