<?php
require_once(__DIR__ . "/../include/header.php");
?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= BASEURL_CSS . DIRECTORY_SEPARATOR."anuncio.css" ?>">
    </head>
<?php
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="fade-in">
    <?php if (!empty($dados['anuncio']) && $dados['anuncio'] !== null): ?>
        <div class="anuncio-details">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= BASEURL_ARQUIVOS .DIRECTORY_SEPARATOR.htmlspecialchars($dados['anuncio']->getImagemLivro()) ?>" alt="<?= htmlspecialchars($dados['anuncio']->getNomeLivro()) ?>" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h3><?= htmlspecialchars($dados['anuncio']->getNomeLivro()) ?></h3>
                    <p><strong>Descrição:</strong> <?= htmlspecialchars($dados['anuncio']->getDescricao()) ?></p>
                    <p><strong>Publicado em:</strong> <?= htmlspecialchars($dados['anuncio']->getDataPublicacao()->format('d/m/Y')) ?></p>
                    <form method="GET" action="TrocasController.php">
                        <input type="hidden" name="action" value="trocasIntoPage">
                        <input type="hidden" name="idAnuncio" value="<?= $dados['anuncio']->getId() ?>"> 
                       <button type="submit" class="btn btn-primary">Trocar</button>
                    </form>
                    <a href="<?= BASEURL ?>/controller/DenunciaController.php?action=loadDenunciaForm&anuncio_id=<?= htmlspecialchars($dados['anuncio']->getId()) ?>&usuario_reu_id=<?= htmlspecialchars($dados['anuncio']->getUsuarioIdInt()) ?>&usuario_acusador_id=<?= htmlspecialchars($dados['usuario_logado_id']) ?>" class="btn btn-danger">Denunciar</a>
                </div>
            </div>
        </div>
               <form method="GET" action="TrocasController.php">
                        <input type="hidden" name="action" value="trocasIntoPage">
                        <input type="hidden" name="idAnuncio" value="<?= $dados['anuncio']->getId() ?>">
                        <p><?= htmlspecialchars($dados['anuncio']->getDescricao()) ?></p><!--descricao-->
                        <p>Anuncio Publicado: <?= $dados['anuncio']->getDataPublicacao()->format('d/m/Y'); ?></p>
                        <button type="submit" class="trade-button" id='<?= $dados['anuncio']->getId() ?>'>Trocar</button>
                    </form>
    <?php else: ?>
        <p>Anúncio não encontrado.</p>
    <?php endif; ?>
</div>

<?php
include_once(__DIR__."/../include/footer.php");
?>
