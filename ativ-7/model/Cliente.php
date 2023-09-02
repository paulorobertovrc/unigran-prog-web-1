<?php

class Cliente {
    private $codcli;
    private $nome;
    private $endereco;
    private $bairro;
    private $cep;
    private $telefone;
    private $cpf;
    private $ie;
    private $codCid;

    public function __construct($codcli, $nome, $endereco, $bairro, $cep, $telefone, $cpf, $ie, $codCid) {
        $this->codcli = $codcli;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->bairro = $bairro;
        $this->cep = $cep;
        $this->telefone = $telefone;
        $this->cpf = $cpf;
        $this->ie = $ie;
        $this->codCid = $codCid;
    }

    public function getCodcli() {
        return $this->codcli;
    }

    public function setCodcli($codcli) {
        $this->codcli = $codcli;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome= $nome;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getIe() {
        return $this->ie;
    }

    public function setIe($ie) {
        $this->ie = $ie;
    }

    public function getCodCid() {
        return $this->codCid;
    }

    public function setCodCid($codCid) {
        $this->codCid = $codCid;
    }

    public static function listar(): array
    {
        $clientes = array();
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "SELECT * FROM cliente";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $clientes[] = new Cliente($row["codcli"], $row["nome"], $row["endereco"], $row["bairro"], $row["cep"],
                    $row["telefone"], $row['cpf'] , $row["ie"], $row["codcid"]);
            }
        }

        return $clientes;
    }

    public static function incluir(ClienteDto $cliente) {
        echo "Incluindo cliente " . $cliente->getNome() . "<br>";
        echo "Cidade: " . $cliente->getCodCid() . "<br>";
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "INSERT INTO cliente (nome, endereco, bairro, cep, telefone, cpf, ie, codcid) VALUES ('"
            . $cliente->getNome() . "', '" . $cliente->getEndereco() . "', '" . $cliente->getBairro() . "', '"
            . $cliente->getCep() . "', '" . $cliente->getTelefone() . "', '" . $cliente->getCpf(). "', '"
            . $cliente->getIe() . "', '" . $cliente->getCodCid() . "')";
        echo $sql;
        $conn->query($sql);
    }

    public static function alterar($cliente) {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "UPDATE cliente SET "
            . "nome = '" . $cliente->getNome() . "', "
            . "endereco = '" . $cliente->getEndereco() . "', "
            . "bairro = '" . $cliente->getBairro() . "', "
            . "cep = '" . $cliente->getCep() . "', "
            . "telefone = '" . $cliente->getTelefone() . "', "
            . "cpf = '" . $cliente->getCpf() . "', "
            . "ie = '" . $cliente->getIe() . "', "
            . "codcid = '" . $cliente->getCodCid() . "' "
            . "WHERE codcli = " . $cliente->getCodcli();
        $conn->query($sql);
    }

    public static function excluir($codcli) {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "DELETE FROM cliente WHERE codcli = " . $codcli;
        $conn->query($sql);
    }

}