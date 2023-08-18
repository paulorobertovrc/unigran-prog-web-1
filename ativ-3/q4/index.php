<?php

session_start();

$nome = $_GET['nome'];
$idade = $_GET['idade'];

if ($nome == "" || $idade == "") {
    echo "Todos os campos do formulário devem ser preenchidos!";
    exit;
}

$_SESSION['nome'] = $nome;
$_SESSION['idade'] = $idade;
$_SESSION['voto'] = array([
    'podeVotar' => null,
    'tipoVoto' => null
]);

if ($idade < 16) {
    $_SESSION['voto']['podeVotar'] = false;
} else if (($idade < 18) || $idade > 70) {
    $_SESSION['voto']['podeVotar'] = true;
    $_SESSION['voto']['tipoVoto'] = "Facultativo";
} else {
    $_SESSION['voto']['podeVotar'] = true;
    $_SESSION['voto']['tipoVoto'] = "Obrigatório";
}

echo "Dados armazenados nas variáveis de sessão: <br><br>";
echo "Nome: {$_SESSION['nome']}<br>";
echo "Idade: {$_SESSION['idade']}<br>";
echo "Pode votar: ";
if ($_SESSION['voto']['podeVotar']) {
    echo "Sim<br>";
} else echo "Não<br>";

if (isset($_SESSION['voto']['tipoVoto'])) {
    echo "Tipo de voto: {$_SESSION['voto']['tipoVoto']}<br>";
}

echo "<br>";

var_dump($_SESSION);
