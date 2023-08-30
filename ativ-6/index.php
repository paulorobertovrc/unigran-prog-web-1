<?php
include_once 'conexao.php';

$conn = new Conexao();
$tabelaVazia = $conn->tabelaVazia();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atividade 6</title>
</head>
<body>
    <h1>Atividade 6</h1>

    <h2>LISTA DE USUÁRIOS</h2>
    <table>
        <thead>
        <?php
            if (!$tabelaVazia) {
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nome</th>";
                echo "<th>E-mail</th>";
                echo "</tr>";
            }
        ?>
        </thead>
        <tbody>
        <?php
            if (!$tabelaVazia) {
                $usuariosCadastrados = $conn->buscarTodos();

                while ($dadosInformados = $usuariosCadastrados->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $dadosInformados['id'] . "</td>";
                    echo "<td>" . $dadosInformados['nome'] . "</td>";
                    echo "<td>" . $dadosInformados['email'] . "</td>";

                    echo "<td><form method='get'><input type='submit' value='Alterar' name='" . $dadosInformados['id'] . "'></form></td>";
                    echo "<td><form method='get'><input type='submit' value='Excluir' name='" . $dadosInformados['id'] . "'></form></td>";

                    if (isset($_GET[$dadosInformados['id']])) {
                        if ($_GET[$dadosInformados['id']] == "Alterar") {
                            include_once 'alterar.php';
                        } elseif ($_GET[$dadosInformados['id']] == "Excluir") {
                            include "excluir.php";
                        }

                        echo "</tr>";
                    }
                }
            } else {
                echo "Não há dados cadastrados na tabela!" . "<br><br>";
            }
        ?>
        </tbody>
    </table>

    <h2>CADASTRAR NOVO USUÁRIO</h2>
    <form method="post">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome">

        <label for="email">E-mail: </label>
        <input type="email" name="email" id="email">

        <input type="submit" value="Cadastrar" name="cadastrar">

        <?php
            if (isset($_POST['cadastrar'])) {
                $nome = $_POST['nome'];
                $email = $_POST['email'];

                $conn->cadastrarUsuario($nome, $email);
            }
        ?>
    </form>

</body>
</html>