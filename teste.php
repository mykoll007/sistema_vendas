<?php

require_once "./backend/dao/UsuarioDAO.php";

$usuarioDAO = new UsuarioDAO();

echo $usuarioDAO->getById(1);

?>