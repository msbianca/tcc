<?php
//recupera a variável $_SESSION se ela foi definida
session_start();

if (!isset($_SESSION['login'])) {
    //não há usuário logado, manda pra página de login
    header("Location: ./login.php");
}

require_once './StructDefault.php';
require_once '../controller/ControllerPrincipal.php';
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
                <?php
                $controller = new ControllerPrincipal();
                $idpessoa = -1;

                if (isset($_SESSION['idpessoa_logado'])) {
                    $idpessoa = $_SESSION['idpessoa_logado'];
                }
                
                $pessoa = $controller->mostrarInfoPerfil($idpessoa);
                echo '<br />';
                echo "<span style='font-size:2.8em;color: black;'>", $pessoa->getNome(), " ", $pessoa->getSobrenome(), "</span>";
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

            <div id="rodape">
                <p>&copy;Copyright VulpixEX.com 2013 - Todos os direitos reservados.</p>
            </div>
        </div>

    </body>
</html>