<?php
require_once '../conexao.php';

// Criar um novo serviço
$dados = json_decode(file_get_contents('php://input'), true);

if (!empty($dados['titulo']) && !empty($dados['descricao'])) {
    $stmt = $pdo->prepare("INSERT INTO servicos (titulo, descricao, categoria, preco_base) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$dados['titulo'], $dados['descricao'], $dados['categoria'], $dados['preco_base']])) {
        echo json_encode(['sucesso' => 'Serviço criado com ID: ' . $pdo->lastInsertId()]);
    } else {
        echo json_encode(['erro' => 'Erro ao criar serviço']);
    }
} else {
    echo json_encode(['erro' => 'Dados incompletos']);
}
?>