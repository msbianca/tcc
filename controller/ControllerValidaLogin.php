<?php

require_once '../model/ModelConexao.php';

class ControllerValidaLogin {

    public function __construct() {
    }

    public function validarLogin() {
        session_start();

        if (isset($_POST['login'])) {
            $login = $_POST['login'];
        }

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }

        //utiliza uma função para validar os dados digitados
        ModelConexao::executarFiltro("p.*", "pessoa p", "(p.login = '$login') and (p.senha = '$password')");
        if (ModelConexao::totalRegistroFiltrados() == 1) {
            //registra usuário
            $_SESSION['login'] = $login;
            //registra data login
            $_SESSION['data_login'] = date("M d y H:i:s");
            //manda para página inicial da rede
            header("Location: ../view/principal.php");
        } else {
            //o usuário e/ou a senha são inválidos, manda para página de erro
            header("Location: ../view/login.php");
        }
    }

}

?>