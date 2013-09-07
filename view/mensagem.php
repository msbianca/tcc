<?php
//recupera a variável $_SESSION se ela foi definida
session_start();

if (!isset($_SESSION['login'])) {
    //não há usuário logado, manda pra página de login
    header("Location: ./login.php");
}

require_once './StructDefault.class.php';
require_once '../controller/ControllerPrincipal.class.php';
require_once '../util/Util.class.php';
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
            <?php
            echo StructDefault::createMenu();
            ?>

            <div id="direita">
                <br />
                <h1>Enviar Mensagem</h1><br />
                <form name="publicacoes" action="../controller/publicarMensagem.php" method="POST">
                    <?php
                    $controller = new ControllerPrincipal();

                    $idpessoa = -1;

                    if (isset($_SESSION['idpessoa_logado'])) {
                        $idpessoa = $_SESSION['idpessoa_logado'];
                    }

                    $amigos = $controller->mostrarAmigos($idpessoa);
                    $i = 0;
                    echo "<span style=font-size:1.3em;font-weight:bold;>Para: </span>";
                    echo "<select name='amigo' required='required'>";
                    while ($i < ModelConexao::totalRegistroFiltrados()) {
                        echo "<option value=", $amigos[$i]->getIdpessoaAmigo(), ">", $amigos[$i]->getNomeAmigo(), "</option>";
                        $i++;
                    }
                    echo "</select>";
                    ?>
                    <br /><br />
                    <textarea maxlength="200" name="mensagem" required="required" cols="50" rows="3" style="width: 480px; margin: 2px 0px; height: 93px;"></textarea><br />
                    <input type="submit" value="  Enviar  ">
                </form>
                <br /><br /><hr /><br />
                <?php
                $inc = 0;
                $tipoMensagem = 'Enviadas';
                $mensagemReceb = false;
                while ($inc < 2) {
                    echo "<h2>Mensagens $tipoMensagem</h2><br />";
                    $mensagens = $controller->mostrarMensagens($idpessoa, $mensagemReceb);
                    if (ModelConexao::totalRegistroFiltrados() == 0) {
                        echo "<span style=color:red;font-size:1.3em;>~~> Nenhuma mensagem <~~</span><br /><br />";
                    } else {
                        $i = 0;
                        while ($i < ModelConexao::totalRegistroFiltrados()) {
                            echo "<div style='width:700px; height: 44px; overflow: auto;'>";
                            echo "<table border='0'>";
                            echo "<tr>";
                            echo "<td align='center' style=background-color:silver;color:black;font-size:1.3em;font-weight:bold;> ", date('d/m/y H:m:s', strtotime($mensagens[$i]->getDataHora())), " </td>";
                            echo "<td align='center' style=background-color:silver;color:black;font-size:1.3em;font-weight:bold;><a href='perfilAmigo.php?id=", $mensagens[$i]->getIdpessoa(), "'> ", $mensagens[$i]->getNomePessoa(), " </a></td>";
                            echo "<td align='center' style=background-color:silver;color:black;font-size:1.5em;> ", Util::montarLink($mensagens[$i]->getMensagem()), " </td>";
                            echo "</tr>";
                            echo "</table>";
                            echo "</div>";

                            $i++;
                        }
                    }
                    echo "<hr /><br />";
                    $tipoMensagem = 'Recebidas';
                    $mensagemReceb = true;
                    $inc++;
                }
                ?>
            </div>

            <?php
            echo StructDefault::createFooter();
            ?>            
        </div>

    </body>
</html>