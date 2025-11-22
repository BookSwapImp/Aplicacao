<?php require_once(__DIR__ . "/../include/header.php"); ?>

<?php require_once(__DIR__ . "/headerMantenedor.php"); ?>
<div class="d-flex">
 <!-- Sidebar -->
    <?php include_once(__DIR__ . "/sidebar.php"); ?>
<div class="container-fluid mt-3">
    <div class="">
            <?php include_once(__DIR__ . "/sidebar.php"); ?>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <h1>Denúncias</h1>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-responsive">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Anúncio</th>
                                <th scope="col">Usuário Acusador</th>
                                <th scope="col">Usuário Réu</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados['denuncias'] as $denuncia) : ?>
                                <tr>
                                    <td><?php echo $denuncia->getId(); ?></td>
                                    <td><?php echo $denuncia->getDescricao(); ?></td>
                                    <td><a href="<?php echo BASEURL; ?>/controller/HomeController.php?action=anuncio&id=<?php echo $denuncia->getAnuncio() ? $denuncia->getAnuncio()->getId() : ''; ?>"><?php echo $denuncia->getAnuncio() ? $denuncia->getAnuncio()->getNomeLivro() : 'N/A'; ?></a></td>
                                    <td><a href="<?php echo BASEURL; ?>/controller/PerfilController.php?action=otherUserPerfilPage&id=<?php echo $denuncia->getUsuarioAcusador() ? $denuncia->getUsuarioAcusador()->getId() : ''; ?>"><?php echo $denuncia->getUsuarioAcusador() ? $denuncia->getUsuarioAcusador()->getNome() : 'N/A'; ?></a></td>
                                    <td><a href="<?php echo BASEURL; ?>/controller/PerfilController.php?action=otherUserPerfilPage&id=<?php echo $denuncia->getUsuarioReu() ? $denuncia->getUsuarioReu()->getId() : ''; ?>"><?php echo $denuncia->getUsuarioReu() ? $denuncia->getUsuarioReu()->getNome() : 'N/A'; ?></a></td>
                                    <td>
                                        <a href="<?php echo BASEURL; ?>/controller/HomeController.php?action=anuncio&id=<?php echo $denuncia->getAnuncio() ? $denuncia->getAnuncio()->getId() : ''; ?>" class="btn btn-primary btn-sm">Ver Anúncio</a>
                                        <a href="<?php echo BASEURL; ?>/controller/PerfilController.php?action=otherUserPerfilPage&id=<?php echo $denuncia->getUsuarioAcusador() ? $denuncia->getUsuarioAcusador()->getId() : ''; ?>" class="btn btn-secondary btn-sm">Ver Acusador</a>
                                        <a href="<?php echo BASEURL; ?>/controller/PerfilController.php?action=otherUserPerfilPage&id=<?php echo $denuncia->getUsuarioReu() ? $denuncia->getUsuarioReu()->getId() : ''; ?>" class="btn btn-info btn-sm">Ver Réu</a>
                                        <form method="POST" action="<?php echo BASEURL; ?>/controller/MantenedorController.php?action=banirUsuario" style="display:inline;">
                                            <input type="hidden" name="usuario_id" value="<?php echo $denuncia->getUsuarioReu() ? $denuncia->getUsuarioReu()->getId() : ''; ?>">
                                            <input type="hidden" name="denuncia_id" value="<?php echo $denuncia->getId(); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja banir este usuário?')">Banir Usuário</button>
                                       </form>
                                       <form method='POST'action="<?php echo BASEURL; ?>/controller/MantenedorController.php?action=removerDenuncia" style="display:inline;" >
                                            <input type="hidden" name="denuncia_id" value="<?php echo $denuncia->getId(); ?>">
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Tem certeza que deseja remover esta denúncia?')">Remover Denúncia</button>
                                      </form>
                                      <?php if ($denuncia->getAnuncio()) : ?>
                                      <form method='POST' action="<?php echo BASEURL; ?>/controller/MantenedorController.php?action=excluirAnuncio" style="display:inline;" >
                                            <input type="hidden" name="anuncio_id" value="<?php echo $denuncia->getAnuncio()->getId(); ?>">
                                            <button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('Tem certeza que deseja excluir este anúncio?')">Excluir Anúncio</button>
                                      </form>
                                      <?php endif; ?>
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