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
        <title>VulpixES.com - Mensagens</title>
        <link rel="stylesheet" href="../style/principal.css" type="text/css" />
        <link rel="stylesheet" href="../style/structDefault.css" type="text/css" />
    </head>
    <body>
        <?php
        echo StructDefault::createHead("<a href='../Controller/encerrarSessao.php'>Sair</a>");
        ?>

        <div id="site">
            <div id="esquerda">
                <div id="menu">
                    <ul>
                        <li><a href="principal.php">Perfil</a></li>
                        <li><a href="publicacao.php">Publicações</a></li>
                        <li><a href="mensagem.php">Mensagens</a></li>
                        <li><a href="amigo.php">Amigos</a></li>
                        <li><a href="solicitacao.php">Solicitações</a></li>
                    </ul>
                </div>
            </div>

            <div id="direita">
                <p>mensagem</p>
            </div>

            <div id="rodape">
                <p>&copy;Copyright VulpixEX.com 2013 - Todos os direitos reservados.</p>
            </div>
        </div>

    </body>
</html>