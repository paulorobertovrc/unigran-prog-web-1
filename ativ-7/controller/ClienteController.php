<?php
require_once 'model/Cliente.php';
require_once 'model/ClienteDto.php';

class ClienteController implements ModelController {
    public function listar() {
        $_REQUEST['clientes'] = Cliente::listar();
        require_once 'view/ClienteView.php';
    }

    public function incluir() {
        $cliente = new ClienteDto($_POST['nome'], $_POST['endereco'], $_POST['bairro'], $_POST['cep'],
            $_POST['telefone'], $_POST['cpf'] , $_POST['ie'], $_POST['cidade']);

        if ($cliente->getCodCid() == "") {
            $cliente->setCodCid(0);
        } // TODO: Fix this hack

        Cliente::incluir($cliente);
    }

    public function alterar() {
        $cliente = new Cliente($_POST['codcli'], $_POST['nome'], $_POST['endereco'], $_POST['bairro'], $_POST['cep'],
            $_POST['telefone'], $_POST['cpf'] , $_POST['ie'], $_POST['cidade']);
        Cliente::alterar($cliente);
    }

    public function excluir() {
        Cliente::excluir($_POST['codcli']);
    }

}