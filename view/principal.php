<?php
//recupera a variável $_SESSION se ela foi definida
session_start();

if (!isset($_SESSION['login'])) {
    //não há usuário logado, manda pra página de login
    header("Location: ./login.php");
}

require_once './StructDefault.class.php';
require_once '../controller/ControllerPrincipal.class.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>VulpixES.com - Perfil</title>
        <link rel="stylesheet" href="../style/principal.css" type="text/css" />
        <link rel="stylesheet" href="../style/structDefault.css" type="text/css" />
    </head>
    <body>
        <?php
        echo StructDefault::createHead("<a href='../controller/encerrarSessao.php'>Sair</a>");
        ?>

        <div id="site">
            <?php
            echo StructDefault::createMenu();
            ?>

            <div id="direita">
                <?php
                $controller = new ControllerPrincipal();
                $idpessoa = -1;

                if (isset($_SESSION['idpessoa_logado'])) {
                    $idpessoa = $_SESSION['idpessoa_logado'];
                }

                $pessoa = $controller->mostrarInfoPerfil($idpessoa);
                echo '<br />';
                echo "<span style='font-size:2.8em;color: black;font-weight:bold;'>", $pessoa->getNome(), " ", $pessoa->getSobrenome(), "</span>";
                echo '<br />';
                echo '<br />';
                echo "<h2>Aniversário: </h2><span style='font-size:1.5em;color: black;'>", date('d/m/y', strtotime($pessoa->getDataNascimento())), "</span>";
                echo '<br />';
                echo '<br />';
                echo "<h2>E-mail: </h2><span style='font-size:1.5em;color: black;'>", $pessoa->getEmail(), "</span>";
                echo '<br />';
                echo '<br />';
                echo "<h2>Total Amigos:: </h2><span style='font-size:1.5em;color: black;'>", $pessoa->getTotalAmigos(), "</span>";
                echo '<br />';
                echo '<br />';
                echo "<h2>Bio: </h2><span style='font-size:1.5em;color: black;'>", $pessoa->getAutoDefinicao(), "</span>";
                ?>          
            </div>

            <?php
            echo StructDefault::createFooter();
            ?>            
        </div>

    </body>
</html>