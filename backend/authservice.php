<?php

require_once 'entity/Usuario.php';
require_once 'dao/UsuarioDAO.php';

$type = filter_input(INPUT_POST, "type");

if($type === "register") {
    // Recebimento dos dados vindos por input do HTML
    $new_nome = filter_input(INPUT_POST, "new_nome");
    $new_email = filter_input(INPUT_POST, "new_email", FILTER_SANITIZE_EMAIL);
    $new_password = filter_input(INPUT_POST, "new_password");
    $confirm_password = filter_input(INPUT_POST, "confirm_password");   
    
    // Verificacoes dos dados informados
    if($new_email && $new_nome && $new_password) {
        if($new_password === $confirm_password) {

            // Etapas e seguranca, criacao de senha segura e geracao de token
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(25));
            
            // Criacao do Usuario no banco de dados por uso do UsuarioDAO
            $usuario = new Usuario(null, $new_nome, $hashed_password, $new_email, null, null, null, null, $token);
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
    // Recebimento dos dados vindos por input do HTML
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password");

    // Verificacao de cadastro existente
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->getByEmail($email);

    // Redirecionamento de usuario apos login
    if($usuario && password_verify($password, $usuario->getSenha())) {        
        header("Location: index.php");
        exit();
    } else {
        header("Location: error_page.php");
        exit();
    }
}

?>
