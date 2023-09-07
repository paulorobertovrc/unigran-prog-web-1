<div>
    <h1>CLIENTES</h1>
    <?php
    echo "<form method='post'>";
    echo "<label for='nome'>Nome: </label>";
    echo "<input type='text' name='nome' id='nome'>";

    echo "<label for='endereco'>Endereço: </label>";
    echo "<input type='text' name='endereco' id='endereco'>";

    echo "<label for='bairro'>Bairro: </label>";
    echo "<input type='text' name='bairro' id='bairro'>";

    echo "<label for='cep'>CEP: </label>";
    echo "<input type='text' name='cep' id='cep'>";

    echo "<label for='telefone'>Telefone: </label>";
    echo "<input type='text' name='telefone' id='telefone'>";

    echo "<label for='cpf'>CPF: </label>";
    echo "<input type='text' name='cpf' id='cpf'>";

    echo "<label for='ie'>IE: </label>";
    echo "<input type='text' name='ie' id='ie'>";

    echo "<label for='cidade'>Cidade: </label>";
    echo "<input type='text' name='cidade' id='cidade'>";

    echo "<input type='submit' value='Cadastrar' name='cadastrarCliente'></form><br>";

    if (isset($_POST['cadastrarCliente'])) {
        require_once 'controller/ClienteController.php';

        $controlador = new ClienteController();
        $controlador->incluir();
        header("Location: index.php");
    }
    ?>

    <table>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Bairro</th>
            <th>CEP</th>
            <th>Telefone</th>
            <th>CPF</th>
            <th>IE</th>
            <th>Cidade</th>
        </tr>
        <?php
        $clientes = $_REQUEST['clientes'];

        foreach ($clientes as $cliente) {
            echo "<form method='post' id='form' name='form'>";
            echo "<tr>";
            echo "<td>" . $cliente->getCodcli() . "</td>";
            echo "<td>" . $cliente->getNome() . "</td>";
            echo "<td>" . $cliente->getEndereco() . "</td>";
            echo "<td>" . $cliente->getBairro() . "</td>";
            echo "<td>" . $cliente->getCep() . "</td>";
            echo "<td>" . $cliente->getTelefone() . "</td>";
            echo "<td>" . $cliente->getCpf() . "</td>";
            echo "<td>" . $cliente->getIe() . "</td>";
            echo "<td>" . $cliente->getCodCid() . "</td>";
            echo "<td><button type='submit' name='alterarCliente' id='alterarCliente' value='". $cliente->getCodcli()
                .  "'>Alterar</button></td>";
            echo "<td><button type='submit' name='excluirCliente' id='excluirCliente' value='". $cliente->getCodcli()
                .  "'>Excluir</button></td>";
            echo "</tr>";
            echo "</form>";
        }

        echo "</table><br><br>";

        if (isset($_POST['alterarCliente'])) {
            require_once 'controller/ClienteController.php';
            $controller = new ClienteController();

            $codCli = $_POST['alterarCliente'];
            $clienteSelecionado = $controller->buscar($codCli);

            echo "<h3>ALTERANDO CLIENTE " . $clienteSelecionado->getCodcli() . "</h3>";

            echo "<form method='post' id='formAlterar' name='formAlterar'>";
            echo "<label for='nome'>Nome</label>";
            echo "<input type='text' name='nome' id='nome' value='" . $clienteSelecionado->getNome() . "'>";
            echo "<label>Endereço</label>";
            echo "<input type='text' name='endereco' id='endereco' value='" . $clienteSelecionado->getEndereco() . "'>";
            echo "<label>Bairro</label>";
            echo "<input type='text' name='bairro' id='bairro' value='" . $clienteSelecionado->getBairro() . "'>";
            echo "<label>CEP</label>";
            echo "<input type='text' name='cep' id='cep' value='" . $clienteSelecionado->getCep() . "'>";
            echo "<label>Telefone</label>";
            echo "<input type='text' name='telefone' id='telefone' value='" . $clienteSelecionado->getTelefone()
                . "'>";
            echo "<label>CPF</label>";
            echo "<input type='text' name='cpf' id='cpf' value='" . $clienteSelecionado->getCpf() . "'>";
            echo "<label>IE</label>";
            echo "<input type='text' name='ie' id='ie' value='" . $clienteSelecionado->getIe() . "'>";
            echo "<label>Cidade</label>";
            echo "<input type='text' name='cidade' id='cidade' value='" . $clienteSelecionado->getCodCid() . "'>";
            echo "<input type='hidden' name='codcli' id='codcli' value='" . $clienteSelecionado->getCodcli() . "'>";
            echo "<input type='submit' value='Atualizar' name='formAlterar' id='formAlterar'>";
            echo "</form>";
        }

        if (isset($_POST['formAlterar'])) {
            $controlador = new ClienteController();
            $controlador->alterar();
            header("Location: index.php");
        }

        if (isset($_POST['excluirCliente'])) {
            $codCli = $_POST['excluirCliente'];
            $controller = new ClienteController();
            $controller->excluir();
            header("Location: index.php");
        }
        ?>
</div>
