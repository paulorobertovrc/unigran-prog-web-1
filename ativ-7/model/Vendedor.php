<?php

class Vendedor {
    private $codvend;
    private $nome;
    private $salario;
    private $codSetor;

    public function __construct($codvend, $nome, $salario, $codSetor) {
        $this->codvend = $codvend;
        $this->nome = $nome;
        $this->salario = $salario;
        $this->codSetor = $codSetor;
    }

    public static function listar(): array {
        $vendedores = array();
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "SELECT * FROM vendedor";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $vendedores[] = new Vendedor($row["codvend"], $row["nomevend"], $row["salario"], $row["codsetor"]);
            }
        }

        return $vendedores;
    }

    /**
     * @throws EntidadeNaoEncontradaException
     */
    public static function buscar($codVend): Vendedor {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "SELECT * FROM vendedor WHERE codvend = " . $codVend;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Vendedor($row["codvend"], $row["nomevend"], $row["salario"], $row["codsetor"]);
        }

        throw new EntidadeNaoEncontradaException("Vendedor não encontrado!");
    }

    public static function incluir(VendedorDto $vendedor): void {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "INSERT INTO vendedor (nomevend, salario, codsetor) VALUES ('"
            . $vendedor->getNome() . "', "
            . $vendedor->getSalario() . ", "
            . $vendedor->getCodSetor() . ")";

        if ($conn->query($sql) === TRUE) {
            echo "Vendedor incluído com sucesso!";
        } else {
            echo "Erro ao incluir vendedor: " . $conn->error;
        }

    }

    public static function alterar(Vendedor $vendedor): void {
//        try {
//            Setor::buscar($vendedor->getCodSetor());
//        } catch (EntidadeNaoEncontradaException $e) {
//            echo $e->getMessage();
//            return;
//        }

        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "UPDATE vendedor SET nomevend = '" . $vendedor->getNome() . "', salario = " . $vendedor->getSalario() .
            ", codsetor = " . $vendedor->getCodSetor() . " WHERE codvend = " . "'" . $vendedor->getCodvend() . "'";

        $conn->query($sql);
    }

    public static function excluir(): void {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "DELETE FROM vendedor WHERE codvend = " . $_POST['excluirVendedor'];
        $conn->query($sql);

    }

    public function getCodvend() {
        return $this->codvend;
    }

    public function setCodvend($codvend) {
        $this->codvend = $codvend;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        if (strlen($nome) > 0) {
            $this->nome = $nome;
        }
    }

    public function getSalario() {
        return $this->salario;
    }

    public function setSalario($salario) {
        if ($salario > 0) {
            $this->salario = $salario;
        }
    }

    public function getCodSetor() {
        return $this->codSetor;
    }

    public function setCodSetor($codSetor) {
        $this->codSetor = $codSetor;
    }

}