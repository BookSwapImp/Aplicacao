<?php
#Nome do arquivo: perfil/perfil.php
#Objetivo: interface para perfil dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">
    Perfil
</h3><!-- -->

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
                    <img src="<?= BASEURL_ARQUIVOS . '/basePfp.jpeg'?>"
                    height="300">
            <?php 
             /*<?php if($dados['usuario']->getFotoDePerfil()): ?>
                   <img src="<?= BASEURL_ARQUIVOS .  $dados['usuario']->getFotoDePerfil() ?>"
                    height="300">
            <?php else:?>
                    <img src="<?= BASEURL_ARQUIVOS . '/basePfp.jpeg'?>"
                    height="300"*/?>
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
                                                                <!-- 
                <input type="hidden" name="fotoAnterior" value="<?php // $dados['usuario']->getFotoDePerfil() ?>"  > -->
                
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
                <button class="btn btn-secondary">
                    <a href="<?=BASEURL?>/controller/MeusLivrosController.php?action=cadastroLivroPage">Cadastrar seus livros</a>
                </button>
            </div>
        </div>
</div>
  <h1><!--<?=$dados['usuario']->getid()?>--></h1>
   
                    <?php if (empty($dados['livros'])): ?>
                    <p>Não há livros cadastrados.</p>
                    <?php else: ?>
                    <?php foreach ($dados['livros'] as $a): ?>
        
                    <div>
                    <img src="<?= $a->getImagemLivro()?>" alt="<?= $a->getNomeLivro()?>" style="    max-width: 300px;
                    height: auto;
                    margin-bottom: 10px;">
                    <h3><?=$a->getNomeLivro()?></h3><!-- nome -->
                    <p><?=$a->getDescricao()?></p><!--descricao-->
                    <p>Preço:R$<?=$a->getValorAnuncio()?></p><!-- preço -->
                    <p>Anuncio Publicado: <?=$a->getDataPublicacao()->format('d/m/Y');?></p>
                    </div>
                   
            <?php endforeach;?>
            <?php endif;?>
       


<?php  
require_once(__DIR__ . "/../include/footer.php");
?>