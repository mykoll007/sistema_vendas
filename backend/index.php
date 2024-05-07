<?php
    require_once("template/header.php");
    require_once 'dao/GrupoUsuarioDAO.php';
    require_once 'entity/GrupoUsuario.php';


    $grupoUsuarioDao = new GrupoUsuarioDAO();

    //echo $grupoUsuarioDao->getById(1)->getDataCriacao();
    //print_r($grupoUsuarioDao->getAll());
    $novoGrupoUsuario = new GrupoUsuario(null, "Generico", "Usuario Padrão da Aplicação", null, null, 1);
    echo $grupoUsuarioDao->create($novoGrupoUsuario);

?>
    <h1>Olá Sistema Vendas Body</h1>
</body>

<?php
    require_once("template/footer.php");
?>