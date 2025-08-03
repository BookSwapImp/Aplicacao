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
                            <i class="fas fa-user me-2"></i>Perfil do Usuário
                        </h4>
                        <a href="<?= BASEURL . '/controller/MeusLivrosController.php?action=editarPerfilPage' ?>" 
                           class="btn btn-light btn-sm">
                            <i class="fas fa-edit me-1"></i>Editar Perfil
                        </a>
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
                                    <label class="form-label fw-bold text-muted">E-mail:</label>
                                    <p class="form-control-plaintext"><?= htmlspecialchars($dados['usuario']->getEmail()) ?></p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-muted">CPF:</label>
                                    <p class="form-control-plaintext"><?= htmlspecialchars($dados['usuario']->getCpf()) ?></p>
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
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Botões de Ação -->
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="<?= BASEURL . '/controller/MeusLivrosController.php?action=meusLivrosPage' ?>" 
                           class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Voltar
                        </a>
                        <a href="<?= BASEURL . '/controller/MeusLivrosController.php?action=editarPerfilPage' ?>" 
                           class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i>Editar Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>