<?php

//recupera a variável $_SESSION se ela foi definida
session_start();

//finaliza sessao
session_destroy();

//volta para pagina de login
header("Location: ../View/login.php");
?>
