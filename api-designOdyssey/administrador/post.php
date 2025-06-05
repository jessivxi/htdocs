<?php
require_once '../conexao.php';

//criar um novo administrador
$dados = json_decode(file_get_contents('php://input'), true);

if (!empty($dados['nome']) && !empty($dados['email']) && !empty($dados['senha'])) {
    // Verifique se é um admin tentando criar outro admin
    if (!isset($_SERVER['HTTP_TOKEN']) || $_SERVER['HTTP_TOKEN'] !== 'TOKEN_ADMIN_PRINCIPAL') {
        echo json_encode(['erro' => 'Acesso não autorizado']);
        exit;
    }

    $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO administradores (nome, email, senha, nivel_acesso) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([
        $dados['nome'],
        $dados['email'],
        $senhaHash,
        $dados['nivel_acesso'] ?? 'suporte'
    ])) {
        echo json_encode(['sucesso' => 'Admin criado com ID: ' . $pdo->lastInsertId()]);
    } else {
        echo json_encode(['erro' => 'Erro ao criar admin']);
    }
} else {
    echo json_encode(['erro' => 'Dados incompletos']);
}
?>