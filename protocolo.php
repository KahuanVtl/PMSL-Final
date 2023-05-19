<?php
include_once './bancoDeDadosClientes.php';

$mostrarFormulario = true; 

if (isset($_POST['testaLogin'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $consulta = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
    
    $stmt = $conn->prepare($consulta);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $mostrarFormulario = false;
    } else {
        echo "Email e/ou senha incorretos.";
        $mostrarFormulario = true;
    }
    
    $stmt = null;
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Seu código do cabeçalho aqui -->
</head>

<body>
    <h1 style="font-weight: bold;">Prefeitura Municipal de São Leopoldo</h1>
    

    <?php if ($mostrarFormulario) { ?>
        <form method="post">

            <h2>Bem Vindo ao Cadastro de Protocolos</h2>

            <label>Clique abaixo para fazer login:</label><br><br>
            
            <input type="text" placeholder="E-mail" name="email"><br><br>
            <input type="password" placeholder="Senha" name="senha"><br><br>
            <input type="submit" name="testaLogin" value="Confirmar">
        </form>
    <?php } else { ?>
        <form action="">
            <!-- Seu código do formulário aqui -->
            <label>aaaaaaa</label>
        </form>
    <?php } ?>

</body>

</html>
