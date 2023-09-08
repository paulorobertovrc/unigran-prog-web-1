<?php
require_once 'model/Vendedor.php';
require_once 'model/VendedorDto.php';

class VendedorController implements ModelController {
    public function listar(): void {
        $_REQUEST['vendedores'] = Vendedor::listar();
        require_once 'view/VendedorView.php';
    }

    public function incluir(): void {
        $vendedor = new VendedorDto($_POST['nome'], $_POST['salario'], $_POST['codsetor']);

        if (empty($vendedor->getCodSetor())) {
            return;
        }

        Vendedor::incluir($vendedor);
    }

    public function alterar() {
        $vendedor = new Vendedor($_POST['codvend'], $_POST['nome'], $_POST['salario'], $_POST['setor']);
        Vendedor::alterar($vendedor);
    }

    public function excluir(): void {
        Vendedor::excluir();
    }

    public function buscar($codVend): ?Vendedor {
        try {
            return Vendedor::buscar($codVend);
        } catch (EntidadeNaoEncontradaException $e) {
            echo $e->getMessage();
            return null;
        }
    }

}
