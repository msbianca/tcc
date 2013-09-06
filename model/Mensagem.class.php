<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mensagem
 *
 * @author aLeX
 */
class Mensagem {

    private $idmensagem;
    private $dataHora;
    private $mensagem;
    private $nomePessoa;

    public function __construct($idmensagem, $dataHora, $mensagem, $nomePessoa) {
        $this->idmensagem = $idmensagem;
        $this->dataHora = $dataHora;
        $this->mensagem = $mensagem;
        $this->nomePessoa = $nomePessoa;
    }

    public function getIdmensagem() {
        return $this->idmensagem;
    }

    public function getDataHora() {
        return $this->dataHora;
    }

    public function getMensagem() {
        return $this->mensagem;
    }
    
    public function getNomePessoa() {
        return $this->nomePessoa;
    }

}

?>
