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
        <title>VulpixES.com - Procurar Amigos</title>
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
                <h1>Procurar Amigos</h1><br />
                <form name="procurar" action="procurarAmigo.php" method="POST">
                    <span style=font-size:1.3em;font-weight:bold;>Digite o nome da pessoa: </span>
                    <input type="text" name="nome" required="required" class="inputTxt"/>
                    <input type="submit" value="  Pesquisar  ">
                </form>
                <br /><br /><hr /><br />
                <?php
                $controller = new ControllerPrincipal();
                $idpessoa = -1;

                if (isset($_SESSION['idpessoa_logado'])) {
                    $idpessoa = $_SESSION['idpessoa_logado'];
                }

                $nome = "/ -1";
                if (isset($_POST['nome'])) {
                    $nome = $_POST['nome'];
                }
                if ($nome != "/ -1") {
                    $pesquisa = $controller->procurarAmigos($nome);
                    if (ModelConexao::totalRegistroFiltrados() == 0) {
                        echo "<h2 style=color:red;>~~> Nenhuma pessoa encontrada com a palavra: '$nome' <~~</h2><br /><br />";
                    } else {
                        echo "<h2 style=color:red;>Encontrado ", ModelConexao::totalRegistroFiltrados(), " pessoa(s):</h2><br />";
                        $i = 0;
                        while ($i < ModelConexao::totalRegistroFiltrados()) {
                            echo "<div id='amigos'>";
                            echo "<ul>";
                            echo "<li><a href='perfilAmigo.php?id=", $pesquisa[$i]->getIdpessoa(), "'>", $pesquisa[$i]->getNome() . " " . $pesquisa[$i]->getSobrenome(), "</a></li>";
                            echo "</ul>";
                            echo "</div>";

                            $i++;
                        }
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