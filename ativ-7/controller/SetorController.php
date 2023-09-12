<?php
require_once 'model/Setor.php';
require_once 'model/SetorDto.php';

class SetorController implements ModelController {
    public function listar(): void {
        $_REQUEST['setores'] = Setor::listar();
        require_once 'view/SetorView.php';
    }

    public function incluir(): void {
        $setor = new SetorDto($_POST['nomeSetor']);
        Setor::incluir($setor);
    }

    public function alterar(): void {
        $setor = new SetorDto($_POST['nomeSetor']);
        Setor::alterar($setor);
    }

    public function excluir(): void {
        Setor::excluir($_POST['codSetor']);
    }

}
