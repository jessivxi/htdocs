<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT,DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];
include("connection.php");
if ($method == "GET") {
    if ((empty($_GET["id_colaborador"]) || !isset($_GET["id_colaborador"]) || !is_numeric($_GET["id_colaborador"]))) {
        // está vazio ou não é numérico : ERRO
        throw new ErrorException("Valor inválido 1", 1);
    } else {
        try {

            $id_colaborador = $_GET["id_colaborador"];
            $filtro = $_REQUEST['filtro'];

            if ($filtro == 1) {
                $sql = "SELECT s.id_servico, s.nome FROM servicos s WHERE s.id_servico NOT IN ( SELECT rlcs.id_servico FROM rl_colaborador_servico rlcs JOIN servicos s ON s.id_servico = rlcs.id_servico WHERE id_colaborador = :id_colaborador) ORDER BY s.STATUS DESC";
            } else {
                $sql = "SELECT rlcs.id_relacao,rlcs.status, s.nome, concat(s.tempo,' min') as temp_format, concat('R$ ',s.valor) as val_format FROM `rl_colaborador_servico` rlcs JOIN servicos s ON s.id_servico = rlcs.id_servico where id_colaborador = :id_colaborador  ORDER by s.STATUS desc";
            }

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id_colaborador", $id_colaborador);
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
    }
} elseif ($method == "POST") {
    // recupera dados do corpo (body) de uma requisão POST
    $postjson = json_decode(file_get_contents('php://input'), true);
    
    $dados = $postjson['body']['form'];

    // função trim retira espaços que estão sobrando
    $id_servico = trim($dados['id_servico']); // acessa valor de um OBJETO
    $id_colaborador = trim($dados['id_colaborador']); // acessa valor de um OBJETO
    $status = trim($dados['status']); // acessa valor de um OBJETO

    try {
        if (empty($id_servico) || empty($id_colaborador) || !is_numeric($id_servico) || !is_numeric($id_colaborador)) {
            // está vazio  : ERRO
            throw new ErrorException("Campo não preenchido!", 1);
        }

        $sql = "INSERT INTO rl_colaborador_servico (id_colaborador, id_servico, status) VALUES (:id_colaborador,:id_servico,:status)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_colaborador", $id_colaborador);
        $stmt->bindParam(":id_servico", $id_servico);
        $stmt->bindParam(":status", $status);
        $stmt->execute();

        $result = ["status" => "success", "error" => "Registro realizado com sucesso"];
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

    $dados = $postjson['body']['form'];

    // função trim retira espaços que estão sobrando
    $id_colaborador = trim($dados['id_colaborador']); // acessa valor de um OBJETO 
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
                    id_colaborador=:id_colaborador
                ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_colaborador", $id_colaborador);
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

    // recupera dados do corpo (body) de uma requisão POST
    $postjson = json_decode(file_get_contents('php://input'), true);

    $dados = $postjson['form'];

    // função trim retira espaços que estão sobrando
    $id_relacao = trim($dados['id_relacao']); // acessa valor de um OBJETO 

    try {

        if (empty($dados['id_relacao']) || !is_numeric($dados['id_relacao'])) {
            // está vazio ou não é numérico : ERRO
            throw new ErrorException("Valor inválido", 1);
        }
        $id_relacao = $dados['id_relacao'];

        $sql = "DELETE FROM rl_colaborador_servico
                WHERE id_relacao=:id_relacao";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_relacao", $id_relacao);
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
