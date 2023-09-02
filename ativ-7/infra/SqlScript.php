<?php

class SqlScript {
    private static $instance;
    private $conn;

    protected function __construct() {
        $this->conn = ConexaoBD::getInstance();
    }

    public static function getInstance(): SqlScript {
        if (self::$instance == null) {
            self::$instance = new SqlScript();
        }

        return self::$instance;
    }

    private function criarTabelaCliente() {
        $this->conn->getConexao()->query("CREATE TABLE IF NOT EXISTS `cliente` (
            `codcli` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `nome` varchar(200) NOT NULL UNIQUE,
            `endereco` varchar(200) DEFAULT NULL,
            `bairro` varchar(45) DEFAULT NULL,
            `cep` char(10) DEFAULT NULL,
            `telefone` char(9) DEFAULT NULL,
            `cpf` char(20) NOT NULL,
            `ie` char(20) DEFAULT NULL,
            `codcid` int(11) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    }

    private function criarTabelaCidade() {
        $this->conn->getConexao()->query("CREATE TABLE IF NOT EXISTS `cidade` (
            `codcid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `nomecid` varchar(50) NOT NULL,
            `uf` char(2) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    }

    private function criarTabelaPedido() {
        $this->conn->getConexao()->query("CREATE TABLE IF NOT EXISTS `pedido` (
            `numped` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `entrega` smallint(6) NOT NULL,
            `codcli` int(11) NOT NULL,
            `codvend` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    }

    private function criarTabelaItemPedido() {
        $this->conn->getConexao()->query("CREATE TABLE IF NOT EXISTS `itempedido` (
            `qtdade` int(11) NOT NULL,
            `numped` int(11) NOT NULL,
            `codprod` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    }

    private function criarTabelaProduto() {
        $this->conn->getConexao()->query("CREATE TABLE IF NOT EXISTS `produto` (
            `codprod` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `descricao` varchar(255) NOT NULL,
            `unidade` char(3) NOT NULL,
            `valor_un` float NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    }

    private function criarTabelaVendedor() {
        $this->conn->getConexao()->query("CREATE TABLE IF NOT EXISTS `vendedor` (
            `codvend` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `nomevend` varchar(60) NOT NULL,
            `salario` float NOT NULL,
            `codsetor` int(11) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    }

    private function criarTabelaSetor() {
        $this->conn->getConexao()->query("CREATE TABLE IF NOT EXISTS `setor` (
            `codsetor` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `nomesetor` varchar(50) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    }

    private function alterarTabelaClienteAddFK() {
        $this->conn->getConexao()->query("ALTER TABLE `cliente`
            ADD KEY `fk_cli_codcid` (`codcid`);");

        $this->conn->getConexao()->query("ALTER TABLE `cliente`
            ADD CONSTRAINT `fk_cli_codcid` FOREIGN KEY (`codcid`) REFERENCES `cidade` (`codcid`) ON UPDATE CASCADE ;");
    }

    private function alterarTabelaPedidoAddFK() {
        $this->conn->getConexao()->query("ALTER TABLE `pedido`
            ADD KEY `fk_ped_codcli` (`codcli`),
            ADD KEY `fk_ped_codvend` (`codvend`);");

        $this->conn->getConexao()->query("ALTER TABLE `pedido`
            ADD CONSTRAINT `fk_ped_codcli` FOREIGN KEY (`codcli`) REFERENCES `cliente` (`codcli`) ON UPDATE CASCADE,
            ADD CONSTRAINT `fk_ped_codvend` FOREIGN KEY (`codvend`) REFERENCES `vendedor` (`codvend`) 
                ON UPDATE CASCADE ;");
    }

    private function alterarTabelaItemPedidoAddFK() {
        $this->conn->getConexao()->query("ALTER TABLE `itempedido`
            ADD KEY `fk_item_numped` (`numped`),
            ADD KEY `fk_item_codprod` (`codprod`);");

        $this->conn->getConexao()->query("ALTER TABLE `itempedido`
            ADD CONSTRAINT `fk_item_numped` FOREIGN KEY (`numped`) REFERENCES `pedido` (`numped`) ON UPDATE CASCADE,
            ADD CONSTRAINT `fk_item_codprod` FOREIGN KEY (`codprod`) REFERENCES `produto` (`codprod`) 
                ON UPDATE CASCADE;");
    }

    private function alterarTabelaVendedorAddFK() {
        $this->conn->getConexao()->query("ALTER TABLE `vendedor`
            ADD KEY `fk_vend_codsetor` (`codsetor`);");

        $this->conn->getConexao()->query("ALTER TABLE `vendedor`
            ADD CONSTRAINT `fk_vend_codsetor` FOREIGN KEY (`codsetor`) REFERENCES `setor` (`codsetor`) 
                ON UPDATE CASCADE;");
    }

    public static function criarTabelas() {
        self::getInstance()->criarTabelaCliente();
        self::getInstance()->criarTabelaCidade();
        self::getInstance()->criarTabelaPedido();
        self::getInstance()->criarTabelaItemPedido();
        self::getInstance()->criarTabelaProduto();
        self::getInstance()->criarTabelaVendedor();
        self::getInstance()->criarTabelaSetor();

        foreach (self::getInstance()->conn->getTabelas() as $tabela) {
            if (!self::getInstance()->conn->verificarSeTabelaExiste($tabela)) {
                self::getInstance()->alterarTabelaClienteAddFK();
                self::getInstance()->alterarTabelaPedidoAddFK();
                self::getInstance()->alterarTabelaItemPedidoAddFK();
                self::getInstance()->alterarTabelaVendedorAddFK();
            }
        }
    }

}
