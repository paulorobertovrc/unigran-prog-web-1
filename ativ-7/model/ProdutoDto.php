<?php

class ProdutoDto {
    private $descricao;
    private $unidade;
    private $valorun;

    public function __construct($descricao, $unidade, $valorun) {
        $this->descricao = $descricao;
        $this->unidade = $unidade;
        $this->valorun = $valorun;
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

    public function getValorun() {
        return $this->valorun;
    }

    public function setValorun($valorun) {
        $this->valorun = $valorun;
    }

}
