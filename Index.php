<?php
// Inclua o arquivo do banco de dados
include_once './bancoDeDadosClientes.php';

// Verifique se o formulário foi enviado
if (isset($_POST['cadUsuario'])) {
    $mostrarInputs = true;
} else {
    $mostrarInputs = false;
}

// Verifica Botão de protocolo
if (isset($_POST['irProtocolo'])) {
    header('Location: protocolo.php');
    exit;
}

// Salve as informações no banco de dados se o botão "Cadastrar pessoa" for pressionado
if (isset($_POST['cadUsuarioSIM'])) {
    // Obtenha os valores do formulário
    $nome = $_POST['nome'];
    $dataDeNascimento = $_POST['dataDeNascimento'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['sexo'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifique se todos os campos obrigatórios estão preenchidos
    if (empty($nome) || empty($dataDeNascimento) || empty($cpf) || empty($sexo) || empty($email) || empty($senha)) {
        echo "Complete todos os campos";
    } else {
        // Estabeleça a conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "usuarios";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Verifique se a conexão foi estabelecida corretamente
        if (!$conn) {
            die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
        }

        // Escape os valores para evitar injeção de SQL
        $nome = mysqli_real_escape_string($conn, $nome);
        $dataDeNascimento = mysqli_real_escape_string($conn, $dataDeNascimento);
        $cpf = mysqli_real_escape_string($conn, $cpf);
        $sexo = mysqli_real_escape_string($conn, $sexo);
        $cidade = mysqli_real_escape_string($conn, $cidade);
        $bairro = mysqli_real_escape_string($conn, $bairro);
        $rua = mysqli_real_escape_string($conn, $rua);
        $numero = mysqli_real_escape_string($conn, $numero);
        $complemento = mysqli_real_escape_string($conn, $complemento);
        $email = mysqli_real_escape_string($conn, $email);
        $senha = mysqli_real_escape_string($conn, $senha);

        // Verifique se a senha ou CPF já estão cadastrados
        $sqlVerificacao = "SELECT * FROM usuarios WHERE senha = '$senha' OR cpf = '$cpf'";
        $resultVerificacao = mysqli_query($conn, $sqlVerificacao);

        if (mysqli_num_rows($resultVerificacao) > 0) {
            echo "Senha ou CPF já cadastrado";
        } else {
            // Exemplo de código para salvar os dados em uma tabela "usuarios"
            $sql = "INSERT INTO usuarios (nome, data_nascimento, cpf, sexo, cidade, bairro, rua, numero, complemento, email, senha) VALUES ('$nome', '$dataDeNascimento', '$cpf', '$sexo', '$cidade', '$bairro', '$rua', '$numero', '$complemento', '$email', '$senha')";

            // Execute a query usando a função mysqli_query
            if (mysqli_query($conn, $sql)) {
                // Redirecione para a página de sucesso
                header('Location: protocolo.php');
                exit;
            } else {
                // Trate qualquer erro durante a execução da consulta
                echo "Erro ao executar a consulta: " . mysqli_error($conn);
            }
        }

        // Feche a conexão com o banco de dados
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de login</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Prefeitura Municipal de São Leopoldo</h1>

    <form name="cad-usuario" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php if (!$mostrarInputs) { ?>
            <h2>Bem vindo ao cadastro de pessoa</h2>
            <label>Clique abaixo caso queira cadastrar uma pessoa:</label><br>
            <label>Após o cadastro, você será redirecionado para tela de protocolos</label><br>

            <input type="submit" value="Cadastrar pessoa" name="cadUsuario"><br>

            <label>Caso já tenha um cadastro, clique no botão abaixo e abra seu ticket!</label><br>

            <input type="submit" value="Criar Protocolos" name="irProtocolo">

        <?php } else { ?>
            <p>Todas as caixas de textos que possuirem "<label style='color: red '>*</label>" são informações necessárias</p>

            <label><label style='color: red '>*</label>Nome:</label><br>
            <input type="text" name="nome" value="<?php echo isset($nome) ? $nome : ''; ?>"><br>

            <label><label style='color: red '>*</label>Data de Nascimento:</label><br>
            <input type="text" name="dataDeNascimento" placeholder="Ano/Mês/Dia" value="<?php echo isset($dataDeNascimento) ? $dataDeNascimento : ''; ?>"><br>

            <label><label style='color: red '>*</label>CPF:</label><br>
            <input type="text" name="cpf" placeholder="000.000.000-00" value="<?php echo isset($cpf) ? $cpf : ''; ?>"><br>

            <label><label style='color: red '>*</label>Sexo:</label><br>
            <input type="text" name="sexo" value="<?php echo isset($sexo) ? $sexo : ''; ?>"><br>

            <label>Cidade:</label><br>
            <input type="text" name="cidade" value="<?php echo isset($cidade) ? $cidade : ''; ?>"><br>

            <label>Bairro:</label><br>
            <input type="text" name="bairro" value="<?php echo isset($bairro) ? $bairro : ''; ?>"><br>

            <label>Rua:</label><br>
            <input type="text" name="rua" value="<?php echo isset($rua) ? $rua : ''; ?>"><br>

            <label>Numero:</label><br>
            <input type="text" name="numero" value="<?php echo isset($numero) ? $numero : ''; ?>"><br>

            <label>Complemento:</label><br>
            <input type="text" name="complemento" value="<?php echo isset($complemento) ? $complemento : ''; ?>"><br>

            <label><label style='color: red '>*</label>Email:</label><br>
            <input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>"><br>

            <label><label style='color: red '>*</label>Senha:</label><br>
            <input type="text" name="senha" value="<?php echo isset($senha) ? $senha : ''; ?>"><br>


            <input type="submit" value="Cadastrar pessoa" name="cadUsuarioSIM"><br>
        <?php } ?>

    </form>

</body>

</html>
