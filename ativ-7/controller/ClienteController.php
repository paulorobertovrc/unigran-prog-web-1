<?php
require_once 'model/Cliente.php';
require_once 'model/ClienteDto.php';

class ClienteController implements ModelController {
    public function listar() {
        $_REQUEST['clientes'] = Cliente::listar();
        require_once 'view/ClienteView.php';
    }

    /**
     * @throws EntidadeNaoEncontradaException
     */
    public function incluir(): void {
        $cliente = new ClienteDto($_POST['nome'], $_POST['endereco'], $_POST['bairro'], $_POST['cep'],
            $_POST['telefone'], $_POST['cpf'] , $_POST['ie'], $_POST['cidade']);

        if (empty($cliente->getCodCid())) {
            return;
        }

        if (empty($cliente->getIe())) {
            $cliente->setIe(0);
        }

        Cliente::incluir($cliente);
    }

    public function alterar() {
        $cliente = new Cliente($_POST['codcli'], $_POST['nome'], $_POST['endereco'], $_POST['bairro'], $_POST['cep'],
            $_POST['telefone'], $_POST['cpf'] , $_POST['ie'], $_POST['cidade']);

        Cliente::alterar($cliente);
    }

    public function excluir() {
        Cliente::excluir($_POST['excluirCliente']);
    }

    public function buscar($codCli) {
        return Cliente::buscar($codCli);
    }

}
