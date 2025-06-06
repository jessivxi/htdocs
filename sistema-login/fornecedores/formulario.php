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
</head>
<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <div class="col-md">
                <!-- Formulário de cadastro de fornecedores -->
                <h2>
                    Cadastrar Fornecedor
                    <a href="./" class="btn btn-primary btn-sm">Novo Fornecedor</a>
                </h2>
                <form id="providerForm" action="/fornecedores/cadastrar.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="providerId" class="form-label">Código do Fornecedor</label>
                        <input type="text" class="form-control" id="providerId" name="providerId" readonly value="<?php echo isset($provider) ? $provider["id_fornecedor"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerName" class="form-label">Razão Social</label>
                        <input type="text" class="form-control" id="providerName" name="providerName" required value="<?php echo isset($provider) ? $provider["razao_social"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerCNPJ" class="form-label">CNPJ</label>
                        <input data-mask="00.000.000/0000-00" type="text" class="form-control" id="providerCNPJ" name="providerCNPJ" required value="<?php echo isset($provider) ? $provider["cnpj"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerEmail" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="providerEmail" name="providerEmail" required value="<?php echo isset($provider) ? $provider["email"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerPhone" class="form-label">Telefone</label>
                        <input data-mask="(00) 0000-0000" type="text" class="form-control" id="providerPhone" name="providerPhone" required value="<?php echo isset($provider) ? $provider["telefone"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerCEP" class="form-label">CEP</label>
                        <input data-mask="00000-000" type="text" class="form-control" id="providerCEP" name="providerCEP" required value="<?php echo isset($provider) ? $provider["endereco"]["cep"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerStreet" class="form-label">Logradouro</label>
                        <input type="text" class="form-control" id="providerStreet" name="providerStreet" required value="<?php echo isset($provider) ? $provider["endereco"]["logradouro"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerNumber" class="form-label">Número</label>
                        <input type="text" class="form-control" id="providerNumber" name="providerNumber" required value="<?php echo isset($provider) ? $provider["endereco"]["numero"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerComplement" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="providerComplement" name="providerComplement" value="<?php echo isset($provider) ? $provider["endereco"]["complemento"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerNeighborhood" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="providerNeighborhood" name="providerNeighborhood" required value="<?php echo isset($provider) ? $provider["endereco"]["bairro"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerCity" class="form-label">Cidade</label>
                        <input readonly type="text" class="form-control" id="providerCity" name="providerCity" required value="<?php echo isset($provider) ? $provider["endereco"]["cidade"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="providerState" class="form-label">Estado</label>
                        <input readonly type="text" maxlength="2" class="form-control" id="providerState" name="providerState" required value="<?php echo isset($provider) ? $provider["endereco"]["estado"] : ""; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>

        

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script> 
    $('#clientCEP').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        // Verifica se o CEP tem 8 dígitos
        if (cep.length === 8) {
            // Faz a requisição para a API ViaCEP
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                if (!data.erro) {
                    $('#clientStreet').val(data.logradouro);
                    $('#clientNeighborhood').val(data.bairro);
                    $('#clientCity').val(data.localidade);
                    $('#clientState').val(data.uf);
                } else {
                    alert('CEP não encontrado.');
                    $("#clientCEP").val("");
                    $("#clientStreet").val("");
                    $("#clientNeighborhood").val("");
                    $("#clientCity").val("");
                    $("#clientState").val("");
                }
            });
        } else {
            alert('Formato de CEP inválido.');
            // Limpa os campos de endereço
            $("#clientCEP").val("");
            $("#clientStreet").val("");
            $("#clientNeighborhood").val("");
            $("#clientCity").val("");
            $("#clientState").val("");
        }
    });
    </script>

</body>
</html>