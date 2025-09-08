<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Meus Endereços</h2>
        <a href="<?= BASEURL ?>/controller/EnderecosController.php?action=cadastroEnderecoPage" class="btn btn-primary btn-sm">Adicionar</a>
    </div>

    <?php if (!isset($dados['enderecos']) || empty($dados['enderecos'])): ?>
        <div class="alert alert-info">Nenhum endereço cadastrado.</div>
    <?php else: ?>

        <div class="row row-cols-1 row-cols-md-2 g-3">
            <?php foreach ($dados['enderecos'] as $row): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body"></div>
                            <h5 class="card-title"><?= htmlspecialchars($row->getNome()) ?></h5>
                            <p class="card-text mb-1"><strong>Rua:</strong> <?= htmlspecialchars($row->getRua()) ?></p>
                            <p class="card-text mb-1"><strong>Cidade:</strong> <?= htmlspecialchars($row->getCidade()) ?></p>
                            <p class="card-text mb-1"><strong>Estado:</strong> <?= htmlspecialchars($row->getEstado()) ?></p>
                            <p class="card-text mb-1"><strong>CEP:</strong> <?= htmlspecialchars($row->getCep()) ?></p>
                            <p class="card-text mb-1"><strong>Número:</strong> <?= htmlspecialchars($row->getNumb()) ?></p>
                            <p class="card-text"><small class="text-muted"><?= htmlspecialchars($row->getMain())?></small></p>
                        
                            <form method="POST" action="<?= BASEURL ?>/controller/EnderecosController.php?action=editarEnderecosPage" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $row->getId() ?>">
                                <button type="submit" class="btn btn-sm btn-primary btn-left">Editar</button>
                            </form>
                            <form method="POST" action="<?= BASEURL ?>/controller/EnderecosController.php?action=DeletarEnderecos" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $row->getId() ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar exclusão?')">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once(__DIR__ . "/../include/footer.php"); ?>