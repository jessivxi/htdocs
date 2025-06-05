<?php
require_once 'conexao.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$rota = $_GET['rota'] ?? '';

// Rotas públicas
if ($metodo === 'POST' && $rota === 'login') {
    require 'auth/login.php';
    exit;
}

// Verificação simplificada de autenticação
if (!isset($_SERVER['HTTP_TOKEN'])) {
    echo json_encode(['erro' => 'Token não fornecido']);
    http_response_code(401);
    exit;
}

// Rotas protegidas
switch ("$metodo:$rota") {
      
    // Usuários
    case 'GET:usuarios':
        require 'usuarios/listar.php';
        break;
    case 'POST:usuarios':
        require 'usuarios/criar.php';
        break;
    case 'PUT:usuarios':
        require 'usuarios/atualizar.php';
        break;
    case 'DELETE:usuarios':
        require 'usuarios/deletar.php';
        break;
        
    default:
        echo json_encode(['erro' => 'Rota não encontrada']);
        http_response_code(404);
}
?>