<?php
session_start();

require_once './StructDefault.class.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>VulpixES.com - Sobre</title>
        <link rel="stylesheet" href="../style/structDefault.css" type="text/css" />
        <link rel="stylesheet" href="../style/login.css" type="text/css" />
    </head>
    <body>
        <?php
        echo StructDefault::createHead("<a href='./cadastro.php'>Criar Conta<a href='./sobre.php'>Sobre</a></a>");
        ?> 

        <div id="panelCenter">
            <br />
            <span>Trabalho desenvolvido pelos alunos:</span>
            <br />
            <span> * Alex Malmann Becker</span>
            <span> * Guilherme Bellaver</span>
            <span> * Miguel Zinelli</span>
            <br /><br /><br /><br />
            <span>Programação Web</span>
            <span>Engenharia de Software UNIPAMPA</span>
        </div>
    </body>
</html>