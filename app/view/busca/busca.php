<?php
require_once(__DIR__ . "/../include/header.php");
?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
<?php
require_once(__DIR__ . "/../include/menu.php");
?>

<main class="container mt-4">
    <h2 class="mb-4">Resultados da Busca</h2>

    <?php if (!empty($dados)): ?>
        <div class="row">
            <?php foreach ($dados as $item): ?>
                <?php if ($item instanceof Anuncio): ?>
                    <!-- Display Anuncio -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="<?= BASEURL_ARQUIVOS . DIRECTORY_SEPARATOR . htmlspecialchars($item->getImagemLivro()) ?>" class="card-img-top" alt="<?= htmlspecialchars($item->getNomeLivro()) ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($item->getNomeLivro()) ?></h5>
                                <p class="card-text flex-grow-1"><?= htmlspecialchars(substr($item->getDescricao(), 0, 100)) ?>...</p>
                                <p class="card-text"><small class="text-muted">Publicado em: <?= htmlspecialchars($item->getDataPublicacao()->format('d/m/Y')) ?></small></p>
                                <form method="GET" action="<?= BASEURL ?>/controller/TrocasController.php" class="mt-auto">
                                    <input type="hidden" name="action" value="trocasIntoPage">
                                    <input type="hidden" name="idAnuncio" value="<?= htmlspecialchars($item->getId()) ?>">
                                    <button type="submit" class="btn btn-primary w-100">Trocar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php elseif ($item instanceof Usuario): ?>
                    <!-- Display Usuario -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column text-center">
                                <img src="<?= !empty($item->getFotoDePerfil()) ? BASEURL_ARQUIVOS . '/' . htmlspecialchars($item->getFotoDePerfil()) : BASEURL_ARQUIVOS . '/basePfp.jpeg' ?>" alt="Foto de Perfil" class="rounded-circle mx-auto mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                                <h5 class="card-title"><?= htmlspecialchars($item->getNome()) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($item->getEmail()) ?></p>
                                <form method="GET" action="<?= BASEURL ?>/controller/PerfilController.php" class="mt-auto">
                                    <input type="hidden" name="action" value="otherUserPerfil">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($item->getId()) ?>">
                                    <button type="submit" class="btn btn-outline-primary w-100">Ver Perfil</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            <?= !empty($msgErro) ? htmlspecialchars($msgErro) : 'Nenhum resultado encontrado para a busca.' ?>
        </div>
    <?php endif; ?>
</main>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
