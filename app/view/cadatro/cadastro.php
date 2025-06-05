<?php
#Nome do arquivo: cadatro/cadastro.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/header.php");
?>

<div class="container">
    <div class="row" style="margin-top: 20px;">
        <div class="col-6">
            <div class="alert alert-info">
                <h4>Informe os dados para logar:</h4>
                <br>

                <!-- Formulário de cadastro -->
                <form id="frmLogin" action="./LoginController.php?action=cadastrar" method="POST" >
                    <div class="mb-3">
                        <label class="form-label" for="txtEmail">Email:</label>
                        <input type="text" class="form-control" name="email" id="txtEmail"
                            maxlength="15" placeholder="Informe o email"
                            value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>" />        
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="txtSenha">Senha:</label>
                        <input type="password" class="form-control" name="senha" id="txtSenha"
                            maxlength="15" placeholder="Informe a senha"
                            value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />        
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="txtConf_senha">Senha:</label>
                        <input type="password" class="form-control" name="conf_senha" id="txtConf_senha"
                            maxlength="15" placeholder="Confirmar sua senha"
                            value="<?php echo isset($dados['conf_senha']) ? $dados['conf_senha'] : '' ?>" />        
                    </div>

                    
                    <div class="mb-3">
                            <label for="form-label" for="intTeledone">telefone: </label>
                            <input type="number" class="form-control" name="telefone" id="intTelefone"
                            maxlength="15" placeholder="Informe o CPF"
                            value="<?php echo isset($dados['cpf']) ? $dados['cpf'] : '' ?>"/>     
                    </div>


                    <div class="mb-3">
                            <label for="form-label" for="cpf">CPF: </label>
                            <input type="number" class="form-control" name="cpf" id="cpf"
                            maxlength="15" placeholder="Informe o CPF"
                            value="<?php echo isset($dados['cpf']) ? $dados['cpf'] : '' ?>"/>     
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Finalizar</button>
                </form>
            </div>
        </div>

        <div class="col-6">
            <?php include_once(__DIR__ . "/../include/msg.php") ?>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
