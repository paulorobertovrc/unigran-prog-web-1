<?php
require_once 'Usuario.php';
require_once 'Conexao.php';

$conn = new Conexao();
$tabelaVazia = $conn->tabelaVazia();
?>

<h2>CADASTRO DE USUÁRIOS</h2>
    <p>Para utilizar as funcionalidades da aplicação, por favor cadastre os usuários desejados.</p>
    <form method="post">
        <label>
Nome
            <input type="text" name="nome" id="nome">
        </label>
        <label>
E-mail
            <input type="email" name="email" id="email">
        </label>
        <br><br>
        <input type="submit" value="Cadastrar">
        <br><br>
    </form>
    <?php
        if (isset($_POST['nome']) && isset($_POST['email'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];

            $conn->cadastrarUsuario($nome, $email);

            header("Location: index.php");
        }
    ?>

