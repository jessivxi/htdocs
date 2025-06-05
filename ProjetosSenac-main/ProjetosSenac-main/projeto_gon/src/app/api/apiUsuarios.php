<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];
include("connection.php");

if ($method == "GET") {
  if (isset($_GET["id_usuario"]) && isset($_GET["id_usuario"]) > 0) {
    try {
      $sql = "SELECT email, senha, nivel FROM usuarios WHERE id_usuario=:id_usuario";

      $id_local = $_GET["id_usuario"];
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":id_usuario", $id_usuario);
      $stmt->execute();

      $dados = $stmt->fetchall(PDO::FETCH_OBJ);

      $result["result"] = $dados;
      $result["status"] = "success";

      http_response_code(200);
    } catch (PDOException $ex) {
      // echo "error: ". $ex->getMEssage();
      $result = ["status" => "fail", "error" => $ex->getMEssage()];
      http_response_code(200);
    } finally {
      $conn = null;
      echo json_encode($result);
    }
  } elseif (!isset($_GET["id_usuario"])) {
    try {
      $sql = "SELECT * FROM `usuarios`";

      $stmt = $conn->prepare($sql);
      $stmt->execute();

      $dados = $stmt->fetchall(PDO::FETCH_OBJ);

      $result["result"] = $dados;
      $result["status"] = "success";

      http_response_code(200);
    } catch (PDOException $ex) {
      // echo "error: ". $ex->getMEssage();
      $result = ["status" => "fail", "error" => $ex->getMEssage()];
      http_response_code(200);
    } finally {
      $conn = null;
      echo json_encode($result);
    }
  } elseif (isset($_GET["id_usuario"]) || isset($_GET["cpf_cnpj"])) {
    try {
      if ((empty($_GET["id_usuario"]) || !is_numeric($_GET["id_usuario"])) && (empty($_GET["cpf_cnpj"]) || !is_numeric($_GET["cpf_cnpj"]))) {
        // está vazio ou não é numérico : ERRO
        throw new ErrorException("Valor inválido 1", 1);
      }

      if (isset($_GET["id_usuario"]) || !isset($_GET["cpf_cnpj"])) {

        $id_usuario = $_GET["id_usuario"];

        $sql = "SELECT * FROM usuarios
                    WHERE id_usuario =:id_usuario";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_usuario", $id_usuario);
      } elseif (!isset($_GET["id_usuario"]) || isset($_GET["cpf_cnpj"])) {

        $cpf_cnpj =  $_GET["cpf_cnpj"];

        $sql = "SELECT * FROM usuarios
                    WHERE cpf_cnpj =:cpf_cnpj";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":cpf_cnpj", $cpf_cnpj);
      }

      $stmt->execute();

      $dado = $stmt->fetch(PDO::FETCH_OBJ);
      $result['result'] = $dado;
      $result["status"] = "success";
      $result["where"] = true;
      // $result["sql"] = $sql;
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
}

if ($method == "POST") {
  // recupera dados do corpo (body) de uma requisição POST
  $postjson = json_decode(file_get_contents('php://input'), true);

  $dados = $postjson['form'];

  // função trim retira espaços que estão sobrando
  $email = trim($dados['email']); // acessa valor de um OBJETO
  $senha = trim($dados['senha']); // acessa valor de um OBJETO
  $nivel = trim($dados['nivel']); // acessa valor de um OBJETO

  try {
    if (empty($email) || empty($senha) || empty($nivel)) {
      // está vazio  : ERRO
      throw new ErrorException("Campo não preenchido!", 1);
    }
    $sql = "INSERT INTO usuarios (email, senha, nivel)
                VALUES (:email, :senha, :nivel)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha);
    $stmt->bindParam(":nivel", $nivel);
    $stmt->execute();

    $result = array("status" => "success");
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
  $postjson = json_decode(file_get_contents('php://input'), true);

  $dados = $postjson['form'];

  // função trim retira espaços que estão sobrando
  $id_usuario = trim($dados['id_usuario']); // acessa valor de um OBJETO
  $email = trim($dados['email']); // acessa valor de um OBJETO
  $senha = trim($dados['senha']); // acessa valor de um OBJETO
  $nivel = trim($dados['nivel']); // acessa valor de um OBJETO

  try {
    if (empty($id_usuario) || empty($email) || empty($senha) || empty($nivel)) {
      // está vazio  : ERRO
      throw new ErrorException("Campo não preenchido!", 1);
    }

    $sql = "
                UPDATE
                    usuarios
                SET
                    email=:email,
                    senha=:senha,
                    nivel=:nivel,
                    WHERE
                    id_usuario=:id_usuario
                ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_usuario", $id_usuario);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha);
    $stmt->bindParam(":id_cliente", $id_cliente);
    $stmt->bindParam(":id_usuario ", $id_usuario);
    $stmt->bindParam(":nivel", $nivel);
    $stmt->execute();
    $stmt = $conn->prepare($sql);

    $result = array("status" => "success");
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

if ($method == "DELETE") {
  try {

    if (empty($_GET["id_usuario"]) || !is_numeric($_GET["id_usuario"])) {
      // está vazio ou não é numérico : ERRO
      throw new ErrorException("Valor inválido", 1);
    }
    $id_usuario = $_GET["id_usuario"];

    $sql = "DELETE FROM usuarios
                WHERE id_usuario=:id_usuario";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_usuario", $id_usuario);
    $stmt->execute();

    $result["status"] = "success";
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
