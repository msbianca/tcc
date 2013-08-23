<!doctype html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <title>.:::: VulpixES.com - Seja Bem Vindo ::::.</title>
        <link rel="stylesheet" href="../style/login.css" type="text/css" />
    </head>

    <body>
        <div id="topo">

            <div class="cAlign">
                <a href="#"><img src="../Images/logo.png" alt="VulpixEx.com" /> </a><span><a href="./cadastro.php">Criar Conta<a href="#">Contato<a href="#">Sobre</a></a></a></span>
            </div><!--cAlign-->

        </div><!--topo-->

        <div id="panelCenter">
            <form method="post" action="../controller/validarLogin.php">
                <div id="campos">
                    <label><span>Login</span></label>
                    <input type="text" name="login" maxlength="15" class="inputTxt"/><br /><br />
                    <label><span>Senha</span></label>
                    <input type="password" name="password" maxlength="100" class="inputTxt"/><br /><br />
                    <span id="checkbox"><input type="checkbox" name="connectOn"/> Mantenha-me conectado</span>
                </div><br />
                <input type="submit" class="button" value="Entrar" />
            </form>
            <span id="link"><a href="">Esqueceu a senha?</a></span>
        </div>
    </body>

</html>