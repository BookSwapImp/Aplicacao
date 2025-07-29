<?php
include_once(__DIR__."/../include/header.php");
?>


<div class="fade-in">
    <h2>Detalhes do Anúncio</h2>
    <?php if (!empty($dados)): ?>
        <div class="anuncio-details">
            <img src="<?= htmlspecialchars($dados->getImagemLivro()) ?>" alt="<?= htmlspecialchars($dados->getNomeLivro()) ?>" style="max-width: 300px; max-height: 400px;">
            <h3><?= htmlspecialchars($dados->getNomeLivro()) ?></h3>
            <p><strong>Descrição:</strong> <?= htmlspecialchars($dados->getDescricao()) ?></p>
            <p><strong>Preço:</strong> R$<?= number_format($dados->getValorAnuncio(), 2, ',', '.') ?></p>
            <p><strong>Publicado em:</strong> <?= $dados->getDataPublicacao()->format('d/m/Y') ?></p>
        </div>
    <?php else: ?>
        <p>Anúncio não encontrado.</p>
    <?php endif; ?>
</div>

<?php
include_once(__DIR__."/../include/footer.php");
?>
