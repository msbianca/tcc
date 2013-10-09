<?php

require_once '../controller/ControllerPrincipal.class.php';

$controllerPrincipal = new ControllerPrincipal();
$nome = $_GET['nome'];

header("Content-Type: text/xml");
echo $controllerPrincipal->procurarPessoas($nome);
