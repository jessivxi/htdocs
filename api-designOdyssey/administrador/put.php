<?php
require_once '../conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

// Verifica se o token é válido

if (!empty($dados['id'])) {
    // Apenas admin principal ou o próprio admin pode atualizar
    $tokenValido = ($_SERVER['HTTP_TOKEN'] === 'TOKEN_ADMIN_PRINCIPAL') || 
                  ($_SERVER['HTTP_TOKEN'] === 'TOKEN_DO_ADMIN_' . $dados['id']);
    
    if (!$tokenValido) {
        echo json_encode(['erro' => 'Acesso não autorizado']);
        exit;
    }

    $campos = [];
    $valores = [];
    
    if (!empty($dados['nome'])) {
        $campos[] = "nome = ?";
        $valores[] = $dados['nome'];
    }
    
    if (!empty($dados['status'])) {
        $campos[] = "status = ?";
        $valores[] = $dados['status'];
    }
    
    if (!empty($campos)) {
        $valores[] = $dados['id'];
        $sql = "UPDATE administradores SET " . implode(', ', $campos) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute($valores)) {
            echo json_encode(['sucesso' => 'Admin atualizado']);
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