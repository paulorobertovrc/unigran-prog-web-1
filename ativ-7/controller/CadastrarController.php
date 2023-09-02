<?php

class CadastrarController {
    public function exibirFormulario() {
        echo "<h2>CADASTRAR NOVO PRODUTO</h2>";
        echo "<form method='post'>";
        echo "<label for='descricao'>Descrição: </label>";
        echo "<input type='text' name='descricao' id='descricao'>";

        echo "<label for='unidade'>Unidade: </label>";
        echo "<input type='text' name='unidade' id='unidade'>";

        echo "<label for='valorUn'>Valor Unitário: </label>";
        echo "<input type='text' name='valorUn' id='valorUn'>";

        echo "<input type='submit' value='Cadastrar' name='cadastrar'>";

        if (isset($_POST['cadastrar'])) {
            require_once 'controller/ProdutoController.php';

            $controlador = new ProdutoController();
            $controlador->incluir();
            header("Location: index.php");
        }
    }

}
