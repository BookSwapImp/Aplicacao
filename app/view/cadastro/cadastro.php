
<?php
#Nome do arquivo: cadastro/cadastro.php
#Objetivo: interface para cadastro no sistema

require_once(__DIR__ . "/../include/headerMenuLoginCasdatro.php");
?>
             <h2 class="mb-4 text-center">Cadastro</h2>
              <p class="text-muted">Todos que tiverem '*' são obrigatorios
              </p>
                    <form id="frmCadastro" action="<?=BASEURL?>/controller/CadastroController.php?action=cadastrar" method="POST">
                   
                        <div class="mb-3">
                            <label for="txtNome" class="form-label">*Nome Completo:</label>
                           
                            <input type="text" name="nome" id="txtNome" class="form-control" placeholder="Informe o seu nome" value="<?= $dados['nome'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="txtEmail" class="form-label">*Email:</label>
                            <input type="text" name="email" id="txtEmail" class="form-control" placeholder="Informe o email" value="<?= $dados['email'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="txtSenha" class="form-label">*Senha:</label>
                            <input type="password" name="senha" id="txtSenha" class="form-control" placeholder="Informe a senha" value="<?= $dados['senha'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="txtConfSenha" class="form-label">*Confirme sua senha:</label>
                            <input type="password" name="confSenha" id="txtConfSenha" class="form-control" placeholder="Confirme sua senha" value="<?= $dados['confSenha'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="intTelefone" class="form-label">*Telefone: </label><p class="text-muted">sem pontos e sem caracteres especiais</p>
                            <input type="tel" name="telefone" id="intTelefone" class="form-control" placeholder="Informe o telefone" value="<?= $dados['telefone'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="cpf" class="form-label">*CPF: </label><p class="text-muted">sem pontos e sem caracteres especiais</p>
                            <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Informe o CPF" formaction='000.000.000-00'value="<?= $dados['cpf'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <?php include_once(__DIR__ . "/../include/msg.php") ?> 
                        </div>
                        <button type="submit" class="btn btn-success w-100">Finalizar</button>
                        <div class="text-center mt-3">
                            <a href="<?=LOGIN_PAGE?>">Já tem conta? Faça login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>

