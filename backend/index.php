<?php
    require_once("template/header.php");
    require_once 'dao/UsuarioDAO.php';

    $usuarioDao = new UsuarioDAO();
    $usuario = $usuarioDao->getById(1);
    $x = $usuario->getSenha();
    echo "$x";

?>
    <h1>Olá Sistema Vendas Body</h1>
</body>

<?php
    require_once("template/footer.php");
?>