<?php
require_once 'conexao.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$rota = $_GET['rota'] ?? '';

switch ("$metodo:$rota") {
    case 'GET:servicos':
        require 'servicos/listar.php';
        break;
        
    case 'POST:servicos':
        require 'servicos/criar.php';
        break;
        
    case 'PUT:servicos':
        require 'servicos/atualizar.php';
        break;
        
    case 'DELETE:servicos':
        require 'servicos/deletar.php';
        break;
        
    default:
        echo json_encode(['erro' => 'Rota não encontrada']);
        http_response_code(404);
}
?>