<?php

require_once 'conexao.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$rota = $_GET['rota'] ?? '';
// Verificação simplificada de autenticação

switch ("$metodo:$rota") {
case 'POST:login-admin':
    require 'auth/login-admin.php';
    break;

case 'GET:admin':
    require 'admin/listar.php';
    break;
    
case 'POST:admin':
    require 'admin/criar.php';
    break;
    
case 'PUT:admin':
    require 'admin/atualizar.php';
    break;
    
case 'DELETE:admin':
    require 'admin/deletar.php';
    break;

    default:
        echo json_encode(['erro' => 'Rota não encontrada']);
        http_response_code(404);
}

