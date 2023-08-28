<?php
require_once "Conexao.php";

$conn = new Conexao();
$tabelaVazia = $conn->tabelaVazia();

if (isset($_GET[$usuario['id']])) {
    $id = array_keys($_GET)[0];

    $usuario = $conn->buscarUsuario($id);
    $nomeAtual = $usuario['nome'];
    $emailAtual = $usuario['email'];

    echo "<form method='post'><label>Nome<input type='text' name='nome' id='nome'value='$nomeAtual'></label>";
    echo "<label>E-mail<input type='email' name='email' id='email' value='$emailAtual'></label><br><br>";
    echo "<input type='submit' value='Alterar'><br><br></form>";

    if (isset($_POST['nome']) && isset($_POST['email'])) {
        $nomeAlterado = $_POST['nome'];
        $emailAlterado = $_POST['email'];

        $conn->alterarUsuario($id, $nomeAlterado, $emailAlterado);

        echo "Usuário alterado com sucesso!";

        header("Refresh:1");
    }

}
