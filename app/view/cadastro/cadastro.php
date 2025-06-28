
<?php
#Nome do arquivo: cadatro/cadastro.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/headerMenuLoginCasdatro.php");
?>
             <h2 class="mb-4 text-center">Cadastro</h2>
                    <form id="frmCadastro" action="<?=BASEURL?>/controller/CadastroController.php?action=cadastrar" method="POST">
                        <div class="mb-3">
                            <label for="txtNome" class="form-label">Nome Completo:</label>
                            <input type="text" name="nome" id="txtNome" class="form-control" placeholder="Informe o seu nome" value="<?= $dados['nome'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="txtEmail" class="form-label">Email:</label>
                            <input type="text" name="email" id="txtEmail" class="form-control" placeholder="Informe o email" value="<?= $dados['email'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="txtSenha" class="form-label">Senha:</label>
                            <input type="password" name="senha" id="txtSenha" class="form-control" placeholder="Informe a senha">
                        </div>
                        <div class="mb-3">
                            <label for="txtConfSenha" class="form-label">Confirme sua senha:</label>
                            <input type="password" name="confSenha" id="txtConfSenha" class="form-control" placeholder="Confirme sua senha">
                        </div>
                        <div class="mb-3">
                            <label for="intTelefone" class="form-label">Telefone:</label>
                            <input type="tel" name="telefone" id="intTelefone" class="form-control" placeholder="Informe o telefone" value="<?= $dados['telefone'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF:</label>
                            <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Informe o CPF" value="<?= $dados['cpf'] ?? '' ?>">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Finalizar</button>
                    </form>
                    </div>
                    <div class="text-center mt-3">
                        <a href="<?=LOGIN_PAGE?>">Já tem conta? Faça login</a>
                    </div>
        <div class="col-6">
    <?php include_once(__DIR__ . "/../include/msg.php") ?> <!-- ok -->
</div>


<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
