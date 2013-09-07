<?php

/**
 * Classe Pessoa
 *
 * @author aLeX
 */
class Pessoa {

    private $idpessoa;
    private $nome;
    private $sobrenome;
    private $data_nascimento;
    private $login;
    private $email;
    private $auto_definicao;
    private $total_amigos;

    public function __construct($idpessoa, $nome, $sobrenome, $data_nascimento, $login, $email, $auto_definicao, $total_amigos) {
        $this->idpessoa = $idpessoa;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->data_nascimento = $data_nascimento;
        $this->login = $login;
        $this->email = $email;
        $this->auto_definicao = $auto_definicao;
        $this->total_amigos = $total_amigos;
    }

    public function getIdpessoa() {
        return $this->idpessoa;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function getDataNascimento() {
        return $this->data_nascimento;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAutoDefinicao() {
        return $this->auto_definicao;
    }

    public function getTotalAmigos() {
        return $this->total_amigos;
    }

}