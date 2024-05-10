<?php

class Permissao {
    private $id;
    private $nome;
    private $descricao;
    private $dataCriacao;
    private $dataAtualizacao;
    private $usuarioAtualizacao;
    private $ativo;

    // Constructor
    public function __construct($id, $nome, $descricao, $dataCriacao, $dataAtualizacao, $usuarioAtualizacao, $ativo) {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->dataCriacao = $dataCriacao;
        $this->dataAtualizacao = $dataAtualizacao;
        $this->usuarioAtualizacao = $usuarioAtualizacao;
        $this->ativo = $ativo;
        $this->id = $id;
    }

    // Getters
    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    public function getUsuarioAtualizacao() {
        return $this->usuarioAtualizacao;
    }

    public function getAtivo() {
        return $this->ativo;
    }
}


?>