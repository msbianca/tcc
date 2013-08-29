<?php

class ModelConexao {

    private static $instance; //instancia de ModelConexao;
    private $bd_conexao;
    private $totalRegistros;

    private function __construct() {
        $this->bd_conexao = new mysqli("localhost", "root", "", "social_network");
        $this->verificaErroConexao();
    }

    public static function getInstance() {
        //se nao existe instancia ainda
        if (empty(self::$instance)) {
            //instancia um objeto
            self::$instance = new ModelConexao;
        }
        // retorna a instância
        return self::$instance;
    }

    public static function gravarDados($campos, $tabela, $valores) {
        //obtem a instancia atual
        $instance = self::getInstance();

        if (!mysqli_query($instance->bd_conexao, "insert into $tabela ($campos) values ($valores)")) {
            die('Erro: ' . mysqli_error($instance->bd_conexao));
            exit;
        }
        return true;
    }

    public static function executarFiltro($campos, $tabela, $condicao) {
        //obtem a instancia atual
        $instance = self::getInstance();

        $result = $instance->bd_conexao->query("select $campos from $tabela where $condicao");

        $instance->totalRegistros = $result->num_rows;
        if ($result === FALSE) {
            echo "Erro na consulta... " . $instance->bd_conexao->error;
            exit;
        }
        return $result;
    }

    /**
     *       Conta quantos registros foram encontrados
     */
    public static function totalRegistroFiltrados() {
        //obtem a instancia atual
        $instance = self::getInstance();

        return $instance->totalRegistros;
    }

    private function verificaErroConexao() {
        // Verifica se ocorreu um erro e exibe a mensagem de erro
        if (mysqli_connect_errno())
            trigger_error(mysqli_connect_error(), E_USER_ERROR);
    }

}

