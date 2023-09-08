<?php

class VendedorDto {
    private $nome;
    private $salario;
    private $codSetor;

    public function __construct($nome, $salario, $codSetor) {
        $this->nome = $nome;
        $this->salario = $salario;
        $this->codSetor = $codSetor;
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