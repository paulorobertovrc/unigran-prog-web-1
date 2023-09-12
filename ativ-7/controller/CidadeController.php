<?php
require_once 'model/Cidade.php';
require_once 'model/CidadeDto.php';

class CidadeController implements ModelController {
    public function listar() {
        $_REQUEST['cidades'] = Cidade::listar();
        require_once 'view/CidadeView.php';
    }

    public function incluir() {
        $cidade = new CidadeDto($_POST['nome'], $_POST['uf']);
        Cidade::incluir($cidade);
    }

    public function alterar() {
        $cidade = new Cidade($_POST['codCid'], $_POST['nome'], $_POST['uf']);
        Cidade::alterar($cidade);
    }

    public function excluir() {
        Cidade::excluir($_POST['codCid']);
    }

}
