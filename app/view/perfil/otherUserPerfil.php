<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-user me-2"></i><?= htmlspecialchars($dados['usuario']->getNome()) ?>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Foto do Perfil -->
                        <div class="col-md-4 text-center mb-3">
                            <div class="position-relative">
                                <img src="<?= !empty($dados['usuario']->getFotoDePerfil()) ? BASEURL_ARQUIVOS . '/' . $dados['usuario']->getFotoDePerfil() : BASEURL_ARQUIVOS . '/basePfp.jpeg' ?>" 
                                     alt="Foto de Perfil" 
                                     class="rounded-circle img-thumbnail" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                        </div>
                        <!-- Informações do Usuário -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <h5 class="text-primary">Informações Pessoais</h5>
                                    <hr>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-muted">Nome:</label>
                                    <p class="form-control-plaintext"><?= htmlspecialchars($dados['usuario']->getNome()) ?></p>
                                </div>
                                        
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-muted">Telefone:</label>
                                    <p class="form-control-plaintext">
                                        <?= !empty($dados['usuario']->getTelefone()) ? htmlspecialchars($dados['usuario']->getTelefone()) : 'Não informado' ?>
                                    </p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-muted">Tipo de Usuário:</label>
                                    <span class="badge bg-<?= $dados['usuario']->getTipo() === 'ADMINISTRADOR' ? 'danger' : 'success' ?>">
                                        <?= $dados['usuario']->getTipo() ?>
                                    </span>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-muted">Status:</label>
                                    <span class="badge bg-<?= $dados['usuario']->getStatus() === 'ativo' ? 'success' : 'secondary' ?>">
                                        <?= ucfirst($dados['usuario']->getStatus()) ?>
                                    </span>
                                </div>
                                <div class="col-12 mb-3">
                                    <h5 class="text-primary">Livros Anunciados</h5>
                                    <hr>
                                    <?php if (!empty($dados['livros'])): ?>
                                        <div class="row">
                                            <?php foreach ($dados['livros'] as $livro): ?>
                                                <div class="col-md-6 mb-3">
                                                    <div class="card">
                                                        <form action="HomeController.php?" method="GET">
                                                            <input type="hidden" name="action" value="anuncio">
                                                            <input type="hidden" name="id" value="<?= htmlspecialchars($livro->getId()) ?>">
                                                        <button  class="anuncioButton" type="submit">
                                                            <img src="<?= BASEURL_ARQUIVOS . DIRECTORY_SEPARATOR . $livro->getImagemLivro() ?>" class="card-img-top" alt="<?= htmlspecialchars($livro->getNomeLivro()) ?>" style="height: 200px; object-fit: cover;">
                                                        </button>
                                                        <div class="card-body">
                                                            <h6 class="card-title"><?= htmlspecialchars($livro->getNomeLivro()) ?></h6>
                                                            <p class="card-text"><?= htmlspecialchars(substr($livro->getDescricao(), 0, 100)) ?>...</p>
                                                            <span class="badge bg-secondary"><?= htmlspecialchars($livro->getEstadoCon()) ?></span>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-muted">Nenhum livro anunciado.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>