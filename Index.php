<?php

include_once './bancoDeDadosClientes.php';

if (isset($_POST['cadUsuario'])) {
    $mostrarInputs = true;
} else {
    $mostrarInputs = false;
}

if (isset($_POST['irProtocolo'])) {
    header('Location: protocolo.php');
    exit;
}

if (isset($_POST['cadUsuarioSIM'])) {
    
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

    
    if (empty($nome) || empty($dataDeNascimento) || empty($cpf) || empty($sexo) || empty($email) || empty($senha)) {
        echo "Complete todos os campos";
        $mostrarInputs = true;
    } else {
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "usuarios";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

       
        if (!$conn) {
            die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
        }

        
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

        
        $sqlVerificacao = "SELECT * FROM usuarios WHERE senha = '$senha' OR cpf = '$cpf'";
        $resultVerificacao = mysqli_query($conn, $sqlVerificacao);

        if (mysqli_num_rows($resultVerificacao) > 0) {
            echo "Senha ou CPF já cadastrado";
            $mostrarInputs = true;
        } else {
            $sql = "INSERT INTO usuarios (nome, data_nascimento, cpf, sexo, cidade, bairro, rua, numero, complemento, email, senha) VALUES ('$nome', '$dataDeNascimento', '$cpf', '$sexo', '$cidade', '$bairro', '$rua', '$numero', '$complemento', '$email', '$senha')";

            if (mysqli_query($conn, $sql)) {
                header('Location: protocolo.php');
                exit;
            } else {
                
                echo "Erro ao executar a consulta: " . mysqli_error($conn);
            }
        }

        
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Página de login</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>
    <h1>Prefeitura Municipal de São Leopoldo</h1>

    <form name="cad-usuario" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php if (!$mostrarInputs) { ?>
            <h2>Bem vindo ao cadastro de pessoa</h2>
            <label>Clique abaixo caso queira cadastrar uma pessoa:</label><br>
            <label>Após o cadastro, você será redirecionado para tela de protocolos</label>

            <input type="submit" value="Cadastrar pessoa" name="cadUsuario"><br><break>

            <label>Caso já tenha um cadastro, clique no botão abaixo e abra seu ticket!</label>

            <input type="submit" value="Criar Protocolos" name="irProtocolo">

        <?php } else { ?>
            <p>Todas as caixas de textos que possuirem * são informações necessárias</p>

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
