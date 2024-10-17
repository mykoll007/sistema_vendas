<?php

require_once '../config/Database.php';
require_once '../entity/Usuario.php';
require_once 'BaseDAO.php';

class UsuarioDAO implements BaseDAO {
    private $db;
    private $grupoUsuarioGenericoId = 3;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM Usuario WHERE Id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([':id' => $id]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            return $usuario ? 
                new Usuario($usuario['Id'],
                            $usuario['NomeUsuario'], 
                            $usuario['Senha'], 
                            $usuario['Email'], 
                            $usuario['GrupoUsuarioID'],
                            $usuario['Ativo'],
                            $usuario['DataCriacao'],
                            $usuario['DataAtualizacao'],
                            $usuario['Token']) 
                : null;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM Usuario";
    
            $stmt = $this->db->prepare($sql);
    
            $stmt->execute();
    
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return array_map(function ($usuario) {
                return new Usuario(
                    $usuario['Id'],
                    $usuario['NomeUsuario'],
                    $usuario['Senha'],
                    $usuario['Email'],
                    $usuario['GrupoUsuarioID'],
                    $usuario['Ativo'],
                    $usuario['DataCriacao'],
                    $usuario['DataAtualizacao'],
                    $usuario['Token']
                );
            }, $usuarios);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function create($usuario) {
        try {
            $sql = "INSERT INTO Usuario( NomeUsuario , Senha , Email , GrupoUsuarioID , Ativo , DataCriacao , DataAtualizacao , UsuarioAtualizacao, Token)
                    VALUES(:nomeUsuario, :senha, :email, :grupoUsuarioID, :ativo, current_timestamp(),current_timestamp(),null, :token)";

            $stmt = $this->db->prepare($sql);
            
            $stmt->execute([
                ':nomeUsuario' => $usuario->getNomeUsuario(),
                ':senha' => $usuario->getSenha(),
                ':email' => $usuario->getEmail(),
                ':grupoUsuarioID' => this->grupoUsuarioGenericoId,
                ':ativo' => $usuario->getAtivo(),
                ':token' => $usuario->getToken()
            ]);

            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function update($usuario) {
        try {
            $existingUser = $this->getById($usuario->getId());

            if(!$existingUser) {
            }

            $sql = "UPDATE Usuario SET NomeUsuario = :nomeUsuario, Senha = :senha, Email = :email,
            GrupoUsuarioID = :grupoUsuarioID, Ativo = :ativo, DataAtualizacao = current_timestamp(), Token = :token
            WHERE Id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':id' => $usuario->getId(),
                ':nomeUsuario' => $usuario->getNomeUsuario(),
                ':senha' => $usuario->getSenha(),
                ':email' => $usuario->getEmail(),
                ':grupoUsuarioID' => $usuario->getGrupoUsuarioId(),
                ':ativo' => $usuario->getAtivo(),
                ':token' => $usuario->getToken()
            ]);

            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM Usuario WHERE Id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);

            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function updateToken($id, $token) {
        $sql = "UPDATE Usuario SET Token = :token WHERE Id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id,
            ':token' => $token
        ]);

        return $token;
    }

    public function getByEmail($email) {
        try {
            $sql = "SELECT * FROM Usuario WHERE Email = :email";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([':email' => $email]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);            

            return $usuario ? 
                new Usuario($usuario['Id'],
                            $usuario['NomeUsuario'], 
                            $usuario['Senha'], 
                            $usuario['Email'], 
                            $usuario['GrupoUsuarioID'],
                            $usuario['Ativo'],
                            $usuario['DataCriacao'],
                            $usuario['DataAtualizacao'],
                            $usuario['Token']) 
                : null;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
}

?>