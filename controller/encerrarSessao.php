<?php

//apaga cookie
//if (isset($_COOKIE["connectOn"])) {
  //  setcookie("connectOn", "", time() - 3600);
//}

//recupera a variável $_SESSION se ela foi definida
session_start();

//finaliza sessao
session_destroy();

//volta para pagina de login
header("Location: ../View/login.php");
?>
