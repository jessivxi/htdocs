<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];
include("../connection/connection.php");

if ($method == "GET") {
    // criar resposta para GET;
}

if ($method == "POST") {

    // recupera dados do corpo (body) de uma requisão POST
    $dados = file_get_contents("php://input");

    // decodifica JSON, sem opção TRUE
    $dados = json_decode($dados); // isso retorna um OBJETO

    try {
        if (empty($dados->email) || !isset($dados->email)) {
            // está vazio ou nao existe  : ERRO
            throw new ErrorException("E-mail inválido", 1);
        }

        if (empty($dados->cpf) || !isset($dados->cpf)) {
            // está vazio ou nao existe  : ERRO
            throw new ErrorException("CPF inválido", 1);
        }

        if (!filter_var($dados->email, FILTER_VALIDATE_EMAIL)) {
            # Está vazio ou não existe
            throw new ErrorException("E-mail inválido", 1);
        }

        // função trim retira espaços que estão sobrando
        // recupera valores do objeto e atribui às variáveis
        $email = trim($dados->email); // acessa valor de um OBJETO
        $cpf = trim($dados->cpf); // acessa valor de um OBJETO


        //passo1: OK pensar em uma estratégia de criar um TOKEN que nunca se repita
        // TOKEN tem que ser único

        $temp = $email . $cpf . date("d/m/y - h:i:s");
        $temp = hash("sha256", $temp);
        $token = substr($temp, 0, 6) . substr($temp, -6, 6);

        //passo2: OK criar nova tabela no banco de dados para armazenar os dados e o Token criado


        // passo3: continuar alterando o código abaixo

        $sql = "INSERT INTO unidades(unidade, atualiza)
                    VALUES (:unidade, now())";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":unidade", $unidade);
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
    // criar resposta para PUT;
}

if ($method == "DELETE") {
    // criar resposta para DELETE;
}







?>