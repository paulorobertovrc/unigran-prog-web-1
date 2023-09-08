<div>
    <h1>CIDADES</h1>
    <?php
    echo "<form method='post'>";
    echo "<label for='descricao'>Nome: </label>";
    echo "<input type='text' name='nome' id='nome'>";

    echo "<label for='uf'>Estado: </label>";
    echo "<input type='text' name='uf' id='uf'>";

    echo "<input type='submit' value='Cadastrar' name='cadastrar'></form><br>";

    if (isset($_POST['cadastrar'])) {
        require_once 'controller/CidadeController.php';

        $controlador = new CidadeController();
        $controlador->incluir();
        header("Location: index.php");
    }
    ?>

    <table>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Estado</th>
        </tr>
        <?php
        $cidades = $_REQUEST['cidades'];

        foreach ($cidades as $cidade) {
            echo "<tr>";
            echo "<td>" . $cidade->getCodCid() . "</td>";
            echo "<td>" . $cidade->getNome() . "</td>";
            echo "<td>" . $cidade->getUf() . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
