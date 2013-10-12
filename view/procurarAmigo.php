<?php
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
        <title>VulpixES.com - Procurar Amigos</title>
        <link rel="stylesheet" href="../style/principal.css" type="text/css" />
        <link rel="stylesheet" href="../style/structDefault.css" type="text/css" />
        <link rel="stylesheet" href="../style/pesquisaAmigos.css" type="text/css" />
    </head>
    <script>
        function searchPeople()
        {
            document.getElementById("SP_BUSCA").innerHTML = "";
            var nome = document.getElementById("nome");
            if (nome.value === "")
            {
                document.getElementById("SP_BUSCA").innerHTML = "";
                return;
            }
            var xmlhttp;
            var resultSearch, xml, xmlNome, xmlSobrenome, xmlId, pos;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function()
            {
                if ((xmlhttp.readyState === 4) && (xmlhttp.status === 200))
                {
                    try
                    {
                        xml = xmlhttp.responseXML.documentElement.getElementsByTagName("pessoa");
                    }
                    catch (error)
                    {
                        document.getElementById('SP_BUSCA').innerHTML = "<h2 style=color:red;>~~> Nenhuma pessoa encontrada com a palavra: " +
                                nome.value + " <~~</h2><br /><br />";
                    }

                    resultSearch = "<div id='amigos'><ul>";
                    for (pos = 0; pos < xml.length; pos++)
                    {
                        xmlId = xml[pos].getElementsByTagName("id");
                        xmlNome = xml[pos].getElementsByTagName("nome");
                        xmlSobrenome = xml[pos].getElementsByTagName("sobrenome");
                        {
                            try
                            {
                                resultSearch = resultSearch + "<li>" +
                                        "<a href='perfilAmigo.php?id=" + xmlId[0].firstChild.nodeValue + "'>" +
                                        xmlNome[0].firstChild.nodeValue + " " + xmlSobrenome[0].firstChild.nodeValue +
                                        "</a>" +
                                        "</li>";
                            }
                            catch (error)
                            {
                                resultSearch = resultSearch + "<li>Erro ao retornar dados</li>";
                            }
                        }
                    }
                    resultSearch = resultSearch + "</ul></div>";
                    document.getElementById('SP_BUSCA').innerHTML = resultSearch;
                }
            };
            xmlhttp.open("GET", "../controller/buscarPessoas.php?nome=" + nome.value, true);
            xmlhttp.send();
        }
    </script>

    <body>
        <?php
        echo StructDefault::createHead("<a href='../controller/encerrarSessao.php'>Sair</a>");
        ?>

        <div id="site">
            <?php
            echo StructDefault::createMenu();
            ?>

            <div id="direita">
                <br />
                <h1>Procurar Amigos</h1><br />
                <span style=font-size:1.3em;font-weight:bold;>Digite o nome da pessoa: </span>
                <input type="text" id="nome" onkeyup="searchPeople();">
                <br /><br /><hr /><br />
                <div id="SP_BUSCA"></div>
            </div>

            <?php
            echo StructDefault::createFooter();
            ?>            
        </div>

    </body>
</html>