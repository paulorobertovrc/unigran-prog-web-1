<?php
    require_once 'Conexao.php';

    $conn = new Conexao();
    $tabelaVazia = $conn->tabelaVazia();
    $usuarioJaExiste = false;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atividade 6</title>
</head>
<body>
    <h1>Atividade 6</h1>

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

            if (!$conn->verificarEntradaDuplicada($email)) {
                $conn->cadastrarUsuario($nome, $email);
            }

        }
    ?>

    <br><br>

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
                    $usuariosCadastrados = $conn->buscar("SELECT * FROM usuarios");

                    while ($usuario = $usuariosCadastrados->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $usuario['id'] . "</td>";
                        echo "<td>" . $usuario['nome'] . "</td>";
                        echo "<td>" . $usuario['email'] . "</td>";

                        echo "<form method='get' action='index.php'>";
                        echo "<td><input type='submit' value='Alterar' name='" . $usuario['id'] . "'></td>";
                        echo "<td><input type='submit' value='Excluir' name='" . $usuario['id'] . "'></td>
                            </form>";

                        if (isset($_GET[$usuario['id']])) {
                            if ($_GET[$usuario['id']] == 'Alterar') {
                                include_once 'q1.php';
                            } else if ($_GET[$usuario['id']] == 'Excluir') {
    //                            include_once 'q2.php';
                            }
                        }

                        echo "</tr>";
                    }
                } else {
                    echo "Não há dados cadastrados na tabela!" . "<br><br>";
                }
            ?>
        </tbody>
    </table>

    <h2>Questão 1</h2>
    <h4>Crie um código em PHP que implementa na API descrita no material de aula a função de alterar algum dado no
        banco de dados.
    </h4>
    <?php
//        include_once 'q1.php';
    ?>

<!--    <h2>Questão 2</h2>-->
<!--    <h4>..........-->
<!--    </h4>-->
<!--    --><?php
//        include_once 'q2.php';
//    ?>

</body>
</html>