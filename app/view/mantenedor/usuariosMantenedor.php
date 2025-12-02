
<?php require_once(__DIR__ . "/headerMantenedor.php"); ?>
 <!-- Sidebar -->
    <div class="d-flex">
    <?php include_once(__DIR__ . "/sidebar.php"); ?>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <h1>Usuários</h1>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(empty($dados['usuarios'])) echo '<div class="data-message">
                            <h4 class="text-muted mb-3">Aviso</h4>    
                                <p class="lead text-secondary">
                                    <strong>Não há dados</strong>
                                </p>
                                <small class="text-muted">Nenhum registro foi encontrado para os critérios de busca.</small>
                            </div>' ; else{
                            foreach ($dados['usuarios'] as $usuario) : ?>
                                <tr>
                                    <td><?php echo $usuario->getId(); ?></td>
                                    <td><a href="<?php echo BASEURL; ?>/controller/PerfilController.php?action=otherUserPerfilPage&id=<?php echo $usuario->getId(); ?>"><?php echo $usuario->getNome(); ?></a></td>
                                    <td><?php echo $usuario->getEmail(); ?></td>
                                    <td><?php echo $usuario->getStatus(); ?></td>
                                    <td>
                                        <a href="<?php echo BASEURL; ?>/controller/PerfilController.php?action=otherUserPerfilPage&id=<?php echo $usuario->getId(); ?>" class="btn btn-primary btn-sm">Ver Perfil</a>
                                        <form method="POST" action="<?php echo BASEURL; ?>/controller/MantenedorController.php?action=banirUsuario" style="display:inline;">
                                            <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $usuario->getId(); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja banir este usuário?')">Banir</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
