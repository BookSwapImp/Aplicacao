<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<main>
    <div class="container">
        <h3 class="text-center mb-4">Cadastrar Novo Livro</h3>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="<?= BASEURL . '/controller/MenuController.php?action=saveLivro' ?>" enctype="multipart/form-data">
                            
                            <!-- Nome do Livro -->
                            <div class="mb-3">
                                <label for="nome_livro" class="form-label">Nome do Livro *</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nome_livro" 
                                       name="nome_livro" 
                                       placeholder="Digite o nome do livro"
                                       maxlength="55"
                                       required>
                            </div>

                            <!-- Imagem do Livro -->
                            <div class="mb-3">
                                <label for="imagem_livro" class="form-label">Imagem do Livro *</label>
                                <input type="file" 
                                       class="form-control" 
                                       id="imagem_livro" 
                                       name="imagem_livro" 
                                       accept="image/*"
                                       required>
                                <div class="form-text">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 5MB</div>
                            </div>

                            <!-- Valor do Anúncio -->
                            <div class="mb-3">
                                <label for="valor_anuncio" class="form-label">Valor do Anúncio (R$) *</label>
                                <input type="number" 
                                       class="form-control" 
                                       id="valor_anuncio" 
                                       name="valor_anuncio" 
                                       placeholder="0.00"
                                       step="0.01"
                                       min="0"
                                       required>
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
                                          required></textarea>
                            </div>

                            <!-- Estado de Conservação -->
                            <div class="mb-3">
                                <label for="estado_con" class="form-label">Estado de Conservação *</label>
                                <select class="form-select" id="estado_con" name="estado_con" required>
                                    <option value="">Selecione o estado</option>
                                    <option value="mal">Mal</option>
                                    <option value="medio">Médio</option>
                                    <option value="bom">Bom</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>

                            <!-- Botões -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= BASEURL . '/controller/MenuController.php?action=meusLivrosPage' ?>" 
                                   class="btn btn-secondary me-md-2">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar Livro
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
require_once(__DIR__ . "/../include/footer.php");
?>