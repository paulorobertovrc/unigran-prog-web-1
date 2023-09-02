<?php

require_once "SqlScript.php";

class ConexaoBD {
    private static $instance;
    private $server = "localhost";
    private $user = "root";
    private $pass = "12345678";
    private $mydb = "unigran";
    private $conn;
    private $tabelas = array();

    protected function __construct() {
        try {
            $this->conn = new mysqli($this->server, $this->user, $this->pass, $this->mydb);
        } catch (Exception $e) {
            die("Não foi possível conectar ao bando de dados!" . "<br>" . "[Mensagem] ". $e->getMessage() . "<br><br>" .
                "Verifique as credenciais de acesso no arquivo ConexaoBD.php");
        }
    }

    public function tabelaVazia($nomeTabela): bool {
        return $this->conn->query("SELECT COUNT(*) FROM $nomeTabela")->fetch_row()[0] == 0;
    }

    public function getConexao() {
        return $this->conn;
    }

    public function getTabelas(): array {
        return $this->tabelas;
    }

    private function buscarNomeTabelas(): array {
        return $this->conn->query("SHOW TABLES")->fetch_all();
    }

    public function verificarSeTabelaExiste($nomeTabela): bool {
        return $this->conn->query("SHOW TABLES LIKE '$nomeTabela'")->num_rows > 0;
    }

    public static function getInstance(): ConexaoBD {
        if (self::$instance == null) {
            self::$instance = new ConexaoBD();
            SqlScript::criarTabelas();

            foreach (self::$instance->buscarNomeTabelas() as $nomeTabela) {
                self::$instance->tabelas[] = $nomeTabela[0];
            }
        }

        return self::$instance;
    }

}
