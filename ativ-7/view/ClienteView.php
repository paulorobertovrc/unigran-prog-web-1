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
            echo "<td><button type='submit' name='alterar' id='alterarCliente' value='". $cliente->getCodcli()
                .  "'>Alterar</button></td>";
            echo "<td><button type='submit' name='excluir' id='excluirCliente' value='". $cliente->getCodcli()
                .  "'>Excluir</button></td>";
            echo "</tr>";
            echo "</form>";
        }
        ?>
    </table>

    <?php
    if (isset($_POST['alterarCliente'])) {
        $clienteSelecionado = new Cliente(null, null, null, null, null, null,
            null, null, null);

        foreach ($clientes as $cliente) {
            if ($cliente->getCodcli() == $_POST['alterarCliente']) {
                $clienteSelecionado->setCodcli($cliente->getCodcli());
                $clienteSelecionado->setNome($cliente->getNome());
                $clienteSelecionado->setEndereco($cliente->getEndereco());
                $clienteSelecionado->setBairro($cliente->getBairro());
                $clienteSelecionado->setCep($cliente->getCep());
                $clienteSelecionado->setTelefone($cliente->getTelefone());
                $clienteSelecionado->setCpf($cliente->getCpf());
                $clienteSelecionado->setIe($cliente->getIe());
                $clienteSelecionado->setCodCid($cliente->getCodCid());
            }
        }

        echo "<h3>ALTERANDO CLIENTE " . $clienteSelecionado->getCodcli() . "</h3>";
        echo "<form method='post' id='formAlterarCliente' name='formAlterarCliente'>";
        echo "<label>Nome<input type='text' name='nome' id='nome' value='" . $clienteSelecionado->getNome() . "'>
        </label>";
        echo "<label>Endereço<input type='text' name='endereco' id='endereco' value='"
            . $clienteSelecionado->getEndereco() . "'></label>";
        echo "<label>Bairro<input type='text' name='bairro' id='bairro' value='" . $clienteSelecionado->getBairro() .
            "'></label>";
        echo "<label>CEP<input type='text' name='cep' id='cep' value='" . $clienteSelecionado->getCep() . "'></label>";
        echo "<label>Telefone<input type='text' name='telefone' id='telefone' value='"
            . $clienteSelecionado->getTelefone() . "'></label>";
        echo "<label>CPF<input type='text' name='cpf' id='cpf' value='" . $clienteSelecionado->getCpf() . "'></label>";
        echo "<label>IE<input type='text' name='ie' id='ie' value='" . $clienteSelecionado->getIe() . "'></label>";
        echo "<label>Cidade<input type='text' name='cidade' id='cidade' value='" . $clienteSelecionado->getCodCid()
            . "'></label>";
        echo "<input type='hidden' name='codcli' id='codcli' value='" . $clienteSelecionado->getCodcli() . "'>";
        echo "<input type='hidden' name='confirmarAlteracaoCliente' id='confirmarAlteracaoCliente' 
            value='confirmarAlteracaoCliente'>";
        echo "<td><button type='submit' name='alterarCliente' id='alterarCliente' value='alterarCliente'>Alterar
            </button></td>";
        echo "<td><button type='submit' name='cancelar' id='cancelar' value='cancelar'>Cancelar</button></td>";
        echo "</form>";

        if (isset($_POST['confirmarAlteracaoCliente'])) { // TODO: CORRIGIR O botão de alterar cliente abre o campo para alterar produto
            $controller = new ClienteController();
            $controller->alterar();
            header("Location: index.php");
        }
    }

    if (isset($_POST['excluir'])) {
        $codCli = $_POST['excluir'];
        $controller = new ClienteController();
        $controller->excluir();
        header("Location: index.php");
    }
    ?>
</div>
