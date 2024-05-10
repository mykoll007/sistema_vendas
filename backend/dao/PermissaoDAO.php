<?php

require_once 'Database.php';
require_once 'entity/Permissao.php';

class PermissaoDAO implements BaseDAO {
    private $db;

    public function getById($id) {
        try {
            $sql = "SELECT * FROM Permissao WHERE Id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return new Permissao(
                    $result['Id'],
                    $result['Nome'],
                    $result['Descricao'],
                    $result['DataCriacao'],
                    $result['DataAtualizacao'],
                    $result['UsuarioAtualizacao'],
                    $result['Ativo']
                );
            }
            return null;
        } catch (PDOException $e) {
            // Handle exception (e.g., log error)
            return null;
        }
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM Permissao";
            $stmt = $this->db->query($sql);
            $permissions = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $permissions[] = new Permissao(
                    $row['Id'],
                    $row['Nome'],
                    $row['Descricao'],
                    $row['DataCriacao'],
                    $row['DataAtualizacao'],
                    $row['UsuarioAtualizacao'],
                    $row['Ativo']
                );
            }
            return $permissions;
        } catch (PDOException $e) {
            // Handle exception (e.g., log error)
            return [];
        }
    }

    public function create($permissao) {
        try {
            $sql = "INSERT INTO Permissao (Nome, Descricao, DataCriacao, DataAtualizacao, UsuarioAtualizacao, Ativo) 
                    VALUES (:nome, :descricao, :dataCriacao, :dataAtualizacao, :usuarioAtualizacao, :ativo)";
            $stmt = $this->db->prepare($sql);
            $nome = $permissao->getNome();
            $descricao = $permissao->getDescricao();
            $dataCriacao = $permissao->getDataCriacao();
            $dataAtualizacao = $permissao->getDataAtualizacao();
            $usuarioAtualizacao = $permissao->getUsuarioAtualizacao();
            $ativo = $permissao->getAtivo();
    
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':dataCriacao', $dataCriacao);
            $stmt->bindParam(':dataAtualizacao', $dataAtualizacao);
            $stmt->bindParam(':usuarioAtualizacao', $usuarioAtualizacao);
            $stmt->bindParam(':ativo', $ativo);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle exception (e.g., log error)
            return false;
        }
    }
    
    public function update($permissao) {
        try {
            $sql = "UPDATE Permissao 
                    SET Nome = :nome, Descricao = :descricao, DataCriacao = :dataCriacao, 
                        DataAtualizacao = :dataAtualizacao, UsuarioAtualizacao = :usuarioAtualizacao, 
                        Ativo = :ativo 
                    WHERE Id = :id";
            $stmt = $this->db->prepare($sql);
            $id = $permissao->getId();
            $nome = $permissao->getNome();
            $descricao = $permissao->getDescricao();
            $dataCriacao = $permissao->getDataCriacao();
            $dataAtualizacao = $permissao->getDataAtualizacao();
            $usuarioAtualizacao = $permissao->getUsuarioAtualizacao();
            $ativo = $permissao->getAtivo();
    
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':dataCriacao', $dataCriacao);
            $stmt->bindParam(':dataAtualizacao', $dataAtualizacao);
            $stmt->bindParam(':usuarioAtualizacao', $usuarioAtualizacao);
            $stmt->bindParam(':ativo', $ativo);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle exception (e.g., log error)
            return false;
        }
    }
    

    public function delete($id) {
        try {
            $sql = "DELETE FROM Permissao WHERE Id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle exception (e.g., log error)
            return false;
        }
    }

    public function getPermissaoByGrupoUsuarioId($grupoUsuarioId) {
        try {
            $sql = "SELECT Permissao.* FROM Permissao
                    INNER JOIN PermissaoGrupo ON Permissao.Id = PermissaoGrupo.PermissaoID
                    WHERE PermissaoGrupo.PermissaoID = :grupoUsuarioId";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':grupoUsuarioId', $grupoUsuarioId, PDO::PARAM_INT);
            $stmt->execute();

            $permissoes = [];

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $permissoes = new Permissao(
                    $row['Id'],
                    $row['Nome'],
                    $row['Descricao'],
                    $row['DataCriacao'],
                    $row['DataAtualizacao'],
                    $row['UsuarioAtualizacao'],
                    $row['Ativo']
                );
            }
            return $permissoes;

        } catch (PDOException $e) {
            return[];
        }
    }
}

?>