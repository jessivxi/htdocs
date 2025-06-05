<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];
include("connection.php");

if ($method == "GET") {
  if (isset($_GET["id_colaborador"])) {
    try {
      if ((empty($_GET["id_colaborador"]) || !isset($_GET["id_colaborador"]) || !is_numeric($_GET["id_colaborador"]))) {
        // está vazio ou não é numérico : ERRO
        throw new ErrorException("Valor inválido 1", 1);
      }

      $id_colaborador = $_GET["id_colaborador"];

      $sql = "SELECT rlcs.id_relacao, s.nome, concat(s.tempo,' min') as temp_format, concat('R$ ',s.valor) as val_format FROM `rl_colaborador_servico` rlcs JOIN servicos s ON s.id_servico = rlcs.id_servico where id_colaborador = :id_colaborador  ORDER by s.STATUS desc";

      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":id_colaborador", $id_colaborador);
      $stmt->execute();

      $dado = $stmt->fetchall(PDO::FETCH_OBJ);
      $result['result'] = $dado;
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
  } else if (!isset($_GET["id_servico"])) {
    try {
      $sql = "SELECT concat(tempo,' min') as temp_format, concat('R$ ',valor) as val_format,servicos.* FROM `servicos` ORDER by STATUS desc";

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
  } elseif (isset($_GET["id_servico"])) {
    try {
      if ((empty($_GET["id_servico"]) || !is_numeric($_GET["id_servico"]))) {
        // está vazio ou não é numérico : ERRO
        throw new ErrorException("Valor inválido 1", 1);
      }
      $id_servico = $_GET["id_servico"];

      $sql = "SELECT * FROM servicos
                    WHERE id_servico =:id_servico";

      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":id_servico", $id_servico);

      $stmt->execute();

      $dado = $stmt->fetch(PDO::FETCH_OBJ);
      $result['result'] = $dado;
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
} elseif ($method == "POST") {
  // recupera dados do corpo (body) de uma requisão POST
  $postjson = json_decode(file_get_contents('php://input'), true);

  $dados = $postjson['form'];

  // função trim retira espaços que estão sobrando
  $nome = trim($dados['nome']); // acessa valor de um OBJETO
  $valor = trim($dados['valor']); // acessa valor de um OBJETO
  $tempo = trim($dados['tempo']); // acessa valor de um OBJETO
  $descricao = trim($dados['descricao']); // acessa valor de um OBJETO
  $status = trim($dados['status']); // acessa valor de um OBJETO

  try {
    if (empty($nome) || empty($valor) || empty($descricao) || empty($status)) {
      // está vazio  : ERRO
      throw new ErrorException("Campo não preenchido!", 1);
    }
    $sql = "INSERT INTO servicos (nome, valor, tempo,descricao, status) VALUES (:nome,:valor,:tempo,:descricao,:status)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":valor", $valor);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":tempo", $tempo);
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
} elseif ($method == "PUT") {

  // recupera dados do corpo (body) de uma requisão POST
  $postjson = json_decode(file_get_contents('php://input'), true);

  $dados = $postjson['form'];

  // função trim retira espaços que estão sobrando
  $id_servico = trim($dados['id_servico']); // acessa valor de um OBJETO
  $nome = trim($dados['nome']); // acessa valor de um OBJETO
  $valor = trim($dados['valor']); // acessa valor de um OBJETO
  $tempo = trim($dados['tempo']); // acessa valor de um OBJETO
  $descricao = trim($dados['descricao']); // acessa valor de um OBJETO
  $status = trim($dados['status']);  // acessa valor de um OBJETO

  try {
    if (empty($nome) || empty($valor) || empty($descricao) || empty($status)) {
      // está vazio  : ERRO
      throw new ErrorException("Campo não preenchido!", 1);
    }

    $sql = "
                UPDATE
                    servicos
                SET
                    nome=:nome,
                    valor=:valor,
                    tempo=:tempo,
                    descricao=:descricao,
                    status=:status
                WHERE
                    id_servico=:id_servico
                ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_servico", $id_servico);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":valor", $valor);
    $stmt->bindParam(":tempo", $tempo);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":status", $status);
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
} elseif ($method == "DELETE") {
  try {

    if (empty($_GET["id_servico"]) || !is_numeric($_GET["id_servico"])) {
      // está vazio ou não é numérico : ERRO
      throw new ErrorException("Valor inválido", 1);
    }
    $id_servico = $_GET["id_servico"];

    $sql = "DELETE FROM servicos
                WHERE id_servico=:id_servico";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_servico", $id_servico);
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
