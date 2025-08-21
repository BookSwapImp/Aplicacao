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
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Editar Perfil
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= BASEURL . '/controller/PerfilController.php?action=atualizarPerfil' ?>" enctype="multipart/form-data">
                        
                        <!-- Foto do Perfil -->
                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                <div class="position-relative">
                                    <img src="<?= !empty($dados['usuario']->getFotoDePerfil()) ? BASEURL_ARQUIVOS . '/' . $dados['usuario']->getFotoDePerfil() : BASEURL_ARQUIVOS . '/basePfp.jpeg' ?>" 
                                         alt="Foto de Perfil" 
                                         class="rounded-circle img-thumbnail mb-3" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                    <input type="file" 
                                           class="form-control" 
                                           name="foto_perfil" 
                                           accept="image/*">
                                    <small class="form-text text-muted">Formatos: JPG, PNG, GIF. Máx: 5MB (opcional - deixe em branco para manter foto atual)</small>
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <h5 class="text-primary">Informações Pessoais</h5>
                                <hr>
                            </div>
                        </div>

                        <!-- Nome -->
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome *</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="nome" 
                                   name="nome" 
                                   value="<?= htmlspecialchars($dados['usuario']->getNome()) ?>"
                                   maxlength="45"
                                   required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail *</label>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   value="<?= htmlspecialchars($dados['usuario']->getEmail()) ?>"
                                   maxlength="255"
                                   required>
                        </div>

                        <!-- CPF -->
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF *</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="cpf" 
                                   name="cpf" 
                                   value="<?= htmlspecialchars($dados['usuario']->getCpf()) ?>"
                                   maxlength="14"
                                   required>
                        </div>

                        <!-- Telefone -->
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="telefone" 
                                   name="telefone" 
                                   value="<?= htmlspecialchars($dados['usuario']->getTelefone()) ?>"
                                   maxlength="15"
                                   placeholder="(00) 00000-0000">
                        </div>

                        <!-- Botões -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= BASEURL . '/controller/PerfilController.php?action=perfilPage' ?>" 
                               class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>