<?php
    require_once("template/header.php");
    require_once 'dao/UsuarioDAO.php';

    $usuarioDao = new UsuarioDAO();
    if($usuarioDao->getById(1)) {
        echo "Usuario Existe";
    } else {
        echo "Usuario Não existe";
    }

?>
    <h1>Olá Sistema Vendas Body</h1>
</body>

<?php
    require_once("template/footer.php");
?>