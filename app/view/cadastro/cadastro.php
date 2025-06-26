<?php
#Nome do arquivo: cadatro/cadastro.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/header.php");
?>

<div class="container">
    <div class="row" style="margin-top: 20px;">
        <div class="col-6">
            <div class="alert alert-info">
                <h4>Informe os dados para Cadastro</h4>
                <br>

                <!-- Formulário de cadastro -->
                <form id="frmLogin" action="?action=cadastrar" method="POST" >
                     <div class="mb-3">
                        <label class="form-label" for="txtNome">Nome Completo:</label>
                        <input type="text" class="form-control" name="nome" id="txtNome"
                            maxlength="" placeholder="Informe o seu nome"
                            value="<?php echo isset($dados['nome']) ? $dados['nome'] : '' ?>" />        
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="txtEmail">Email:</label>
                        <input type="text" class="form-control" name="email" id="txtEmail"
                            maxlength="" placeholder="Informe o email"
                            value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>" />        
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="txtSenha">Senha:</label>
                        <input type="password" class="form-control" name="senha" id="txtSenha"
                            maxlength="15" placeholder="Informe a senha"
                            value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />        
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="txtConfSenha">Confirme sua senha:</label>
                        <input type="password" class="form-control" name="confSenha" id="txtConfSenha"
                            maxlength="15" placeholder="Confirme sua senha"
                            value="<?php echo isset($dados['confSenha']) ? $dados['confSenha'] : '' ?>" />        
                    </div>

                    
                    <div class="mb-3">
                            <label for="form-label" for="intTeledone">telefone: </label>
                            <input type="number" class="form-control" name="telefone" id="intTelefone"
                            maxlength="15" placeholder="Informe o telefone"
                            value="<?php echo isset($dados['telefone']) ? $dados['telefone'] : '' ?>"/>     
                    </div>


                    <div class="mb-3">
                            <label for="form-label" for="cpf">CPF: </label>
                            <input type="number" class="form-control" name="cpf" id="cpf"
                            maxlength="14" placeholder="Informe o CPF"
                            value="<?php echo isset($dados['cpf']) ? $dados['cpf'] : '' ?>"/>     
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Finalizar</button>
                </form>
            </div>
            
             <div>
                <a href="LoginController.php?action=login">logar</a>
            </div>
        </div>

        <div class="col-6">
    <?php include_once(__DIR__ . "/../include/msg.php") ?> <!-- ok -->
</div>


<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
