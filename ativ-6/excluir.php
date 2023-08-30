<?php

$conn = new Conexao();

if (isset($_GET[$dadosInformados['id']])) {
    $id = array_keys($_GET)[0];
    $usuario = $conn->buscarUsuarioPorId($id);

    if (!empty($usuario)) {
        $conn->excluirUsuario($id);

        header("Location: index.php");
    }

}
