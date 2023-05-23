<?php
include_once './bancoDeDadosClientes.php';

$mostrarFormulario = true;
$protocoloCadastrado = false;

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
}

if (isset($_POST['submitFormulario'])) {
    
    $nomeDemandante = $_POST['usuario'];
    $numero = $_POST['numero'];
    $descricao = $_POST['descricao'];
    $data = $_POST['dataEntrada'];
    $prazo = $_POST['prazo'];

    $inserirProtocolo = "INSERT INTO protocolo (NUMERO, DESCRICAO, DATA, PRAZO, NOME_DEMANDANTE) VALUES (:numero, :descricao, :data, :prazo, :nomeDemandante)";

    $stmt = $conn->prepare($inserirProtocolo);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':prazo', $prazo);
    $stmt->bindParam(':nomeDemandante', $nomeDemandante);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $protocoloCadastrado = true;
        $ultimoId = $conn->lastInsertId();
    }

    $stmt = null;
}

if (isset($_GET['excluir']) && is_numeric($_GET['excluir'])) {
    $protocoloId = $_GET['excluir'];

    $excluirProtocolo = "DELETE FROM protocolo WHERE ID = :id";
    $stmt = $conn->prepare($excluirProtocolo);
    $stmt->bindParam(':id', $protocoloId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Registro excluído com sucesso.";
    } else {
        echo "Falha ao excluir o registro.";
    }

    $stmt = null;
}

$consultaUsuarios = "SELECT nome FROM usuarios";
$stmtUsuarios = $conn->prepare($consultaUsuarios);
$stmtUsuarios->execute();
$nomesUsuarios = $stmtUsuarios->fetchAll(PDO::FETCH_COLUMN);
$stmtUsuarios = null;

$consultaProtocolos = "SELECT * FROM protocolo";
$stmtProtocolos = $conn->prepare($consultaProtocolos);
$stmtProtocolos->execute();
$protocolos = $stmtProtocolos->fetchAll(PDO::FETCH_ASSOC);
$stmtProtocolos = null;

$conn = null;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <h1 style="font-weight: bold;">Prefeitura Municipal de São Leopoldo</h1>
</head>

<body>
    
    <?php if ($mostrarFormulario && !$protocoloCadastrado) { ?>
        <form method="post">
            <h2>Bem Vindo ao Cadastro de Protocolos</h2>
            <label>Clique abaixo para fazer login:</label><br><br>
            <input type="text" placeholder="E-mail" name="email"><br><br>
            <input type="password" placeholder="Senha" name="senha"><br><br>
            <input type="submit" name="testaLogin" value="Confirmar">
        </form>
    <?php } elseif ($mostrarFormulario && $protocoloCadastrado) { ?>
        <h2>Protocolo cadastrado com sucesso! Número do protocolo: #<?php echo $ultimoId; ?></h2>
        <form method="post">
            <input type="submit" name="submitOutroFormulario" value="Cadastrar outro ticket">
        </form>
    <?php } else { ?>
        <form method="post">
            <h2>Siga o Formulário abaixo:</h2>
            <select name="usuario">
                <?php foreach ($nomesUsuarios as $nome) { ?>
                    <option value="<?php echo $nome; ?>"><?php echo $nome; ?></option>
                <?php } ?>
            </select><br><br>
            <input type="text" placeholder="Telefone" name="numero" required><br><br>
            <input type="text" placeholder="Assunto" name="descricao" required><br><br>
            <input type="text" placeholder="Data de início" name="dataEntrada" required>
            <input type="text" placeholder="Prazo" name="prazo" required><br><br>
            <input type="submit" name="submitFormulario" value="Enviar" required>
        </form>

        <h2>Protocolos Cadastrados</h2>

        <table>
            <tr>
                <th>Número</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Prazo</th>
                <th>Nome Demandante</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($protocolos as $protocolo) { ?>
                <tr>
                    <td><?php echo $protocolo['NUMERO']; ?></td>
                    <td><?php echo $protocolo['DESCRICAO']; ?></td>
                    <td><?php echo $protocolo['DATA']; ?></td>
                    <td><?php echo $protocolo['PRAZO']; ?></td>
                    <td><?php echo $protocolo['NOME_DEMANDANTE']; ?></td>
                    <td>
                        
                        
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>

</body>

</html>
