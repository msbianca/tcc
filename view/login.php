<!doctype html>
<html lang="pt-br">
    
    <head>
        <meta charset="utf-8">
        <title>.:::: VulpixES.com - Seja Bem Vindo ::::.</title>
        <link rel="stylesheet" href="../style/login.css" type="text/css" />
    </head>

    <body>
        <form method="post" action="../controller/validarLogin.php">
            <label>Login</label>
            <input type="text" name="login" maxlength="50" />
            <label>Senha</label>
            <input type="password" name="password" maxlength="50" />
            <input type="checkbox" name="connectOn"/>Mantenha-me conectado
            <input type="submit" value="Entrar" />
        </form>

    </body>

</html>