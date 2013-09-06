<?php

session_start();
require_once '../controller/ControllerPrincipal.php';
$controllerPrincipal = new ControllerPrincipal();
$idamigo = -1;
if (isset($_GET['id'])) {
    $idamigo = $_GET['id'];
}
$controllerPrincipal->adicionarAmigo($idamigo);
