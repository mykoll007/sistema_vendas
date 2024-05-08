<?php

require_once 'entity/Usuario.php';
require_once 'dao/UsuarioDAO.php';

$type = filter_input(INPUT_POST, "type");

if($type === "register") {
    echo "entrou no método de registro";
    // Lógica de registro do usuário
    $new_nome = filter_input(INPUT_POST, "new_nome");
    $new_email = filter_input(INPUT_POST, "new_email", FILTER_SANITIZE_EMAIL);
    $new_password = filter_input(INPUT_POST, "new_password");    
    $confirm_password = filter_input(INPUT_POST, "confirm_password");

    echo filter_input(INPUT_POST, "new_nome");
    
    $usuario = new Usuario(null, $new_nome, $new_password, $new_email, null, null, null, null);    
    $usuarioDAO = new UsuarioDAO();
    $usuarioDAO->create($usuario);
} elseif ($type === "login") {
    // TODO: verificar se o usuário tem cadastro
    // dar ao usuário um token de sessão para navegar no site
}

?>
