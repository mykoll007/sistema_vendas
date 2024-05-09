<?php

require_once 'entity/Usuario.php';
require_once 'dao/UsuarioDAO.php';

$type = filter_input(INPUT_POST, "type");

if($type === "register") {
    // Lógica de registro do usuário
    $new_nome = filter_input(INPUT_POST, "new_nome");
    $new_email = filter_input(INPUT_POST, "new_email", FILTER_SANITIZE_EMAIL);
    $new_password = filter_input(INPUT_POST, "new_password");
    $confirm_password = filter_input(INPUT_POST, "confirm_password");   
    
    if($new_email && $new_nome && $new_password) {
        if($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $usuario = new Usuario(null, $new_nome, $hashed_password, $new_email, null, null, null, null);    
            $usuarioDAO = new UsuarioDAO();
            $success = $usuarioDAO->create($usuario);

            if($success) {
                header("Location: index.php");
                exit();
            } else {
                // Tratar falha de registro em BD
            }
        } else {
            // TODO: exibir mensaem de senhas incompatíveis
        }
    } else {
        // TODO: exibir mensagem de formulário inválido
    }
} elseif ($type === "login") {
    // TODO: verificar se o usuário tem cadastro
    // dar ao usuário um token de sessão para navegar no site
}

?>
