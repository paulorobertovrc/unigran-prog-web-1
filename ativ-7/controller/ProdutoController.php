<?php
require_once 'model/Produto.php';
require_once 'model/ProdutoDto.php';

class ProdutoController implements ModelController {
    public function listar() {
        $_REQUEST['produtos'] = Produto::listar();
        require_once 'view/ProdutoView.php';
    }

    public function incluir() {
        $produto = new ProdutoDto($_POST['descricao'], $_POST['unidade'], $_POST['valorUn']);
        Produto::incluir($produto);
    }

    public function alterar() {
        $produto = new Produto($_POST['codprod'], $_POST['descricao'], $_POST['unidade'], $_POST['valorUn']);
        Produto::alterar($produto);
    }

    public function excluir() {
        Produto::excluir($_POST['codprod']);
    }

}