<?php
require_once '../conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

if (!empty($dados['email']) && !empty($dados['senha'])) {
    $stmt = $pdo->prepare("SELECT id, nome, email, senha, nivel_acesso FROM administradores WHERE email = ? AND status = 'ativo'");
    $stmt->execute([$dados['email']]);
    $admin = $stmt->fetch();
    
    if ($admin && password_verify($dados['senha'], $admin['senha'])) {
        // Token simplificado (em produção use JWT)
        $token = 'TOKEN_DO_ADMIN_' . $admin['id'];
        if ($admin['nivel_acesso'] === 'admin') {
            $token = 'TOKEN_ADMIN_PRINCIPAL';
        }
        
        echo json_encode([
            'sucesso' => 'Login realizado',
            'token' => $token,
            'admin' => [
                'id' => $admin['id'],
                'nome' => $admin['nome'],
                'nivel' => $admin['nivel_acesso']
            ]
        ]);
    } else {
        echo json_encode(['erro' => 'Credenciais inválidas ou conta inativa']);
    }
} else {
    echo json_encode(['erro' => 'Dados incompletos']);
}
?>