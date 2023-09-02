<?php
require_once 'infra/ConexaoBD.php';
require_once 'controller/CadastrarController.php';
require_once 'controller/ModelController.php';

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
    $controladorCadastro = new CadastrarController();
    $controladorCadastro->exibirFormulario();

    $modelControllers = array();

    foreach ($conn->getTabelas() as $tabela) {
        if (!$conn->tabelaVazia($tabela)) {
            $controlador = ucfirst($tabela) . "Controller";
            $modelControllers[] = $controlador;
        }
    }

    foreach ($modelControllers as $controlador) {
        if (file_exists("controller/" . $controlador . ".php")) {
            include_once "controller/" . $controlador . ".php";
            echo "<h2>" . strtoupper(str_replace("Controller", "", $controlador)) . "</h2>";

            $request = new $controlador();
            $request->listar();
        }
    }
?>

</body>
</html>
