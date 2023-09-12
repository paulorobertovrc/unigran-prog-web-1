<div>
    <h1>PRODUTOS</h1>
    <?php
    echo "<form method='post'>";
    echo "<label for='descricao'>Descrição: </label>";
    echo "<input type='text' name='descricao' id='descricao'>";

    echo "<label for='unidade'>Unidade: </label>";
    echo "<input type='text' name='unidade' id='unidade'>";

    echo "<label for='valorUn'>Valor Unitário: </label>";
    echo "<input type='text' name='valorUn' id='valorUn'>";

    echo "<input type='submit' value='Cadastrar' name='cadastrar'></form><br>";

    if (isset($_POST['cadastrar'])) {
        require_once 'controller/ProdutoController.php';

        $controlador = new ProdutoController();
        $controlador->incluir();
        header("Location: index.php");
    }
    ?>

    <table>
        <tr>
            <th>Código</th>
            <th>Descrição</th>
            <th>Unidade</th>
            <th>Valor Unitário</th>
        </tr>
        <?php
        $produtos = $_REQUEST['produtos'];

        echo "<form method='post' id='form' name='form'>";

        foreach ($produtos as $produto) {
            echo "<tr>";
            echo "<td>" . $produto->getCodprod() . "</td>";
            echo "<td>" . $produto->getDescricao() . "</td>";
            echo "<td>" . $produto->getUnidade() . "</td>";
            echo "<td>" . $produto->getValorun() . "</td>";
            echo "<td><button type='submit' name='alterar' id='alterar' value='". $produto->getCodprod()
                .  "'>Alterar</button></td>";
            echo "<td><button type='submit' name='excluir' id='excluir' value='". $produto->getCodprod()
                .  "'>Excluir</button></td>";
            echo "</tr>";
        }

        echo "</form>";
        ?>
    </table>

    <?php
    if (isset($_POST['alterar'])) {
        $produtoSelecionado = new Produto(null, null, null, null);

        foreach ($produtos as $produto) {
            if ($produto->getCodprod() == $_POST['alterar']) {
                $produtoSelecionado->setCodprod($produto->getCodprod());
                $produtoSelecionado->setDescricao($produto->getDescricao());
                $produtoSelecionado->setUnidade($produto->getUnidade());
                $produtoSelecionado->setValorUn($produto->getValorun());
            }
        }

        echo "<h3>ALTERANDO PRODUTO " . $produtoSelecionado->getCodprod() . "</h3>";
        echo "<form method='post' id='formAlterar' name='formAlterar'>";
        echo "<label>Descrição<input type='text' name='descricao' id='descricao' value='"
            . $produtoSelecionado->getDescricao() . "'></label>";
        echo "<label>   Unidade<input type='text' name='unidade' id='unidade' value='" . $produtoSelecionado->getUnidade() .
            "'></label>";
        echo "<label>   Valor Unitário<input type='text' name='valorUn' id='valorUn' value='"
            . $produtoSelecionado->getValorun() . "'></label>";
        echo "<input type='hidden' name='codprod' id='codprod' value='" . $produtoSelecionado->getCodprod() . "'>";
        echo "<input type='hidden' name='confirmarAlteracao' id='confirmarAlteracao' value='confirmarAlteracao'>";
        echo "<td><button type='submit' name='alterar' id='alterar' value='alterar'>Alterar</button></td>";
        echo "<td><button type='submit' name='cancelar' id='cancelar' value='cancelar'>Cancelar</button></td>";
        echo "</form>";

        if (isset($_POST['confirmarAlteracao'])) {
            $controller = new ProdutoController();
            $controller->alterar($_POST['codprod']);
            header("Location: index.php");
        }
    }

    if (isset($_POST['excluir'])) {
        $codProd = $_POST['excluir'];
        Produto::excluir($codProd);
        header("Location: index.php");
    }

    ?>
</div>
