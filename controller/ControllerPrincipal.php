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
            $password = md5('2013webES' . $password);
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
        if (!isset($_POST['nome']) && (empty($_POST['nome']))) {
            $this->msgErrorFiledsNull("~~> Digite o nome <~~");
        } else {
            $nome = $_POST['nome'];
        }

        if (!isset($_POST['sobrenome']) && (empty($_POST['sobrenome']))) {
            $this->msgErrorFiledsNull("~~> Digite o sobrenome <~~");
        } else {
            $sobrenome = $_POST['sobrenome'];
        }

        if (!isset($_POST['data_nasc']) && (empty($_POST['data_nasc']))) {
            $this->msgErrorFiledsNull("~~> Digite a data de nascimento <~~");
        } else {
            $data_nasc = $_POST['data_nasc'];
        }

        if (!isset($_POST['email']) && (empty($_POST['email']))) {
            $this->msgErrorFiledsNull("~~> Digite o email <~~");
        } else {
            $email = $_POST['email'];
        }

        if (!isset($_POST['login']) && (empty($_POST['login']))) {
            $this->msgErrorFiledsNull("~~> Digite o login <~~");
        } else {
            $login = $_POST['login'];
        }

        if (!isset($_POST['senha']) && (empty($_POST['senha']))) {
            $this->msgErrorFiledsNull("~~> Digite a senha <~~");
        } else {
            $senha = $_POST['senha'];
            $senha = md5('2013webES' . $senha);
        }

        if (isset($_POST['palavra'])) {
            if ($_POST["palavra"] != $_SESSION["palavra_captcha"]) {
                $this->msgErrorFiledsNull("~~> Caracteres inválidos. Digite novamente... <~~");
            }
        }

        if (ModelConexao::gravarDados("NOME, SOBRENOME, DATA_NASCIMENTO, LOGIN,
                                    SENHA, EMAIL, TOTAL_AMIGOS", "pessoa", "'$nome', '$sobrenome', '$data_nasc', '$login', '$senha',
                                    '$email', 0")) {
            $_SESSION['msg_error_fields_null'] = "";
            echo "<script>alert('Cadastro realizado com sucesso...');window.location='../View/principal.php'</script>";
        } else {
            $this->msgErrorFiledsNull("Erro ao efetuar cadastro...");
        }
    }

    private function msgErrorFiledsNull($msgError) {
        //registra mensagem de erro 
        $_SESSION['msg_error_fields_null'] = $msgError;
        //retorna no cadastro
        header("Location: ../view/cadastro.php");
        exit;
    }

}
?>