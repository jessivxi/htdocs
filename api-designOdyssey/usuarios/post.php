<?php
require_once '../conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

if (!empty($dados['nome']) && !empty($dados['email']) && !empty($dados['senha'])) {
    $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo, whatsapp) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([
        $dados['nome'],
        $dados['email'],
        $senhaHash,
        $dados['tipo'] ?? 'cliente',
        $dados['whatsapp'] ?? ''
    ])) {
        echo json_encode(['sucesso' => 'Usuário criado com ID: ' . $pdo->lastInsertId()]);
    } else {
        echo json_encode(['erro' => 'Erro ao criar usuário']);
    }
} else {
    echo json_encode(['erro' => 'Dados incompletos']);
}
?>