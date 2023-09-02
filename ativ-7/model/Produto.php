<?php

class Produto {
    private $codprod;
    private $descricao;
    private $unidade;
    private $valorUn;

    public function __construct($codprod, $descricao, $unidade, $valorUn) {
        $this->codprod = $codprod;
        $this->descricao = $descricao;
        $this->unidade = $unidade;
        $this->valorUn = $valorUn;
    }

    public function getCodprod() {
        return $this->codprod;
    }

    public function setCodprod($codprod) {
        $this->codprod = $codprod;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getUnidade() {
        return $this->unidade;
    }

    public function setUnidade($unidade) {
        $this->unidade = $unidade;
    }

    public function getValorUn() {
        return $this->valorUn;
    }

    public function setValorUn($valorUn) {
        $this->valorUn = $valorUn;
    }

    public static function listar(): array {
        $produtos = array();
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "SELECT * FROM produto";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produtos[] = new Produto($row["codprod"], $row["descricao"], $row["unidade"], $row["valor_un"]);
            }
        }

        return $produtos;
    }

    public static function incluir($produto) {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "INSERT INTO produto (descricao, unidade, valor_un) VALUES ('"
            . $produto->getDescricao() . "', '"
            . $produto->getUnidade() . "', "
            . $produto->getValorUn() . ")";
        $conn->query($sql);
    }

    public static function alterar($produto) {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "UPDATE produto SET "
            . "descricao = '" . $produto->getDescricao() . "', "
            . "unidade = '" . $produto->getUnidade() . "', "
            . "valor_un = " . $produto->getValorUn() . " "
            . "WHERE codprod = " . $produto->getCodprod();
        $conn->query($sql);
    }

    public static function excluir($codProdSelecionado) {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "DELETE FROM produto WHERE codprod = $codProdSelecionado";
        $conn->query($sql);
    }

}
