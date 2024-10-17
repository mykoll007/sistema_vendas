<?php

require_once "./backend/dao/UsuarioDAO.php";
require_once "./backend/dao/GrupoUsuarioDAO.php";

$usuarioDAO = new UsuarioDAO();
$grupoUsuarioDAO = new GrupoUsuarioDAO();


// Recuperar o usuário
$usuario = $usuarioDAO->getById(1);
echo "<pre>";
echo $usuario;
echo "</pre>";

// Recuperar o usuário com grupo
$usuario = $usuarioDAO->getUsuarioWithGrupo(1);
echo "<pre>";
echo $usuario;
echo "</pre>";

// Recuperar o grupo com permissões
$grupoUsuario = $grupoUsuarioDAO->getGrupoUsuarioWithPermissions($usuario->getGrupoUsuario()->getId());


echo "<pre>";
echo $grupoUsuario;
echo "</pre>";

