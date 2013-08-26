<?php
//recupera a variável $_SESSION se ela foi definida
session_start();

if (!isset($_SESSION['login'])) {
    //não há usuário logado, manda pra página de login
    header("Location: ./login.php");
}

require_once './StructDefault.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>VulpixES.com - Home</title>
        <link rel="stylesheet" href="../style/principal.css" type="text/css" />
        <link rel="stylesheet" href="../style/structDefault.css" type="text/css" />
    </head>
    <body>
        <?php
        echo StructDefault::createHead("<a href='../Controller/encerrarSessao.php'>Efetuar logout</a>");
        ?>

        <div id="site">
            <div id="esquerda">
                <div id="menu">
                    <ul>
                        <li><a href="link1.htm">Publicações</a></li>
                        <li><a href="link2.htm">Mensagens</a></li>
                        <li><a href="link3.htm">Amigos</a></li>
                    </ul>
                </div>
            </div>
            <div id="direita">
                
            </div>
            <div id="rodape">
                <p>&copy;Copyright VulpixEX.com 2013 - Todos os direitos reservados.</p>
            </div>
        </div>

    </body>
</html>