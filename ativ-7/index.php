<?php
require_once 'infra/ConexaoBD.php';
require_once 'controller/CadastrarController.php';

$conn = ConexaoBD::getInstance();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atividade 7</title>
</head>
<body>

    <h1>Atividade 7</h1>

<?php
    $controlador = new CadastrarController();
    $controlador->exibirFormulario();

    foreach ($conn->getTabelas() as $tabela) {
        if ($conn->tabelaVazia($tabela)) {
            echo "A tabela está vazia!" . "<br>";
            break;
        }

        include_once "controller/" . ucfirst($tabela) . "Controller.php";
        echo "<h2>" . strtoupper($tabela) . "</h2>";

        $controlador = ucfirst($tabela) . "Controller";
        $request = new $controlador();
        $request->listar();
    }
?>

</body>
</html>
