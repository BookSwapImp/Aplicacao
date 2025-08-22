<?php
require_once(__DIR__ . "/../include/header.php");
?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
<?php
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="fade-in">
    <h2>Detalhes do Anúncio</h2>
    <?php if (!empty($dados['anuncio']) && $dados['anuncio'] !== null): ?>
        <div class="anuncio-details">
            <div>
                <img src="<?= BASEURL_ARQUIVOS .DIRECTORY_SEPARATOR.htmlspecialchars($dados['anuncio']->getImagemLivro()) ?>" alt="<?= htmlspecialchars($dados['anuncio']->getNomeLivro()) ?>" style="max-width: 300px; max-height: 400px;">
                <h3><?= htmlspecialchars($dados['anuncio']->getNomeLivro()) ?></h3>
                <p><strong>Descrição:</strong> <?= htmlspecialchars($dados['anuncio']->getDescricao()) ?></p>
                <p><strong>Publicado em:</strong> <?= htmlspecialchars($dados['anuncio']->getDataPublicacao()->format('d/m/Y')) ?></p>
            </div>
            <div>
                <p><?= htmlspecialchars($dados['anuncio']->getDescricao()) ?></p>
                <button class="trade-button"id='<?= htmlspecialchars($dados['anuncio']->getId()) ?>'>Trocar</button>
            </div>
        </div>
    <?php else: ?>
        <p>Anúncio não encontrado.</p>
    <?php endif; ?>
</div>

<?php
include_once(__DIR__."/../include/footer.php");
?>
