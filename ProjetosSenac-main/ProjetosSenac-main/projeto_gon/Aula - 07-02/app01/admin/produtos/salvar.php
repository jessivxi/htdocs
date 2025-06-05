<?php
    include("../validar_sessao.php");

    if (!empty($_POST)){
       
        // echo "<pre>";
        // var_dump($_POST); // POST enviado pelo formulário (method POST)
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($_FILES["imagem"]); // enviado pelo enctype="multipart/form-data" (ARQUIVO)
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($_SERVER); // variáveis de servidor
        // echo "</pre>";
        $arquivo = $_FILES["imagem"];
        
        if(!empty($arquivo["name"])){
            
            $caminho_absoluto = $_SERVER["DOCUMENT_ROOT"]."\assets\img\produtos";
            $caminho_relativo = "assets/img/produtos/".$arquivo["name"];
                        
            // Move o arquivo da pasta temporaria de upload para a pasta de destino 
            if (move_uploaded_file($arquivo["tmp_name"], $caminho_absoluto."/".$arquivo["name"])) { 
                echo "Arquivo enviado com sucesso!"; 
            } 
            else { 
                echo "Erro, o arquivo n&atilde;o pode ser enviado."; 
            }        
        }else{
            $caminho_relativo="";
        }
      
        if(empty($_POST["nome"])){
            $msg = "Campo nome é obrigatório";
            $status = 'fail';
            header("location: form.php?msg=$msg&status=$status");
            exit;
        }
        /// demais validações

        $nome = $_POST["nome"];
        $preco = $_POST["preco"];
        $imagem = $caminho_relativo;

        // endpoint da API
        $end_point = "http://localhost/api_back/produtos/";

        // Inicializa o CURL
        $curl = curl_init();

        $id = "";
        if (empty($_POST["id"])){
            // se ID é vazio será realizado POST
            $method = "POST";
        }else{
            // se ID NÂO é vazio será realizado PUT
            $method = "PUT";
            $id = $_POST['id'];
        }

        $post_body = json_encode([
            'id' => $id,
            'nome'=> $nome, 
            'preco' => $preco, 
            'imagem' => $imagem
        ]);

        // configurações do CURL
        curl_setopt_array($curl,[            
            CURLOPT_URL => $end_point,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $post_body,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                'ACCESSTOKEN:'.$token
              ),
        ]);

        // envio do comando CURL e armazenamento da resposta
        $response = curl_exec($curl);

        // echo "<pre>";
        // var_dump($response);
        // echo "</pre>";
        // exit;
        
        // conersão do JSON para ARRAY
        $dado = json_decode($response, TRUE);

        // testar Retorno da API
        if ($dado["status"]=='fail'){
            $msg = "Erro ao inserir o registro";
            $status = 'fail';
            header("location: form.php?msg=$msg&status=$status");
            exit;
        }

        // tudo OK - inserio informação com sucesso
        $msg = "Registro inserido com sucesso";
        $status = 'success';
        header("location: index.php?msg=$msg&status=$status");
        exit;

    }else{
        $msg = "Padrão errado do protocolo de comuniação. Informe o Suporte!";
        $status = 'fail';
        header("location: index.php?msg=$msg&status=$status");
        exit;
    }


?>