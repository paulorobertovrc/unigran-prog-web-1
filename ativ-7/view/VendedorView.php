<div>
    <h1>VENDEDORES</h1>
    <?php
    echo "<form method='post'>";
    echo "<label for='nome'>Nome: </label>";
    echo "<input type='text' name='nome' id='nome'>";

    echo "<label for='salario'>Salário: </label>";
    echo "<input type='text' name='salario' id='salario'>";

    echo "<label for='setor'>Setor: </label>";
    echo "<input type='text' name='setor' id='setor'>";

    echo "<input type='submit' value='Cadastrar' name='cadastrarVendedor'></form><br>";

    if (isset($_POST['cadastrarVendedor'])) {
        require_once 'controller/VendedorController.php';

        $controlador = new VendedorController();
        $controlador->incluir();

        header("Location: index.php");
    }
    ?>

    <table>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Salário</th>
            <th>Setor</th>
        </tr>
        <?php
        $vendedores = $_REQUEST['vendedores'];

        foreach ($vendedores as $vendedor) {
            echo "<form method='post' id='form' name='form'>";
            echo "<tr>";
            echo "<td>" . $vendedor->getCodvend() . "</td>";
            echo "<td>" . $vendedor->getNome() . "</td>";
            echo "<td>" . $vendedor->getSalario() . "</td>";
            echo "<td>" . $vendedor->getCodSetor() . "</td>";
//            echo "<td>" . Setor::buscar($vendedor->getCodSetor())->getNome() . "</td>"; TODO: Falta implementar setor
            echo "<td><button type='submit' name='alterarVendedor' id='alterarVendedor' value='"
                . $vendedor->getCodvend() . "'>Alterar</button></td>";
            echo "<td><button type='submit' name='excluirVendedor' id='excluirVendedor' value='"
                . $vendedor->getCodvend() . "'>Excluir</button></td>";
            echo "</tr>";
            echo "</form>";
        }

        echo "</table><br><br>";

        if (isset($_POST['alterarVendedor'])) {
            require_once 'controller/VendedorController.php';
            $controller = new VendedorController();

            $codVend = $_POST['alterarVendedor'];
            $vendedorSelecionado = $controller->buscar($codVend);

            echo "<h3>ALTERANDO VENDEDOR " . $vendedorSelecionado->getCodvend() . "</h3>";

            echo "<form method='post' id='formAlterarVendedor' name='formAlterarVendedor'>";
            echo "<label for='nome'>Nome: </label>";
            echo "<input type='text' name='nome' id='nome' value='" . $vendedorSelecionado->getNome() . "'>";
            echo "<label>Salário: </label>";
            echo "<input type='text' name='salario' id='salario' value='" . $vendedorSelecionado->getSalario() . "'>";
            echo "<label>Setor: </label>"; // TODO: Falta implementar setor
            echo "<input type='text' name='setor' id='setor' value='" . $vendedorSelecionado->getCodSetor() . "'>";
            echo "<input type='hidden' name='codvend' id='codvend' value='" . $vendedorSelecionado->getCodvend() . "'>";
            echo "<input type='submit' value='Atualizar' name='formAlterarVendedor' id='formAlterarVendedor'>";
            echo "</form>";
        }

        if (isset($_POST['formAlterarVendedor'])) {
            $controlador = new VendedorController();
            $controlador->alterar();
            header("Location: index.php");
        }

        if (isset($_POST['excluirVendedor'])) {
            $codCli = $_POST['excluirVendedor'];
            $controller = new VendedorController();
            $controller->excluir();
            header("Location: index.php");
        }
        ?>
</div>
