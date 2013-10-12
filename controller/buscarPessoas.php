<?php

require_once '../controller/ControllerPrincipal.class.php';

header("Content-Type: text/xml");

$controllerPrincipal = new ControllerPrincipal();
echo $controllerPrincipal->procurarPessoas($_GET['nome']);