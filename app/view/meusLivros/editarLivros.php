<?php
include_once(__DIR__ . "/../include/header.php");
include_once(__DIR__ . "/../include/menu.php");
?>

<main>
    <div class="container">
        <h3 class="text-center mb-4">Editar Livro</h3>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="<?= BASEURL . '/controller/MeusLivrosController.php?action=editarLivro' ?>" enctype="multipart/form-data">
                            <!-- Campo oculto para o ID do livro -->
                            <input type="hidden" name="id_livro" value="<?= isset( $dados['idLivro']) ? $dados['idLivro'] : '' ?>">
                            
                            <!-- Nome do Livro -->
                            <div class="mb-3">
                                <label for="nome_livro" class="form-label">Nome do Livro *</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nome_livro" 
                                       name="nome_livro" 
                                       placeholder="Digite o nome do livro"
                                       maxlength="55"
                                       value="<?= isset($dados['nomeLivro']) ? htmlspecialchars($dados['nomeLivro']) : '' ?>"
                                       required>
                            </div>

                            <!-- Imagem do Livro -->
                            <div class="mb-3">
                                <label for="imagem_livro" class="form-label">Imagem do Livro</label>
                                <?php if(isset($dados['imagemLivro']) && $dados['imagemLivro']): ?>
                                <div class="mb-2">
                                    <img src="<?= BASEURL_ARQUIVOS . DIRECTORY_SEPARATOR . $dados['imagemLivro'] ?>" 
                                         alt="Imagem atual do livro" 
                                         class="img-thumbnail" 
                                         style="max-height: 150px;">
                                    <p class="form-text">Imagem atual: <?= BASEURL_ARQUIVOS.DIRECTORY_SEPARATOR.$dados['imagemLivro'] ?></p>
                                </div>
                                <?php endif; ?>
                                <input type="file" 
                                       class="form-control" 
                                       id="imagem_livro" 
                                       name="imagem_livro" 
                                       accept="image/*">
                                <div class="form-text">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 5MB. Deixe em branco para manter a imagem atual.</div>
                            </div>



                            <!-- Descrição -->
                             <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição *</label>
                                <textarea class="form-control" 
                                          id="descricao" 
                                          name="descricao" 
                                          rows="4"
                                          placeholder="Descreva o livro, autor, edição, etc."
                                          maxlength="45"
                                          required><?= isset($dados['descricao']) ? htmlspecialchars($dados['descricao']) : '' ?></textarea>
                            </div>

                            <!-- Estado de Conservação -->
                            <div class="mb-3">
                                <label for="estado_con" class="form-label">Estado de Conservação *</label>
                                <select class="form-select" id="estado_con" name="estado_con" required>
                                    <option value="">Selecione o estado</option>
                                            <option value="mal" <?= (isset($dados['estadoCon']) && $dados['estadoCon'] == 'mal') ? 'selected' : '' ?>>Mal</option>
                                    <option value="medio" <?= (isset($dados['estadoCon']) && $dados['estadoCon'] == 'medio') ? 'selected' : '' ?>>Médio</option>
                                    <option value="bom" <?= (isset($dados['estadoCon']) && $dados['estadoCon'] == 'bom') ? 'selected' : '' ?>>Bom</option>
                        </select>
                            </div>

                            <!-- Status - Hidden field always set to 'ativo' -->
                            <input type="hidden" name="status" value="ativo">

                            <!-- Botões -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= BASEURL . '/controller/MeusLivrosController.php?action=meusLivrosPage' ?>" 
                                   class="btn btn-secondary me-md-2">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Salvar Alterações
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
include_once(__DIR__."/../include/footer.php");
?>