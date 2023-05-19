<?php
include_once './bancoDeDadosClientes.php'
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste para PMSL</title>
</head>
<body>
    <h1>Cadastrar</h1>
    
    <?php
    //recebe dados do formulário
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //verifica se usuário clicou no botão
        if (!empty($dados['cadUsuario'])){
            //var_dump($dados);
            $empty_imput = false;

            $dados = array_map('trim', $dados);
            if (in_array("", $dados)){
                $empty_imput = true;
                echo "<p style='color: #ff0000'Coloque todos os campos! Verifique o erro ou contate o suporte</p>";
            } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
                $empty_imput = true;
                echo "<p style='color: #ff0000'Preencha o campo de email válido! Verifique o erro ou contate o suporte</p>";
            }
            

            if(!$empty_imput){
            $query_usuario = "INSERT INTO usuarios (nome, email) VALUES (:nome , :email) ";
            $cad_usuario = $conn->prepare($query_usuario);
            $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
            $cad_usuario->execute();
            if($cad_usuario->rowCount()){
                echo "<p style='color: green'>Usuário cadastrado com sucesso!</p>";
                unset($dados);
            } else {
                echo "<p style='color: #ff0000'Usuário não cadastrado! Verifique o erro ou contate o suporte</p>";
        }
    }
}

    //Formulário 
    ?>
    
    <form name="cad-usuario" method="POST" action="">
        <label>Nome: </label>
        <input type="text" name="nome" id="nome" placeholder="Nome Completo" value="<?php 
        if (isset($dados['nome'])){
            echo $dados['nome'];
        } 
        ?>"><br><br>
    
        <label>E-mail: </label>
        <input type="email" name="email" id="email" placeholder="E-mail" value="<?php 
        if (isset($dados['email'])){
            echo $dados['email'];
        } 
        ?>"><br><br>

    <input type="submit" value="Cadastrar" name="cadUsuario">
    </form>
    
</body>
</html>