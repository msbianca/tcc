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
        <title>VulpixES.com - Publicações</title>
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
                <div id="entradaDados">
                    <br />
                    <h1>Publicar Conteúdo</h1>
                    <form name="publicacoes" action="../controller/publicarConteudo.php" method="POST">
                        <textarea maxlength="200" name="publicacao" required="required" cols="50" rows="3" style="width: 480px; margin: 2px 0px; height: 93px;"></textarea><br />
                        <input type="submit" value="  Publicar  ">
                    </form>
                    <br /><br />
                    <?php
                    $controller = new ControllerPrincipal();
                    $idpessoa = -1;

                    if (isset($_SESSION['idpessoa_logado'])) {
                        $idpessoa = $_SESSION['idpessoa_logado'];
                    }
                    $publicacao = $controller->mostrarPublicacoes($idpessoa);
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
                    ?>
                </div>
            </div>

            <div id="rodape">
                <p>&copy;Copyright VulpixEX.com 2013 - Todos os direitos reservados.</p>
            </div>
        </div>

    </body>
</html>