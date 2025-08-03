<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<main>
    <div class="container">
        <h3 class="text-center mb-4">
            <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?> Usuário
        </h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form id="frmUsuario" method="POST" action="<?= BASEURL ?>/controller/UsuarioController.php?action=save">
                            <!-- Nome -->
                            <div class="mb-3">
                                <label class="form-label" for="txtNome">Nome *</label>
                                <input class="form-control"
                                       type="text"
                                       id="txtNome"
                                       name="nome"
                                       maxlength="70"
                                       placeholder="Informe o nome"
                                       value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNome() : ''); ?>"
                                       required />
                            </div>
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label" for="txtLogin">E-mail *</label>
                                <input class="form-control"
                                       type="email"
                                       id="txtLogin"
                                       name="login"
                                       maxlength="255"
                                       placeholder="Informe o e-mail"
                                       value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : ''); ?>"
                                       required />
                            </div>
                            <!-- Senha -->
                            <div class="mb-3">
                                <label class="form-label" for="txtPassword">Senha *</label>
                                <input class="form-control"
                                       type="password"
                                       id="txtPassword"
                                       name="senha"
                                       maxlength="255"
                                       placeholder="Informe a senha"
                                       required />
                            </div>
                            <!-- Confirmação de Senha -->
                            <div class="mb-3">
                                <label class="form-label" for="txtConfSenha">Confirmação da senha *</label>
                                <input class="form-control"
                                       type="password"
                                       id="txtConfSenha"
                                       name="conf_senha"
                                       maxlength="255"
                                       placeholder="Confirme a senha"
                                       required />
                            </div>
                            <!-- Papel -->
                            <div class="mb-3">
                                <label class="form-label" for="selPapel">Papel *</label>
                                <select class="form-select" name="papel" id="selPapel" required>
                                    <option value="">Selecione o papel</option>
                                    <?php foreach($dados["papeis"] as $papel): ?>
                                        <option value="<?= $papel ?>"
                                            <?php if(isset($dados["usuario"]) && $dados["usuario"]->getPapel() == $papel) echo "selected"; ?>>
                                            <?= $papel ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="hidden" id="hddId" name="id" value="<?= $dados['id']; ?>" />
                            <!-- Botões -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= BASEURL ?>/controller/UsuarioController.php?action=list" class="btn btn-secondary me-md-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Gravar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-3">
                    <?php require_once(__DIR__ . "/../include/msg.php"); ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php  
require_once(__DIR__ . "/../include/footer.php");
?>