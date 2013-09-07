<?php

session_start();
require_once '../controller/ControllerPrincipal.class.php';
$controllerPrincipal = new ControllerPrincipal();
$controllerPrincipal->publicarMensagem();
