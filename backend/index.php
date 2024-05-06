<?php
    require_once("template/header.php");
    require_once 'dao/UsuarioDAO.php';
    require_once 'entity/Usuario.php';

    $usuarioDao = new UsuarioDAO();
    //echo $usuarioDao->getById(1)->getNomeUsuario();
    // print_r($usuarioDao->getAll());

    // $novoUsuario = new Usuario(null, "novo usuario B", "1234aerqe", "novouser@mail.com", null, 1);
    // echo $novoUsuario->getNomeUsuario();

    // $usuarioDao->create($novoUsuario);
    $novoUsuario = new Usuario(2, "Clayton", "1234aerqe", "novouser@mail.com", null, 1);
    $usuarioDao->update($novoUsuario);
  

?>
    <h1>Olá Sistema Vendas Body</h1>
</body>

<?php
    require_once("template/footer.php");
?>