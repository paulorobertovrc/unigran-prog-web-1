<?php

class CidadeDto {
    private $nome;
    private $uf;

    public function __construct($nome, $uf) {
        $this->nome = $nome;
        $this->uf = $uf;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getUf() {
        return $this->uf;
    }

}
