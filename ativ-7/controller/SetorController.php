<?php
require_once 'model/Setor.php';
require_once 'model/SetorDto.php';

class SetorController implements ModelController {
    public function listar() {
        $_REQUEST['setores'] = Setor::listar();
        require_once 'view/SetorView.php';
    }

    public function incluir() {
        $setor = new SetorDto($_POST['nomeSetor']);
        Setor::incluir($setor);
    }

    public function alterar() {
//        $cidade = new Cidade($_POST['codCid'], $_POST['nome'], $_POST['uf']);
//        Cidade::alterar($cidade);
    }

    public function excluir() {
//        Cidade::excluir($_POST['codCid']);
    }

}
