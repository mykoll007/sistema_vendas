<?php

require_once 'config/Database.php';
require_once 'entity/Usuario.php';
require_once 'BaseDAO.php';

class UsuarioDAO implements BaseDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getById($id) {
        try {
            // Preparar a consulta SQL
            $sql = "SELECT * FROM Usuario WHERE Id = :id";

            // Preparar a instrução
            $stmt = $this->db->prepare($sql);

            // Vincular parâmetros
            $stmt->bindParam(':id', $id);

            // Executa a instrução
            $stmt->execute();

            // Obtem o usuario encontrado;
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Retorna o usuário encontrado
            return $usuario ? 
                new Usuario($usuario['Id'],
                            $usuario['NomeUsuario'], 
                            $usuario['Senha'], 
                            $usuario['Email'], 
                            $usuario['GrupoUsuarioID'],
                            $usuario['Ativo'],
                            $usuario['DataCriacao'],
                            $usuario['DataAtualizacao']) 
                : null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getAll() {
        try {
            // Preparar a consulta SQL
            $sql = "SELECT * FROM Usuario";

            // Preparar a instrução
            $stmt = $this->db->prepare($sql);

            // Executa a instrução
            $stmt->execute();

            // Obtem o usuario encontrado;
            $usuarios = $stmt->fetch(PDO::FETCH_ASSOC);

            return array_map(function ($usuario) {
                return new Usuario($usuario['Id'],
                    $usuario['NomeUsuario'], 
                    $usuario['Senha'], 
                    $usuario['Email'], 
                    $usuario['GrupoUsuarioID'],
                    $usuario['Ativo'],
                    $usuario['DataCriacao'],
                    $usuario['DataAtualizacao']);
            }, $usuarios);            
        } catch (PDOException $e) {
            return null;
        }
    }

    public function create($usuario) {
        try {
            // Preparar a consulta SQL
            $sql = "INSERT INTO Usuario( NomeUsuario , Senha , Email , GrupoUsuarioID , Ativo , DataCriacao , DataAtualizacao , UsuarioAtualizacao )
                    VALUES(:nomeUsuario, :senha, :email, :grupoUsuarioID, :ativo, current_timestamp(),current_timestamp(),null)";

            // Preparar a instrução
            $stmt = $this->db->prepare($sql);

            // Vincular parâmetros
            $stmt->bindParam(':nomeUsuario', $usuario->getNomeUsuario());
            $stmt->bindParam(':senha', $usuario->getSenha());
            $stmt->bindParam(':email', $usuario->getEmail());
            $stmt->bindParam(':grupoUsuarioID', $usuario->getGrupoUsuarioId());
            $stmt->bindParam(':ativo', $usuario->getAtivo());
            
            // Executar a instrução
            $stmt->execute();

            // Retornar verdadeiro se a inserção for bem sucedida
            return true;
        } catch (PDOException $e) {
            // TO-DO: implementar log
            return false;
        }
    }

    public function update($usuario) {
        try {
            // Verifico se o usuário existe no banco de dados
            $existingUser = $this->getById($usuario->getId());

            if(!$existingUser) {
                return false;// Retorna falso se o usuário não existir
            }

            $sql = "UPDATE Usuario SET NomeUsuario = :nomeUsuario, Senha = :senha, Email = :email,
            GrupoUsuarioID = :grupoUsuarioID, Ativo = :ativo, DataAtualizacao = current_timestamp()
            WHERE Id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':id', $usuario->getId());
            $stmt->bindParam(':nomeUsuario', $usuario->getNomeUsuario());
            $stmt->bindParam(':senha', $usuario->getSenha());
            $stmt->bindParam(':email', $usuario->getEmail());
            $stmt->bindParam(':grupoUsuarioID', $usuario->getGrupoUsuarioId());
            $stmt->bindParam(':ativo', $usuario->getAtivo());

            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            // TO-DO: implementar log
            return false;
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM Usuario WHERE Id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>