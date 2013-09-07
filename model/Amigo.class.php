<?php

/**
 * Classe Amigo
 *
 * @author aLeX
 */
class Amigo {

    private $idamigo;
    private $idpessoa_amigo;
    private $nomeAmigo;

    public function __construct($idamigo, $idpessoa_amigo, $nomeAmigo) {
        $this->idamigo = $idamigo;
        $this->nomeAmigo = $nomeAmigo;
        $this->idpessoa_amigo = $idpessoa_amigo;
    }

    public function getIdamigo() {
        return $this->idamigo;
    }

    public function getIdpessoaAmigo() {
        return $this->idpessoa_amigo;
    }

    public function getNomeAmigo() {
        return $this->nomeAmigo;
    }

}

?>
