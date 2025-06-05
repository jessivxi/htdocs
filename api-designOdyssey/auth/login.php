<?php
require_once '../conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

if (!empty($dados['email']) && !empty($dados['senha'])) {
    $stmt = $pdo->prepare("SELECT id, nome, email, senha, tipo FROM usuarios WHERE email = ?");
    $stmt->execute([$dados['email']]);
    $usuario = $stmt->fetch();
    
    if ($usuario && password_verify($dados['senha'], $usuario['senha'])) {
        // Token simplificado (em produção use JWT)
        $token = base64_encode($usuario['email'] . ':' . $usuario['id']);
        echo json_encode([
            'sucesso' => 'Login realizado',
            'token' => $token,
            'usuario' => [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'tipo' => $usuario['tipo']
            ]
        ]);
    } else {
        echo json_encode(['erro' => 'Credenciais inválidas']);
    }
} else {
    echo json_encode(['erro' => 'Dados incompletos']);
}
?>