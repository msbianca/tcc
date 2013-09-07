<?php
session_start();

if (isset($_SESSION['login'])) {
    //há usuário logado

    header("Location: ./principal.php");
}

require_once './StructDefault.class.php';
?>
﻿<!doctype html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <title>.:::: VulpixES.com - Seja Bem Vindo ::::.</title>
        <link rel="stylesheet" href="../style/structDefault.css" type="text/css" />
        <link rel="stylesheet" href="../style/login.css" type="text/css" />
    </head>

    <body>
        <?php
        echo StructDefault::createHead("<a href='./cadastro.php'>Criar Conta<a href='./sobre.php'>Sobre</a></a>");
        ?>        

        <div id="panelCenter">
            <form method="post" action="../controller/validarLogin.php">
                <div id="campos">
                    <br /><br />
                    <label><span>Login</span></label>
                    <input type="text" name="login" maxlength="15" class="inputTxt"/><br /><br />
                    <label><span>Senha</span></label>
                    <input type="password" name="password" maxlength="100" class="inputTxt"/><br /><br />

<!--<span id="checkbox"><input type="checkbox" name="connectOn"/> Mantenha-me conectado</span>-->
                </div><br />
                <input type="submit" class="button" value="Entrar" />
            </form>
            <?php
            if (isset($_SESSION['login_error'])) {
                echo "<span style='font-size:1.3em;color: red;'>", $_SESSION['login_error'], "</span>";
            }
            ?>
            <br />
            <!--<span id="link"><a href="">Esqueceu a senha?</a></span>-->
        </div>
    </body>

</html>