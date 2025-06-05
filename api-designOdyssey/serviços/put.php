<?php

//atulizar um serviço
require_once '../conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

if (!empty($dados['id'])) {
    $stmt = $pdo->prepare("UPDATE servicos SET titulo = ?, descricao = ?, categoria = ?, preco_base = ? WHERE id = ?");
    if ($stmt->execute([$dados['titulo'], $dados['descricao'], $dados['categoria'], $dados['preco_base'], $dados['id']])) {
        echo json_encode(['sucesso' => 'Serviço atualizado']);
    } else {
        echo json_encode(['erro' => 'Erro ao atualizar']);
    }
} else {
    echo json_encode(['erro' => 'ID não informado']);
}
?>