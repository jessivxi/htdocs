<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];
include("connection.php");

if ($method == "GET") {
    if (!isset($_GET["id_cliente"]) && !isset($_GET["cpf"])) {
        try {
            $sql = "SELECT * FROM `clientes` ORDER by STATUS desc";

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
    } elseif (isset($_GET["id_cliente"]) || isset($_GET["cpf"])) {
        try {
            if ((empty($_GET["id_cliente"]) || !is_numeric($_GET["id_cliente"])) && (empty($_GET["cpf"]) || !is_numeric($_GET["cpf"]))) {
                // está vazio ou não é numérico : ERRO
                throw new ErrorException("Valor inválido 1", 1);
            }

            if (isset($_GET["id_cliente"]) || !isset($_GET["cpf"])) {

                $id_cliente = $_GET["id_cliente"];

                $sql = "SELECT * FROM clientes
                    WHERE id_cliente =:id_cliente";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id_cliente", $id_cliente);
            } elseif (!isset($_GET["id_cliente"]) || isset($_GET["cpf"])) {

                $cpf =  $_GET["cpf"];

                $sql = "SELECT * FROM clientes
                    WHERE cpf =:cpf";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":cpf", $cpf);
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
    $cpf = trim($dados['cpf']); // acessa valor de um OBJETO
    $foto = trim($dados['foto']); // acessa valor de um OBJETO
    $genero = trim($dados['genero']); // acessa valor de um OBJETO
    $status = trim($dados['status']); // acessa valor de um OBJETO
    $numero = trim($dados['numero']); // acessa valor de um OBJETO
    $bairro = trim($dados['bairro']); // acessa valor de um OBJETO
    $cidade = trim($dados['cidade']); // acessa valor de um OBJETO
    $telefone = trim($dados['telefone']); // acessa valor de um OBJETO
    $logradouro = trim($dados['logradouro']); // acessa valor de um OBJETO
    $complemento = trim($dados['complemento']); // acessa valor de um OBJETO
    $data_nascimento = trim($dados['data_nascimento']); // acessa valor de um OBJETO

    try {
        if (empty($nome) || empty($telefone) || empty($cpf) || empty($genero)) {
            // está vazio  : ERRO
            throw new ErrorException("Campo não preenchido!", 1);
        }
        $sql = "INSERT INTO clientes (nome, cpf, telefone,cep, genero, data_nascimento, foto, status,logradouro,numero,complemento,bairro,cidade,uf)
                VALUES (:nome, :cpf, :telefone,:cep,:genero, :data_nascimento, :foto, :status,:logradouro,:numero,:complemento,:bairro,:cidade,:uf)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":cep", $cep);
        $stmt->bindParam(":data_nascimento", $data_nascimento);
        $stmt->bindParam(":genero", $genero);
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
    $id_cliente = trim($dados['id_cliente']); // acessa valor de um OBJETO
    $uf = trim($dados['uf']); // acessa valor de um OBJETO
    $nome = trim($dados['nome']); // acessa valor de um OBJETO
    $cep = trim($dados['cep']); // acessa valor de um OBJETO
    $cpf = trim($dados['cpf']); // acessa valor de um OBJETO
    $foto = trim($dados['foto']); // acessa valor de um OBJETO
    $genero = trim($dados['genero']); // acessa valor de um OBJETO
    $status = trim($dados['status']); // acessa valor de um OBJETO
    $numero = trim($dados['numero']); // acessa valor de um OBJETO
    $bairro = trim($dados['bairro']); // acessa valor de um OBJETO
    $cidade = trim($dados['cidade']); // acessa valor de um OBJETO
    $telefone = trim($dados['telefone']); // acessa valor de um OBJETO
    $logradouro = trim($dados['logradouro']); // acessa valor de um OBJETO
    $complemento = trim($dados['complemento']); // acessa valor de um OBJETO
    $data_nascimento = trim($dados['data_nascimento']); // acessa valor de um OBJETO

    try {
        if (empty($nome) || empty($telefone)) {
            // está vazio  : ERRO
            throw new ErrorException("Campo não preenchido!", 1);
        }

        $sql = "
                UPDATE 
                    clientes
                SET 
                    nome=:nome, 
                    cpf=:cpf, 
                    telefone=:telefone, 
                    cep=:cep, 
                    genero=:genero, 
                    data_nascimento=:data_nascimento,
                    logradouro=:logradouro,
                    numero=:numero,
                    complemento=:complemento,
                    bairro=:bairro,
                    cidade=:cidade,
                    uf=:uf,
                    foto=:foto, 
                    status=:status
                WHERE 
                    id_cliente=:id_cliente
                ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_cliente", $id_cliente);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":cep", $cep);
        $stmt->bindParam(":data_nascimento", $data_nascimento);
        $stmt->bindParam(":genero", $genero);
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

        if (empty($_GET["id_cliente"]) || !is_numeric($_GET["id_cliente"])) {
            // está vazio ou não é numérico : ERRO
            throw new ErrorException("Valor inválido", 1);
        }
        $id_cliente = $_GET["id_cliente"];

        $sql = "DELETE FROM clientes
                WHERE id_cliente=:id_cliente";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_cliente", $id_cliente);
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
