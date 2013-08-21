<?php

class Model {

    private $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli("localhost", "root", "", "social_network");
    }
}

