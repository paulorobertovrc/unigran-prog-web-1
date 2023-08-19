<?php
class Paciente extends Pessoa {
    private $medico;

    public function setMedico($medico)
    {
        $this->medico = $medico;
    }

    public function getMedico()
    {
        return $this->medico;
    }

    public function toString() {
        return "Dados do paciente<br>" . parent::toString()
            . "<br><br>Dados do médico<br>" . $this->medico->toString();
    }

}
