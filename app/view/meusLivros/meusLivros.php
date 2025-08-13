<?php
#Nome do arquivo: perfil/perfil.php
#Objetivo: interface para perfil dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">
    Meus livros
</h3><!-- -->

<div class="container">
    <div class="text-left">
         <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-12">       
                    <a class="dropdown-item" href="<?= BASEURL . '/controller/MenuController.php?action=cadastroLivroPage' ?>">
                    <h4>+</h4>
                    </a>
            </div>
        </div>
    </div>
</div>
  <h1><!--<?=$dados['usuario']->getNome()?>--></h1>
<div class="container">          
    <?php if (empty($dados['anuncios'])): ?>
           
                    <p>Não há livros cadastrados.</p>
    <?php else: ?>
        <?php foreach ($dados['anuncios'] as $a): ?>
            <div class="book-card" style="max-width: 300px;">
                    <img src="<?= htmlspecialchars($a->getImagemLivro())?>" alt="<?= htmlspecialchars($a->getNomeLivro())?>" style="    max-width: 300px;
                    height: auto;
                    margin-bottom: 10px;">
                    <h3><?=htmlspecialchars($a->getNomeLivro())?></h3><!-- nome -->
                    <p><?=htmlspecialchars($a->getDescricao())?></p><!--descricao-->
                    <p>R$<?=number_format($a->getValorAnuncio(),2,',','.')?></p><!-- preço/ -->
                    <p>Anuncio Publicado: <?=$a->getDataPublicacao()->format('d/m/Y');?></p>
                    <button class="btn btn-danger"> Deletar</button> <button class="btn btn-primary">Editar</button>
            </div>
        <?php endforeach;?>
    <?php endif;?>
 </div>   
       


<?php  
require_once(__DIR__ . "/../include/footer.php");
?>