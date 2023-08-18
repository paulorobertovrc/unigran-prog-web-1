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

echo "Dados armazenados nas variáveis de sessão: <br>";
echo "Nome: " . $_SESSION['nome'] . "<br>";
echo "Idade: " . $_SESSION['idade'] . "<br><br>";

if ($idade < 16) {
    echo "O(A) usuário(a) $nome não pode votar porque tem $idade anos de idade.";
} else if (($idade < 18) || $idade > 70) {
    echo "O(A) usuário(a) $nome pode votar porque tem $idade anos de idade, porém neste caso o voto é facultativo.";
} else {
    echo "O(A) usuário(a) $nome deve obrigatoriamente votar porque tem $idade anos de idade.";
}
