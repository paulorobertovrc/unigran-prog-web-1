<?php

class SetorDto {
    private $nomeSetor;

    public function __construct($nomeSetor) {
        $this->nomeSetor = $nomeSetor;
    }

    public function getNomeSetor() {
        return $this->nomeSetor;
    }

    public function setNomeSetor($nomeSetor) {
        $this->nomeSetor = $nomeSetor;
    }

}