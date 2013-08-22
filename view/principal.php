<?php
//recupera a variável $_SESSION se ela foi definida
session_start();

if (!isset($_SESSION['login'])) {
    //não há usuário logado, manda pra página de login
    header("Location: ./login.php");
}
?>
﻿<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>VulpixES.com - Home</title>
        <!--<link rel="stylesheet" href="../style/login.css" type="text/css" /> -->
    </head>
    <body>
    <p2><a href="../Controller/encerrarSessao.php">Efetuar logout</a></p2>
</body>
</html>