<?php
#Nome do arquivo: login/login.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/headerMenuLoginCasdatro.php");
?>
                <!-- Formulário de login -->
                <!--Problemas: A url do formulario não esta correta 
                  -->
        <h2 class="mb-4 text-center">Acessar</h2>
            <form id="frmLogin" action="<?=BASEURL?>/controller/LoginController.php?action=logon" method="POST" >
                <div class="mb-3">
                     <label for="txtEmail" class="form-label">Email:</label>
                    <?php if(isset($msgErro) and (trim($msgErro) != "") or $msgErro ==['O campo [Email] é obrigatório.'] or $msgErro==['O campo [Email] está em formato inválido.']): ?>
                        <input type="text" name="email" id="txtEmail" class="form-control is-invalid" placeholder="Informe o Email" maxlength="50" value="<?= $dados['email'] ?? '' ?>">                 
                    <?php else:?>
                    <input type="text" name="email" id="txtEmail" class="form-control" placeholder="Informe o Email" maxlength="50" value="<?= $dados['email'] ?? '' ?>">
                     <?php endif;?>
                </div>
                <div class="mb-3">
                    <label for="txtSenha" class="form-label">Senha:</label>
                    <?php if(isset($msgErro) and (trim($msgErro) != "") or $msgErro ==['O campo [Senha] é obrigatório.']): ?>
                    <input type="password" name="senha" id="txtSenha" class="form-control is-invalid" placeholder="Informe a senha" value="<?= $dados['senha'] ?? '' ?>">
                    <?php else:?>
                    <input type="password" name="senha" id="txtSenha" class="form-control" placeholder="Informe a senha" value="">
                    <?php endif;?>
                    <div class="col-6">
                        <?php include_once(__DIR__ . "/../include/msg.php") ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100">Logar</button>
            </form>
            <div class="text-center mt-3">
                <a href="<?=CADASTRO_PAGE?>">Cadastre-se</a>
            </div>
        </div>
    </div>
    </div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
