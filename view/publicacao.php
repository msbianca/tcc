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
        <title>VulpixES.com - Publicações</title>
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
                <br />
                <h1>Publicar Conteúdo</h1>
                <form name="publicacoes" action="../controller/publicarConteudo.php" method="POST">
                    <textarea maxlength="200" name="publicacao" required="required" cols="50" rows="3" style="width: 480px; margin: 2px 0px; height: 93px;"></textarea><br />
                    <input type="submit" value="  Publicar  ">
                </form>
                <br /><br /><hr /><br />
                <?php
                $controller = new ControllerPrincipal();
                $idpessoa = -1;

                if (isset($_SESSION['idpessoa_logado'])) {
                    $idpessoa = $_SESSION['idpessoa_logado'];
                }
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
                ?>
            </div>

            <?php
            echo StructDefault::createFooter();
            ?>            
        </div>

    </body>
</html>