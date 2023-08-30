<?php
class Usuario {
    private $id;
    private $nome;
    private $email;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setId($idInput) {
        $this->id = $idInput;
    }

    public function setNome($nomeInput) {
        $this->nome = $nomeInput;
    }

    public function setEmail($emailInput) {
        $this->email = $emailInput;
    }

}
