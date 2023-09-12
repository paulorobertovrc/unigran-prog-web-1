<div>
    <h1>SETORES</h1>
    <?php
    echo "<form method='post'>";
    echo "<label for='nomeSetor'>Nome do setor: </label>";
    echo "<input type='text' name='nomeSetor' id='nomeSetor'>";

    echo "<input type='submit' value='Cadastrar' name='cadastrarSetor'></form><br>";

    if (isset($_POST['cadastrarSetor'])) {
        require_once 'controller/SetorController.php';

        $controlador = new SetorController();
        $controlador->incluir();
        header("Location: index.php");
    }
    ?>

    <table>
        <tr>
            <th>Código</th>
            <th>Nome do setor</th>
        </tr>
        <?php
        $setores = $_REQUEST['setores'];

        foreach ($setores as $setor) {
            echo "<tr>";
            echo "<td>" . $setor->getCodSetor() . "</td>";
            echo "<td>" . $setor->getNomeSetor() . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
