<?php

session_start();

require_once '../model/ModelConexao.php';

class ControllerPrincipal {

    public function __construct() {
        $_SESSION['login_error'] = "";
    }

    public function validarLogin() {
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
        }

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }

        //utiliza uma função para validar os dados digitados
        ModelConexao::executarFiltro("p.*", "pessoa p", "(p.login = '$login') and (p.senha = '$password')");
        if (ModelConexao::totalRegistroFiltrados() == 1) {
            //cria cookie caso é para ficar conectado
//            if ((isset($_POST['connectOn'])) && (isset($_COOKIE["connectOn"]))) {
            //              setcookie("connectOn", "true", time() + 3600);
            //        }
            //registra usuário
            $_SESSION['login'] = $login;
            //registra data login
            $_SESSION['data_login'] = date("M d y H:i:s");
            //limpa mensagem de erro ao logar
            $_SESSION['login_error'] = "";
            //manda para página inicial da rede
            header("Location: ../view/principal.php");
        } else {
            //registra mensagem de erro ao logar
            $_SESSION['login_error'] = "~~> Login ou senha incorretos <~~";
            //o usuário e/ou a senha são inválidos, manda para página de erro
            header("Location: ../view/login.php");
        }
    }

    public function criarConta() {
        if (isset($_POST['nome'])) {
            $nome = $_POST['nome'];
        }

        if (isset($_POST['sobrenome'])) {
            $sobrenome = $_POST['sobrenome'];
        }

        if (isset($_POST['genero'])) {
            $genero = $_POST['genero'];
        }

        if (isset($_POST['data_nasc'])) {
            $data_nasc = $_POST['data_nasc'];
        }

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }

        if (isset($_POST['senha'])) {
            $senha = $_POST['senha'];
        }

        if (isset($_POST['palavra'])) {
            if ($_POST["palavra"] == $_SESSION["palavra_captcha"]) {
                echo "<h1>Voce Acertou</h1>";
            } else {
                echo "<h1>Voce nao acertou!</h1>";
                echo "<a href='index.php'>Retornar</a>";
            }
        }
    }

}
?>