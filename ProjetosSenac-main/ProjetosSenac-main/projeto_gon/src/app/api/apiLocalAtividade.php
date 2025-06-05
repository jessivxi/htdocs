<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];
include("connection.php");

if ($method == "GET") {
    if (!isset($_GET["id_local"]) && !isset($_GET["cnpj"])) {
        try {
            $sql = "SELECT nome,id_local,status FROM `local_atividade` ORDER by STATUS desc";

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
    } elseif (isset($_GET["id_local"]) || isset($_GET["cnpj"])) {
        try {
            if ((empty($_GET["id_local"]) || !is_numeric($_GET["id_local"])) && (empty($_GET["cnpj"]) || !is_numeric($_GET["cnpj"]))) {
                // está vazio ou não é numérico : ERRO
                throw new ErrorException("Valor inválido 1", 1);
            }

            if (isset($_GET["id_local"]) || !isset($_GET["cnpj"])) {

                $id_local = $_GET["id_local"];

                $sql = "SELECT * FROM local_atividade
                    WHERE id_local =:id_local";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id_local", $id_local);
            } elseif (!isset($_GET["id_local"]) || isset($_GET["cnpj"])) {

                $cnpj =  $_GET["cnpj"];

                $sql = "SELECT * FROM local_atividade
                    WHERE cnpj =:cnpj";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":cnpj", $cnpj);
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
} elseif ($method == "POST") {

    // $dados = json_decode(file_get_contents('php://input'), true);
    // print_r($dados);
    
    // recupera dados do corpo (body) de uma requisão POST
    $postjson = json_decode(file_get_contents('php://input'), true);
    
    $dados = $postjson['form'];

    // função trim retira espaços que estão sobrando
    $uf = trim($dados['uf']); // acessa valor de um OBJETO
    $nome = trim($dados['nome']); // acessa valor de um OBJETO
    $cep = trim($dados['cep']); // acessa valor de um OBJETO
    $cnpj = trim($dados['cnpj']); // acessa valor de um OBJETO
    $status = trim($dados['status']); // acessa valor de um OBJETO
    $numero = trim($dados['numero']); // acessa valor de um OBJETO
    $bairro = trim($dados['bairro']); // acessa valor de um OBJETO
    $cidade = trim($dados['cidade']); // acessa valor de um OBJETO
    $logradouro = trim($dados['logradouro']); // acessa valor de um OBJETO
    $complemento = trim($dados['complemento']); // acessa valor de um OBJETO
    $data_cadastro = trim($dados['data_cadastro']); // acessa valor de um OBJETO

    try {
        if (empty($nome) || empty($cnpj)) {
            // está vazio  : ERRO
            throw new ErrorException("Campo não preenchido!", 1);
        }
        $sql = "INSERT INTO local_atividade (nome, cnpj,cep, data_cadastro, status,logradouro,numero,complemento,bairro,cidade,uf)
                VALUES (:nome, :cnpj,:cep,:data_cadastro, :status,:logradouro,:numero,:complemento,:bairro,:cidade,:uf)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cnpj", $cnpj);
        $stmt->bindParam(":cep", $cep);
        $stmt->bindParam(":data_cadastro", $data_cadastro);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":logradouro", $logradouro);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":complemento", $complemento);
        $stmt->bindParam(":bairro", $bairro);
        $stmt->bindParam(":cidade", $cidade);
        $stmt->bindParam(":uf", $uf);
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

    // $dados = json_decode(file_get_contents('php://input'), true);
    // print_r($dados);
    
    // recupera dados do corpo (body) de uma requisão POST
    $postjson = json_decode(file_get_contents('php://input'), true);
    
    $dados = $postjson['form'];

    // função trim retira espaços que estão sobrando
    $id_local = trim($dados['id_local']); // acessa valor de um OBJETO
    $uf = trim($dados['uf']); // acessa valor de um OBJETO
    $nome = trim($dados['nome']); // acessa valor de um OBJETO
    $cep = trim($dados['cep']); // acessa valor de um OBJETO
    $cnpj = trim($dados['cnpj']); // acessa valor de um OBJETO
    $status = trim($dados['status']); // acessa valor de um OBJETO
    $numero = trim($dados['numero']); // acessa valor de um OBJETO
    $bairro = trim($dados['bairro']); // acessa valor de um OBJETO
    $cidade = trim($dados['cidade']); // acessa valor de um OBJETO
    $logradouro = trim($dados['logradouro']); // acessa valor de um OBJETO
    $complemento = trim($dados['complemento']); // acessa valor de um OBJETO
    $data_cadastro = trim($dados['data_cadastro']); // acessa valor de um OBJETO

    try {
        if (empty($id_local)) {
            // está vazio  : ERRO
            throw new ErrorException("Campo não preenchido!", 1);
        }

        $sql = "
                UPDATE 
                    local_atividade
                SET 
                    nome=:nome, 
                    cnpj=:cnpj,  
                    cep=:cep, 
                    data_cadastro=:data_cadastro,
                    logradouro=:logradouro,
                    numero=:numero,
                    complemento=:complemento,
                    bairro=:bairro,
                    cidade=:cidade,
                    uf=:uf,
                    status=:status
                WHERE 
                    id_local=:id_local
                ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_local", $id_local);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cnpj", $cnpj);
        $stmt->bindParam(":cep", $cep);
        $stmt->bindParam(":data_cadastro", $data_cadastro);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":logradouro", $logradouro);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":complemento", $complemento);
        $stmt->bindParam(":bairro", $bairro);
        $stmt->bindParam(":cidade", $cidade);
        $stmt->bindParam(":uf", $uf);
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

        if (empty($_GET["id_local"]) || !is_numeric($_GET["id_local"])) {
            // está vazio ou não é numérico : ERRO
            throw new ErrorException("Valor inválido", 1);
        }
        $id_local = $_GET["id_local"];

        $sql = "DELETE FROM local_atividade
                WHERE id_local=:id_local";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_local", $id_local);
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
