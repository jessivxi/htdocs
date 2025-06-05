<?php
// Configurações do banco
$host = 'localhost';
$db   = 'design_odyssey';
$user = 'root';
$pass = '';

// Cria a conexão
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>