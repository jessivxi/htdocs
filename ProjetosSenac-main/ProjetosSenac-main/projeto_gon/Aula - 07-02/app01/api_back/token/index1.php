<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];
include("../connection/connection.php");

$result = "";

if ($method == "GET") {
  //echo "GET";
  $result = ["status" => "fail", "error" => "Método não suportado!"];
  http_response_code(200);
  echo json_encode($result);


}
if ($method == "POST") {

  // recupera dados do corpo (body) de uma requisão POST
  $dados = file_get_contents("php://input");

  // decodifica JSON, sem opção TRUE
  $dados = json_decode($dados); // isso retorna um OBJETO

  try {
    if (!isset($dados->email) || empty($dados->email)) {
      // está vazio  : ERRO
      throw new ErrorException("Email inválido ou auxente", 1);
    }

    if (!isset($dados->cpf) || empty($dados->cpf)) {
      // está vazio  : ERRO
      throw new ErrorException("CPF inválido ou auxente", 1);
    }

    if (!filter_var($dados->email, FILTER_VALIDATE_EMAIL)) {
      throw new ErrorException("Formato de e-mail inválido", 1);
    }

    // função trim retira espaços que estão sobrando
    $email = trim($dados->email); // acessa valor de um OBJETO
    $cpf = trim($dados->cpf); // acessa valor de um OBJETO

    // consulta para verificar se dados (Email ou CPF), já estão cadastrados
    $sql = "SELECT pk_id, email, cpf
                    FROM token
                    WHERE email=:email OR cpf=:cpf";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":cpf", $cpf);
    $stmt->execute();

    $dado = $stmt->fetch(PDO::FETCH_OBJ);

    //se não encontrar correspondencia no banco de dados $dado retorna false
    // e é criado um novo token, caso contrátios levanta uma excessão
    if ($dado) {
      // está preenchido  : ERRO
      throw new ErrorException("Email ou CPF já cadastrado", 1);
    }

    // criar string base para o token
    $token_base = $email . $cpf . date('d/m/Y - H:i:s');

    $token = hash("sha256", $token_base);
    $token = substr($token, -10, 10) . substr($token, 0, 10);

    $sql = "INSERT INTO token(email, cpf, token, data_criacao)
                    VALUES (:email, :cpf, :token, now())";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":cpf", $cpf);
    $stmt->bindParam(":token", $token);
    $stmt->execute();

    $result = [];
    $result['status'] = "success";
    $result['token'] = [
      "email" => $email,
      "cpf" => $cpf,
      "token" => $token
    ];
    http_response_code(200);

  } catch (PDOException $ex) {
    $result = ["status" => "fail", "error" => $ex->getMEssage()];
    http_response_code(200);
  } catch (Exception $ex) {
    $result = ["status" => "fail", "error" => $ex->getMEssage()];
    http_response_code(200);
  } finally {
    $conn = null;
    echo json_encode($result);
  }



}
if ($method == "PUT") {
  // recupera dados do corpo (body) de uma requisão POST
  $result = ["status" => "fail", "error" => "Método não suportado!"];
  http_response_code(200);
  echo json_encode($result);

}
if ($method == "DELETE") {
  $result = ["status" => "fail", "error" => "Método não suportado!"];
  http_response_code(200);
  echo json_encode($result);

}







?>
