<?php
class Medico extends Pessoa {
    private $crm;

    public function setCrm($crm)
    {
        $this->crm = $crm;
    }

    public function getCrm()
    {
        return $this->crm;
    }

    public function toString() {
        return parent::toString() . "<br>CRM: " . $this->crm;
    }

}
