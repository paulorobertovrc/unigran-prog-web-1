<?php

class Conexao {
    private $server = "localhost";
    private $user = "root";
    private $pass = "12345678";
    private $mydb = "unigran";
    private $table = "usuarios";

    public function conectar() {
        try {
            $conn = new mysqli($this->server, $this->user, $this->pass, $this->mydb);
            $conn->query("CREATE TABLE IF NOT EXISTS `$this->table` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `nome` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL UNIQUE 
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        } catch (Exception $e) {
            die("Não foi possível conectar ao bando de dados!" . "<br>" . "[Mensagem] ". $e->getMessage() . "<br><br>" .
                "Verifique as credenciais de acesso no arquivo Conexao.php");
        }
        return $conn;
    }

    public function executar($query) {
        $conn = $this->conectar();
        $conn->query($query);
        $conn->close();
    }

    public function buscar($query) {
        $conn = $this->conectar();
        $resultado = $conn->query($query);
        $conn->close();

        return $resultado;
    }

    public function buscarUsuario($id) {
        $conn = $this->conectar();
        $resultado = $conn->query("SELECT * FROM $this->table WHERE id=$id");
        $conn->close();

        return $resultado->fetch_assoc();
    }

    public function buscarUsuarioPorEmail($email) {
        $conn = $this->conectar();
        $resultado = $conn->query("SELECT * FROM $this->table WHERE email='$email'");
        $conn->close();

        return $resultado->fetch_assoc();
    }

    public function cadastrarUsuario($nome, $email) {
        $conn = $this->conectar();

        if ($this->buscarUsuarioPorEmail($email)) {
            die("O e-mail " . $email . " já está cadastrado!");
        }

        if ($nome == "" || $email == "") {
            echo "Todos os campos do formulário devem ser preenchidos!";
            exit;
        }

        $conn->query("INSERT INTO $this->table (nome, email) VALUES ('$nome', '$email')");
        $conn->close();

        echo "Usuário cadastrado com sucesso!";

        header("Refresh:1");
    }

    public function alterarUsuario($id, $nome, $email) {
        $conn = $this->conectar();
        $conn->query("UPDATE usuarios SET nome='$nome', email='$email' WHERE id=$id");
        $conn->close();

        echo "Usuário alterado com sucesso!";
    }

    public function verificarEntradaDuplicada($email) {
        $emailsCadastrados = $this->buscar("SELECT `email` FROM usuarios");
        foreach ($emailsCadastrados as $emailCadastrado) {
            if ($emailCadastrado['email'] == $email) {
                return true;
            }
        }

        return false;
    }

    public function tabelaVazia(): bool {
        $conn = $this->conectar();
        $resultado = $conn->query("SELECT COUNT(*) FROM $this->table");
        $conn->close();

        return $resultado->fetch_row()[0] == 0;
    }

}
