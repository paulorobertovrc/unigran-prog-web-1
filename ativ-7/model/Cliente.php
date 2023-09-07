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
        $conn->query($sql);
    }

    public static function alterar($cliente) {
        $clienteAlterado = $cliente;

        if ($clienteAlterado->getCodCid() == "") {
            $clienteAlterado->setCodCid(0);
        }

        if ($clienteAlterado->getIe() == "") {
            $clienteAlterado->setIe(0);
        }

        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "UPDATE cliente SET "
            . "nome = '" . $clienteAlterado->getNome() . "', "
            . "endereco = '" . $clienteAlterado->getEndereco() . "', "
            . "bairro = '" . $clienteAlterado->getBairro() . "', "
            . "cep = '" . $clienteAlterado->getCep() . "', "
            . "telefone = '" . $clienteAlterado->getTelefone() . "', "
            . "cpf = '" . $clienteAlterado->getCpf() . "', "
            . "ie = '" . $clienteAlterado->getIe() . "' "
            . "WHERE codcli = '" . $clienteAlterado->getCodcli() . "'";
        $conn->query($sql);
    }

    public static function excluir($codcli) {
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "DELETE FROM cliente WHERE codcli = '" . $codcli . "'";
        $conn->query($sql);
    }

    public static function buscar($codCli) {
        echo "Buscando cliente " . $codCli . "<br>";
        $conn = ConexaoBD::getInstance()->getConexao();
        $sql = "SELECT * FROM cliente WHERE codcli = '" . $codCli . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cliente = new Cliente($row["codcli"], $row["nome"], $row["endereco"], $row["bairro"], $row["cep"],
                $row["telefone"], $row['cpf'] , $row["ie"], $row["codcid"]);

            if ($cliente->getCodCid() == "") {
                $cliente->setCodCid(null);
            }

            if ($cliente->getIe() == "") {
                $cliente->setIe(null);
            }

            return $cliente;
        }

        return null;
    }

}