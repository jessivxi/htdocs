<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "fornecedores";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/fornecedores/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        // Se houver dados, pega o primeiro e único fornecedor na posição [0]
        $provider = $response["data"][0];
    } else {
        $provider = null;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Fornecedores</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <div class="card">
                    <div class="card-header">
                        <h2>Cadastrar Fornecedor</h2>
                    </div>
                    <div class="card-body">
                        <!-- Formulário de cadastro de fornecedores -->
                        <form id="providerForm" action="/fornecedores/cadastrar.php" method="POST"
                            enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label for="providerEmail" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="providerEmail" name="providerEmail"
                                        required value="<?php echo isset($provider) ? $provider["email"] : ""; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="providerPhone" class="form-label">Telefone</label>
                                    <input data-mask="(00) 0000-0000" type="text" class="form-control"
                                        id="providerPhone" name="providerPhone" required
                                        value="<?php echo isset($provider) ? $provider["telefone"] : ""; ?>">
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="providerCEP" class="form-label">CEP</label>
                                    <input data-mask="00000-000" type="text" class="form-control" id="providerCEP"
                                        name="providerCEP" required
                                        value="<?php echo isset($provider) ? $provider["endereco"]["cep"] : ""; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="providerStreet" class="form-label">Logradouro</label>
                                    <input type="text" class="form-control" id="providerStreet" name="providerStreet"
                                        required
                                        value="<?php echo isset($provider) ? $provider["endereco"]["logradouro"] : ""; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="providerNumber" class="form-label">Número</label>
                                    <input type="text" class="form-control" id="providerNumber" name="providerNumber"
                                        required
                                        value="<?php echo isset($provider) ? $provider["endereco"]["numero"] : ""; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="providerComplement" class="form-label">Complemento</label>
                                    <input type="text" class="form-control" id="providerComplement"
                                        name="providerComplement"
                                        value="<?php echo isset($provider) ? $provider["endereco"]["complemento"] : ""; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="providerNeighborhood" class="form-label">Bairro</label>
                                    <input type="text" class="form-control" id="providerNeighborhood"
                                        name="providerNeighborhood" required
                                        value="<?php echo isset($provider) ? $provider["endereco"]["bairro"] : ""; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="providerCity" class="form-label">Cidade</label>
                                    <input readonly type="text" class="form-control" id="providerCity"
                                        name="providerCity" required
                                        value="<?php echo isset($provider) ? $provider["endereco"]["cidade"] : ""; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="providerState" class="form-label">Estado</label>
                                    <input readonly type="text" maxlength="2" class="form-control" id="providerState"
                                        name="providerState" required
                                        value="<?php echo isset($provider) ? $provider["endereco"]["estado"] : ""; ?>">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="/fornecedores" class="btn btn-outline-danger">Voltar</a>
                        <button form="myForm" type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
    $('#providerCEP').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        // Verifica se o CEP tem 8 dígitos
        if (cep.length === 8) {
            // Faz a requisição para a API ViaCEP
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                if (!data.erro) {
                    $('#providerStreet').val(data.logradouro);
                    $('#providerNeighborhood').val(data.bairro);
                    $('#providerCity').val(data.localidade);
                    $('#providerState').val(data.uf);
                } else {
                    alert('CEP não encontrado.');
                    $("#providerCEP").val("");
                    $("#providerStreet").val("");
                    $("#providerNeighborhood").val("");
                    $("#providerCity").val("");
                    $("#providerState").val("");
                }
            });
        } else {
            alert('Formato de CEP inválido.');
            // Limpa os campos de endereço
            $("#providerCEP").val("");
            $("#providerStreet").val("");
            $("#providerNeighborhood").val("");
            $("#providerCity").val("");
            $("#providerState").val("");
        }
    });
    </script>

</body>

</html>