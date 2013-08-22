<?php

include_once '../model/ModelPrincipal.php';

class ControllerPrincipal {

    public $modelPrincipal;

    public function __construct() {
        $this->modelPrincipal = new ModelPrincipal();
    }
}

?>