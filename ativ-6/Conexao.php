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
                `email` varchar(255) NOT NULL 
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        } catch (Exception $e) {
            die("Não foi possível conectar ao bando de dados!" . "<br>" . "[Mensagem] ". $e->getMessage() . "<br><br>" .
                "Verifique as credenciais de acesso no arquivo Conexao.php");
        }
        return $conn;
    }

    public function tabelaVazia(): bool {
        $conn = $this->conectar();
        $resultado = $conn->query("SELECT COUNT(*) FROM $this->table");
        $conn->close();

        return $resultado->fetch_row()[0] == 0;
    }

    public function cadastrarUsuario($nome, $email) {
        $conn = $this->conectar();

        if (empty($nome) || empty($email)) {
            die("Todo os campos precisam ser preenchidos!");
        }

        if ($this->buscarUsuarioPorNomeEEmail($nome, $email)) {
            die("Usuário já cadastrado!");
        }

        $conn->query("INSERT INTO $this->table (nome, email) VALUES ('$nome', '$email')");
        $conn->close();

        echo "Usuário cadastrado com sucesso!";
    }

    public function buscarTodos() {
        $conn = $this->conectar();
        $resultado = $conn->query("SELECT * FROM $this->table");
        $conn->close();

        return $resultado;
    }

    public function buscarUsuarioPorId($id) {
        $conn = $this->conectar();
        $resultado = $conn->query("SELECT * FROM $this->table WHERE id = $id");
        $conn->close();

        foreach ($resultado as $usuario) {
            return $usuario;
        }

        return null;
    }

    public function buscarUsuarioPorNomeEEmail($nome, $email) {
        $conn = $this->conectar();
        $resultado = $conn->query("SELECT * FROM $this->table WHERE nome = '$nome' AND email = '$email'");
        $conn->close();

        foreach ($resultado as $usuario) {
            return $usuario;
        }

        return null;
    }

    public function alterarUsuario($id, $nomeAlterado, $emailAlterado) {
        $conn = $this->conectar();
        $conn->query("UPDATE $this->table SET nome = '$nomeAlterado', email = '$emailAlterado' WHERE id = $id");
        $conn->close();

        echo "Usuário alterado com sucesso!";
    }

    public function excluirUsuario($id) {
        $conn = $this->conectar();
        $conn->query("DELETE FROM $this->table WHERE id = $id");
        $conn->close();

        echo "Usuário excluído com sucesso!";
    }

}
