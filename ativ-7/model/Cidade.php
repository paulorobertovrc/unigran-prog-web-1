<?php

class Cidade {
    private $codCid;
    private $nome;
    private $uf;

    public function __construct($codCid, $nome, $uf) {
        $this->codCid = $codCid;
        $this->nome = $nome;
        $this->uf = $uf;
    }

    public static function listar(): array {
        $cidades = array();
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "SELECT * FROM cidade";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cidades[] = new Cidade($row["codcid"], $row["nomecid"], $row["uf"]);
            }
        }

        return $cidades;
    }

    public static function incluir(CidadeDto $cidade) {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "INSERT INTO cidade (nomecid, uf) VALUES ('" . $cidade->getNome() . "', '" . $cidade->getUf() . "')";
        $conn->query($sql);
    }

    /**
     * @throws EntidadeNaoEncontradaException
     */
    public static function buscar($getCodCid): Cidade {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "SELECT * FROM cidade WHERE codcid = " . $getCodCid;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Cidade($row["codcid"], $row["nomecid"], $row["uf"]);
        } else {
            require_once 'exception/EntidadeNaoEncontradaException.php';
            throw new EntidadeNaoEncontradaException("Cidade não encontrada");
        }

    }

    public function getCodCid() {
        return $this->codCid;
    }

    public function setCodCid($codCid) {
        $this->codCid = $codCid;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome= $nome;
    }

    public function getUf() {
        return $this->uf;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }

}
