<?php

$conn = new Conexao();

if (isset($_GET[$dadosInformados['id']])) {
    $id = array_keys($_GET)[0];
    $usuario = $conn->buscarUsuarioPorId($id);

    if (!empty($usuario)) {
        echo "<form method='post'><label>Nome<input type='text' name='nome' id='nome' value='" . $usuario['nome'] . "'></label>";
        echo "<label>E-mail<input type='email' name='email' id='email' value='" . $usuario['email'] . "'></label><br><br>";
        echo "<input type='submit' value='Alterar'><br><br></form>";

        if (isset($_POST['nome']) && isset($_POST['email'])) {
            $nomeAlterado = $_POST['nome'];
            $emailAlterado = $_POST['email'];

            $conn->alterarUsuario($id, $nomeAlterado, $emailAlterado);

            header("Location: index.php");
        }
    }

}
