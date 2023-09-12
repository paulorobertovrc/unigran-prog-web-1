<?php

class Setor {
    private $codSetor;
    private $nomeSetor;

    public function __construct($codSetor, $nomeSetor) {
        $this->codSetor = $codSetor;
        $this->nomeSetor = $nomeSetor;
    }

    public static function listar(): array {
        $setores = array();
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "SELECT * FROM setor";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $setores[] = new Setor($row["codsetor"], $row["nomesetor"]);
            }
        }

        return $setores;
    }

    public static function incluir(SetorDto $setor) {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "INSERT INTO setor (nomesetor) VALUES ('" . $setor->getNomeSetor() . "')";
        $conn->query($sql);
    }

    /**
     * @throws EntidadeNaoEncontradaException
     */
    public static function buscar($codSetor): Setor {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "SELECT * FROM setor WHERE codsetor = " . $codSetor;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Setor($row["codsetor"], $row["nomesetor"]);
        } else {
            require_once 'exception/EntidadeNaoEncontradaException.php';
            throw new EntidadeNaoEncontradaException("Setor não encontrado");
        }

    }

    public static function alterar(Setor $setor) {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "UPDATE setor SET nomesetor = '" . $setor->getNomeSetor() . "' WHERE codsetor = "
            . $setor->getCodSetor();
        $conn->query($sql);
    }

    public static function excluir($codSetor) {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "DELETE FROM setor WHERE codsetor = " . $codSetor;
        $conn->query($sql);
    }

    public function getCodSetor() {
        return $this->codSetor;
    }

    public function getNomeSetor() {
        return $this->nomeSetor;
    }

    public function setCodSetor($codSetor) {
        $this->codSetor = $codSetor;
    }

    public function setNomeSetor($nomeSetor) {
        $this->nomeSetor = $nomeSetor;
    }

}
