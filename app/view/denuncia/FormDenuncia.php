<?php
require_once(__DIR__ . "/../include/header.php");
?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
<?php
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="container mt-5">
    <h2>Denunciar Anúncio</h2>
    <form method="POST" action="<?= BASEURL ?>/controller/DenunciaController.php?action=createDenuncia">
        <input type="hidden" name="anuncio_id" value="<?= htmlspecialchars($dados['anuncio_id']) ?>">
        <input type="hidden" name="usuario_reu_id" value="<?= htmlspecialchars($dados['usuario_reu_id']) ?>">
        <input type="hidden" name="usuario_acusador_id" value="<?= htmlspecialchars($dados['usuario_acusador_id']) ?>">
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição da Denúncia</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Enviar Denúncia</button>
        <a href="<?= BASEURL ?>/controller/HomeController.php?action=anuncio&id=<?= htmlspecialchars($dados['anuncio_id']) ?>" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
