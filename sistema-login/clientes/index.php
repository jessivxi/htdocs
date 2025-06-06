<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "clientes";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/clientes/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        // Se houver dados, pega o primeiro e único cliente na posição [0]
        $client = $response["data"][0];
    } else {
        $client = null;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Clientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>


    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md">
                <!-- Tabela de clientes cadastrados -->
                <h2>
                    Clientes Cadastrados
                    <a href="/clientes/formulario.php" class="btn btn-secondary btn-sm float-left">Novo</a>
                    <a href="/clientes/exportar.php" class="btn btn-success btn-sm float-left">Excel</a>
                    <a href="/clientes/exportar_pdf.php" class="btn btn-danger btn-sm float-left">PDF</a>
                </h2>
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="clientTableBody">
                        <!-- Os clientes serão carregados aqui via PHP -->
                        <?php
                        // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
                        $key = null; // Limpar a variável para trazer TODOS os clientes
                        require("../requests/clientes/get.php");
                        if(!empty($response)) {
                            foreach($response["data"] as $key => $client) {
                                echo '
                                <tr>
                                    <th scope="row">'.$client["id_cliente"].'</th>
                                    <td><img width="60" src="/clientes/imagens/'.$client["imagem"].'"></td>
                                    <td>'.$client["nome"].'</td>
                                    <td>'.$client["cpf"].'</td>
                                    <td>'.$client["email"].'</td>
                                    <td>'.$client["whatsapp"].'</td>
                                    <td>
                                        <a href="/clientes/formulario.php?key='.$client["id_cliente"].'" class="btn btn-warning">Editar</a>
                                        <a href="/clientes/remover.php?key='.$client["id_cliente"].'" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="7">Nenhum cliente cadastrado</td>
                            </tr>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- Datables -->
    <script src= "//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css"> </script>
    <script>
        let table = new Datatable('#myTable',{
            language: {
                url: '//cdn.datatables.net/plug-ins/2.3.2/i18n/pt-BR.json',
            },
        });
    </script>

</body>

</html>