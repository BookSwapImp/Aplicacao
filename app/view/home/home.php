<?php
require_once(__DIR__ . "/../include/header.php");
?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
<?php
require_once(__DIR__ . "/../include/menu.php");
?>
    <main>
        <section class="featured-books">
            <div class="book-grid">
                <!-- Livro 1 -->
            <?php 
                if(empty($dados)):?> 
                    <div class="data-message">
                        <h4 class="text-muted mb-3">Aviso</h4>
                        
                        <!-- O texto principal, com ênfase e cor de texto sutil -->
                        <p class="lead text-secondary">
                            <strong>Não há Livros</strong>
                        </p>
                    </div>
                    <?php endif;
                     foreach ($dados as $a ):
                         // Home acessível para todos os usuários
                         ?>            
               <div class="book-card" style="max-width: 300px;">
                  <?php if(empty($dados)):
                    echo'não á livros';    
                         endif;
                         ?>
                    <form method="get" action="HomeController.php">
                    <div class="size">
                        <input type="hidden" name="action" value="anuncio">
                        <input type="hidden" name="id" value="<?= $a->getId()?>">
                        <button class="anuncioButton"type="submit "src="Aplicacao/app/controller/?>">       
                            <img src="<?= BASEURL_ARQUIVOS ."/". $a->getImagemLivro()?>" alt="<?= $a->getNomeLivro()?>">
                        </button>
                        <button class="anuncioButton" type="submit" style="display: left;">
                            <h3><?=$a->getNomeLivro()?></h3><!-- nome -->
                        </button>
                    </form>
                    <form method="GET" action="TrocasController.php">
                        <input type="hidden" name="action" value="trocasIntoPage">
                        <input type="hidden" name="idAnuncio" value="<?=$a->getId()?>">
                        <p><?=$a->getDescricao()?></p><!--descricao-->
                        <p>Anuncio Publicado: <?=$a->getDataPublicacao()->format('d/m/Y');?></p>
                        <button type="submit" class="trade-button" id='<?=$a->getId()?>'>Trocar</button>
                    </form>
                    </div>
                </div>
              <?php 
             endforeach;?>
        </section>
    </main>

<?php

require_once(__DIR__."/../include/footer.php");

?>

