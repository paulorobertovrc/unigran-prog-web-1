<table>
    <tr>
        <th>Código</th>
        <th>Descrição</th>
        <th>Unidade</th>
        <th>Valor Unitário</th>
    </tr>
    <?php
    $produtos = $_REQUEST['produtos'];

    foreach ($produtos as $produto) {
        echo "<form method='post' id='form' name='form'>";
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
        echo "</form>";
    }
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
