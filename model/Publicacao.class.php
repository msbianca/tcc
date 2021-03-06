<?php

/**
 * Classe Publicação
 *
 * @author aLeX
 */
class Publicacao {

    private $idpublicao;
    private $dataHora;
    private $publicacao;

    public function __construct($idpublicao, $dataHora, $publicacao) {
        $this->idpublicao = $idpublicao;
        $this->dataHora = $dataHora;
        $this->publicacao = $publicacao;
    }

    public function getIdpublicacao() {
        return $this->idpublicao;
    }

    public function getDataHora() {
        return $this->dataHora;
    }

    public function getPublicacao() {
        return $this->publicacao;
    }

}

?>
