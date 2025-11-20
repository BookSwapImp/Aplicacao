<?php require_once(__DIR__ . "/../include/header.php"); ?>

<?php require_once(__DIR__ . "/headerMantenedor.php"); ?>
<div class="d-flex">
   <?php require_once(__DIR__ . "/sidebar.php"); ?>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <h1>Anúncios</h1>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Título</th>
                                <th scope="col">Usuário</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados['anuncios'] as $anuncio) : ?>
                                <tr>
                                    <td><?php echo $anuncio->getId(); ?></td>
                                    <td><a href="<?php echo BASEURL; ?>/controller/HomeController.php?action=anuncio&id=<?php echo $anuncio->getId(); ?>"><?php echo $anuncio->getNomeLivro(); ?></a></td>
                                   <td><?php echo $anuncio->getDescricao(); ?></td>
                                    <td><?php echo $anuncio->getStatus(); ?></td>
                                    <td>
                                        <a href="<?php echo BASEURL; ?>/controller/HomeController.php?action=anuncio&id=<?php echo $anuncio->getId(); ?>" class="btn btn-primary btn-sm">Ver Anúncio</a>
                                        <a href="<?php echo BASEURL; ?>/controller/PerfilController.php?action=otherUserPerfilPage&id=<?php echo $anuncio->getUsuarioIdInt(); ?>" class="btn btn-secondary btn-sm">Ver Usuário</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>