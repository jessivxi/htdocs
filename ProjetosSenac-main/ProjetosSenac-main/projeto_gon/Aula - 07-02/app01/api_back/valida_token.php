<?php

if(!isset($_SERVER['HTTP_ACCESSTOKEN']) || empty($_SERVER['HTTP_ACCESSTOKEN'])){
        
  $result =["status"=> "fail", "error" => "Token Error"];
  echo json_encode($result);
  exit;
}

$acces_token = $_SERVER['HTTP_ACCESSTOKEN'];

// consulta para verificar se dados (Email ou CPF), já estão cadastrados
$sql= "SELECT pk_id, email, cpf, token 
      FROM token
      WHERE token=:token";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":token", $acces_token);
$stmt->execute();

$dado = $stmt->fetch(PDO::FETCH_OBJ);

if (!$dado){
  // está vazio  : ERRO
  $result =["status"=> "fail", "error" => "Token Error: Invalid"];
  echo json_encode($result);
  exit;
}

?>