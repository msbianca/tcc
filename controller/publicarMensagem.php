<?php
session_start();
require_once '../controller/ControllerPrincipal.php';
$controllerPrincipal = new ControllerPrincipal();
$controllerPrincipal->publicarMensagem();