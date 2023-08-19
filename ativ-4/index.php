<?php
require_once "q1/Pessoa.php";
require_once "q2/Medico.php";
require_once "q3/Paciente.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atividade 4</title>
</head>
<body>
    <h1>Atividade 4</h1>
    <h2>Questão 1</h2>
    <h4>Crie um código em PHP que implementa um objeto Pessoa e armazene NOME, IDADE e CPF.
        Você deve criar os getters e setters para cada um dos atributos.
    </h4>
    <p>
        <?php
        $pessoa = new Pessoa("João", 20, "123.456.789-00");
        echo $pessoa->toString();
        ?>
    </p>

    <h2>Questão 2</h2>
    <h4>Crie um código em PHP que implementa um objeto Médico que herda os atributos e funções da classe Pessoa.
        Essa classe ainda deve ter um atributo para armazenar o CRM do médico.
        Você deve criar o getter e setter para esse atributo.
    </h4>
    <p>
        <?php
        $medico = new Medico("Maria", 30, "987.654.321-00");
        $medico->setCrm("123456");
        echo $medico->toString();
        ?>
    </p>

    <h2>Questão 3</h2>
    <h4>Crie um código em PHP que implementa um objeto Paciente que herda os atributos e funções da classe Pessoa.
        Essa classe ainda deve ter uma agregação com a classe Médico, já que o Paciente poderá ter um médico agregado.
    </h4>
    <p>
        <?php
        $paciente = new Paciente("José", 40, "111.222.333-44");
        $paciente->setMedico($medico);
        echo $paciente->toString();
        ?>
    </p>
</body>
</html>
