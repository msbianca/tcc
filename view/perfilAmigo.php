<?php
//recupera a variável $_SESSION se ela foi definida
session_start();

if (!isset($_SESSION['login'])) {
    //não há usuário logado, manda pra página de login
    header("Location: ./login.php");
}

require_once './StructDefault.class.php';
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
            <?php
            echo StructDefault::createMenu();
            ?>

            <div id="direita">
                <?php
                $controller = new ControllerPrincipal();
                $idpessoa = -1;

                if (isset($_GET['id'])) {
                    $idpessoa = $_GET['id'];
                }

                //mostra perfil
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

                $ehAmigos = $controller->verificarAmizade($idpessoa);
                
                if (!$ehAmigos) {
                    echo "<br /><br /><br /><span style='background:#CCC;font-size:1.5em;color: blue;font-weight:bold;'><a href='../Controller/adicionarAmigo.php?id=$idpessoa'> Adicionar Amigo </a></span>";
                }

                //mostra publicações
                echo "<br /><br /><br /><hr /><br /><h1>Publicações:</h1><br />";
                $publicacao = $controller->mostrarPublicacoes($idpessoa);
                if (ModelConexao::totalRegistroFiltrados() == 0) {
                    echo "<span style=color:red;font-size:1.3em;>~~> Nenhuma publicação <~~</span><br /><br />";
                } else {
                    $i = 0;
                    while ($i < ModelConexao::totalRegistroFiltrados()) {
                        echo "<div style='width:700px; height: 44px; overflow: auto;'>";
                        echo "<table border='0'>";
                        echo "<tr>";
                        echo "<td align='center' style=background-color:silver;color:black;font-size:1.3em;font-weight:bold;> ", date('d/m/y H:m:s', strtotime($publicacao[$i]->getDataHora())), " </td>";
                        echo "<td align='center' style=background-color:silver;color:black;font-size:1.5em;> ", $controller->montarLink($publicacao[$i]->getPublicacao()), " </td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</div>";

                        $i++;
                    }
                }
                echo "<hr /><br />";

                //amigos em comum
                echo "<h1>Amigos em comum:</h1><br />";
                echo "<span style=color:red;font-size:1.3em;>~~> Nenhum amigo em comum <~~</span><br /><br />";
                echo "<hr /><br />";
                ?>          
            </div>

            <?php
            echo StructDefault::createFooter();
            ?>            
        </div>

    </body>
</html>