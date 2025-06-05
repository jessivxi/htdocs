<?php
require_once '../conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

if (!empty($dados['id'])) {
    $campos = [];
    $valores = [];
    
    if (!empty($dados['nome'])) {
        $campos[] = "nome = ?";
        $valores[] = $dados['nome'];
    }
    
    if (!empty($dados['whatsapp'])) {
        $campos[] = "whatsapp = ?";
        $valores[] = $dados['whatsapp'];
    }
    
    if (!empty($campos)) {
        $valores[] = $dados['id'];
        $sql = "UPDATE usuarios SET " . implode(', ', $campos) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute($valores)) {
            echo json_encode(['sucesso' => 'Usuário atualizado']);
        } else {
            echo json_encode(['erro' => 'Erro ao atualizar']);
        }
    } else {
        echo json_encode(['erro' => 'Nada para atualizar']);
    }
} else {
    echo json_encode(['erro' => 'ID não informado']);
}
?>