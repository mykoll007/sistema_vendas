<?php
class Usuario {
    // Propriedades
    private $id;
    private $nomeUsuario;
    private $senha;
    private $email;
    private $grupoUsuarioID;
    private $ativo;
    private $dataCriacao;
    private $dataAtualizacao;
    private $token;

    // Método Construtor
    public function __construct($id, $nomeUsuario, $senha, $email, $grupoUsuarioID, $ativo = 1, $dataCriacao = null, $dataAtualizacao = null, $token) {
        $this->id = $id;
        $this->nomeUsuario = $nomeUsuario;
        $this->senha = $senha;
        $this->email = $email;
        $this->grupoUsuarioID = $grupoUsuarioID;
        $this->ativo = $ativo;
        $this->dataCriacao = $dataCriacao;
        $this->dataAtualizacao = $dataAtualizacao;
        $this->token = $token;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getGrupoUsuarioId() {
        return $this->grupoUsuarioID;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }
    
    public function getToken() {
        return $this->token;
    }
}
?>