<?php

class ClienteDto {
    private $nome;
    private $endereco;
    private $bairro;
    private $cep;
    private $telefone;
    private $cpf;
    private $ie;
    private $codCid;

    public function __construct($nome, $endereco, $bairro, $cep, $telefone, $cpf, $ie, $codCid) {
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->bairro = $bairro;
        $this->cep = $cep;
        $this->telefone = $telefone;
        $this->cpf = $cpf;
        $this->ie = $ie;
        $this->codCid = $codCid;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
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

}