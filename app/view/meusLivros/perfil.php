<?php
#Nome do arquivo: perfil/perfil.php
#Objetivo: interface para perfil dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">
    Perfil
</h3>

<div class="container">

    <div class="row mt-2">
        <h3 class="row mt-5">Seus Dados: </h3>
        <div class="col-12 mb-2">
            <span class="fw-bold">Nome:</span>
            <span><?= $dados['usuario']->getNome() ?></span>
        </div>

        <div class="col-12 mb-2">
            <span class="fw-bold">Login:</span>
            <span><?= $dados['usuario']->getEmail() ?></span>
        </div>

        <div class="col-12 mb-2">
            <span class="fw-bold">Papel:</span>
            <span><?= $dados['usuario']->getTipo() ?></span>
        </div>

        <div class="col-12 mb-2">
            <span class="fw-bold">Status:</span>
            <span><?= $dados['usuario']->getStatus() ?></span>
        </div>

        <div class="col-12 mb-2">
            <div class="fw-bold">Foto:</div>
            <?php //if($dados['usuario']->getFotoPerfil()): ?>
                <img src="<?= BASEURL_ARQUIVOS . '/basePfp.jpeg' //.  $dados['usuario']->getFotoPerfil() ?>"
                    height="300">
            <?php //endif; ?>
        </div>

    </div>
    
    <div class="row mt-5">
        
        <div class="col-6">
            <form id="frmUsuario" method="POST" 
                action="<?= BASEURL ?>/controller/PerfilController.php?action=save"
                enctype="multipart/form-data" >
                <div class="mb-3">
                    <label class="form-label" for="txtFoto">Foto de perfil: </label>
                    <input class="form-control" type="file" 
                        id="txtFoto" name="foto" />
                </div>

                <input type="hidden" name="fotoAnterior" value="<?= $dados['usuario']->getFotoPerfil() ?>">
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Gravar</button>
                </div>
            </form>            
        </div>

        <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-12">
        <a class="btn btn-secondary" 
                href="<?= BASEURL ?>/controller/UsuarioController.php?action=list">Voltar</a>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>