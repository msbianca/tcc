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
        <title>VulpixES.com - Amigos</title>
        <link rel="stylesheet" href="../style/principal.css" type="text/css" />
        <link rel="stylesheet" href="../style/structDefault.css" type="text/css" />
        <link rel="stylesheet" href="../style/pesquisaAmigos.css" type="text/css" />
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
                <h1>Amigos</h1><br /><hr />
                <?php
                $controller = new ControllerPrincipal();

                $idpessoa = -1;

                if (isset($_SESSION['idpessoa_logado'])) {
                    $idpessoa = $_SESSION['idpessoa_logado'];
                }

                $amigos = $controller->mostrarAmigos($idpessoa);
                if (ModelConexao::totalRegistroFiltrados() == 0) {
                    echo "<br /><span style=color:red;font-size:1.3em;>~~> Você não tem nenhum amigo em sua rede <~~</span><br /><br />";
                } else {
                    $i = 0;
                    while ($i < ModelConexao::totalRegistroFiltrados()) {
                        echo "<div id='amigos'>";
                        echo "<ul>";
                        echo "<li><a href='perfilAmigo.php?id=", $amigos[$i]->getIdpessoaAmigo(), "'>", $amigos[$i]->getNomeAmigo(), "</a></li>";
                        echo "</ul>";
                        echo "</div>";

                        $i++;
                    }
                }
                ?>
                <hr /></div>

            <?php
            echo StructDefault::createFooter();
            ?>            
        </div>

    </body>
</html>