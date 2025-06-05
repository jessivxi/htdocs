<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];
include("connection.php");

if ($method == "GET") {
    if (isset($_GET["id_local"]) && isset($_GET["id_local"]) > 0) {
        try {
            $sql = "SELECT  c.id_colaborador,c.nome,c.cpf_cnpj,c.telefone FROM colaboradores c join `rl_local_colaborador` lc ON lc.id_colaborador = c.id_colaborador WHERE lc.id_local = :id_local";

            $id_local = $_GET["id_local"];
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id_local", $id_local);
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
    } elseif (!isset($_GET["id_colaborador"]) && !isset($_GET["cpf_cnpj"])) {
        try {
            $sql = "SELECT * FROM `colaboradores` ORDER by STATUS desc";

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
    } elseif (isset($_GET["id_colaborador"]) || isset($_GET["cpf_cnpj"])) {
        try {
            if ((empty($_GET["id_colaborador"]) || !is_numeric($_GET["id_colaborador"])) && (empty($_GET["cpf_cnpj"]) || !is_numeric($_GET["cpf_cnpj"]))) {
                // está vazio ou não é numérico : ERRO
                throw new ErrorException("Valor inválido 1", 1);
            }

            if (isset($_GET["id_colaborador"]) || !isset($_GET["cpf_cnpj"])) {

                $id_colaborador = $_GET["id_colaborador"];

                $sql = "SELECT * FROM colaboradores
                    WHERE id_colaborador =:id_colaborador";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id_colaborador", $id_colaborador);
            } elseif (!isset($_GET["id_colaborador"]) || isset($_GET["cpf_cnpj"])) {

                $cpf_cnpj =  $_GET["cpf_cnpj"];

                $sql = "SELECT * FROM colaboradores
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
    // recupera dados do corpo (body) de uma requisão POST
    $postjson = json_decode(file_get_contents('php://input'), true);

    $dados = $postjson['form'];

    // função trim retira espaços que estão sobrando
    $uf = trim($dados['uf']); // acessa valor de um OBJETO
    $nome = trim($dados['nome']); // acessa valor de um OBJETO
    $cep = trim($dados['cep']); // acessa valor de um OBJETO
    $cpf_cnpj = trim($dados['cpf_cnpj']); // acessa valor de um OBJETO
    $foto = trim($dados['foto']); // acessa valor de um OBJETO
    $status = trim($dados['status']); // acessa valor de um OBJETO
    $numero = trim($dados['numero']); // acessa valor de um OBJETO
    $bairro = trim($dados['bairro']); // acessa valor de um OBJETO
    $cidade = trim($dados['cidade']); // acessa valor de um OBJETO
    $telefone = trim($dados['telefone']); // acessa valor de um OBJETO
    $logradouro = trim($dados['logradouro']); // acessa valor de um OBJETO
    $complemento = trim($dados['complemento']); // acessa valor de um OBJETO
    $data_cadastro = trim($dados['data_cadastro']); // acessa valor de um OBJETO

    try {
        if (empty($nome) || empty($telefone) || empty($cpf_cnpj)) {
            // está vazio  : ERRO
            throw new ErrorException("Campo não preenchido!", 1);
        }
        $sql = "INSERT INTO colaboradores (nome, cpf_cnpj, telefone,cep, data_cadastro, foto, status,logradouro,numero,complemento,bairro,cidade,uf)
                VALUES (:nome, :cpf_cnpj, :telefone,:cep,:data_cadastro, :foto, :status,:logradouro,:numero,:complemento,:bairro,:cidade,:uf)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf_cnpj", $cpf_cnpj);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":cep", $cep);
        $stmt->bindParam(":data_cadastro", $data_cadastro);
        $stmt->bindParam(":foto", $foto);
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

    // recupera dados do corpo (body) de uma requisão POST
    $postjson = json_decode(file_get_contents('php://input'), true);

    $dados = $postjson['form'];

    // função trim retira espaços que estão sobrando
    $id_colaborador = trim($dados['id_colaborador']); // acessa valor de um OBJETO
    $uf = trim($dados['uf']); // acessa valor de um OBJETO
    $nome = trim($dados['nome']); // acessa valor de um OBJETO
    $cep = trim($dados['cep']); // acessa valor de um OBJETO
    $cpf_cnpj = trim($dados['cpf_cnpj']); // acessa valor de um OBJETO
    $foto = trim($dados['foto']); // acessa valor de um OBJETO
    $status = trim($dados['status']); // acessa valor de um OBJETO
    $numero = trim($dados['numero']); // acessa valor de um OBJETO
    $bairro = trim($dados['bairro']); // acessa valor de um OBJETO
    $cidade = trim($dados['cidade']); // acessa valor de um OBJETO
    $telefone = trim($dados['telefone']); // acessa valor de um OBJETO
    $logradouro = trim($dados['logradouro']); // acessa valor de um OBJETO
    $complemento = trim($dados['complemento']); // acessa valor de um OBJETO
    $data_cadastro = trim($dados['data_cadastro']); // acessa valor de um OBJETO

    try {
        if (empty($id_colaborador) || empty($nome) || empty($telefone) || empty($cpf_cnpj)) {
            // está vazio  : ERRO
            throw new ErrorException("Campo não preenchido!", 1);
        }

        $sql = "
                UPDATE 
                    colaboradores
                SET 
                    nome=:nome, 
                    cpf_cnpj=:cpf_cnpj, 
                    telefone=:telefone, 
                    cep=:cep, 
                    data_cadastro=:data_cadastro,
                    logradouro=:logradouro,
                    numero=:numero,
                    complemento=:complemento,
                    bairro=:bairro,
                    cidade=:cidade,
                    uf=:uf,
                    foto=:foto, 
                    status=:status
                WHERE 
                    id_colaborador=:id_colaborador
                ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_colaborador", $id_colaborador);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf_cnpj", $cpf_cnpj);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":cep", $cep);
        $stmt->bindParam(":data_cadastro", $data_cadastro);
        $stmt->bindParam(":foto", $foto);
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

        if (empty($_GET["id_colaborador"]) || !is_numeric($_GET["id_colaborador"])) {
            // está vazio ou não é numérico : ERRO
            throw new ErrorException("Valor inválido", 1);
        }
        $id_colaborador = $_GET["id_colaborador"];

        $sql = "DELETE FROM colaboradores
                WHERE id_colaborador=:id_colaborador";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_colaborador", $id_colaborador);
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
