<?php
require_once(__DIR__ . "/../include/header.php");
?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
<?php
require_once(__DIR__ . "/../include/menu.php");
?>
    <main>
        <section class="hero-section">
            <img src="<?=BASEURL_ARQUIVOS?>/bookSwapLogo7.jpeg" alt="BookSwap Logo Grande">
            <span>BookSwap</span>
        </section>

        <section class="featured-books">
            <h2>LIVROS EM DESTAQUE</h2>
            <div class="book-grid">
                <!-- Livro 1 -->
          
            <?php foreach ($dados as $a ):?>                
               <div class="book-card" style="max-width: 300px;">
                  <?php if(empty($dados)):
                    echo'não á livros';    
                         endif;
                         ?>
                    <form method="get" action="anuncio" >
                    <div class="size">
                        <button class="anuncioButton"type="submit" id="<?= $a->getId()?>">       
                            <img src="<?= $a->getImagemLivro()?>" alt="<?= $a->getNomeLivro()?>">
                        </button>
                        <button class="anuncioButton"type="submit" id="<?= $a->getId()?>">
                            <h3><?=$a->getNomeLivro()?></h3><!-- nome -->
                        </button>
                    </form>
                    <p><?=$a->getDescricao()?></p><!--descricao-->
                    <p>Preço:R$<?=$a->getValorAnuncio()?></p><!-- preço -->
                    <p>Anuncio Publicado: <?=$a->getDataPublicacao()->format('d/m/Y');?></p>
                    <button class="buy-button"id='<?= $a->getId()?>'>Comprar</button>
                    <button class="trade-button"id='<?=$a->getId()?>'>Trocar</button>
                    </form>    
                    </div>
                </div>
            <?php endforeach;?>
        </section>
    </main>

<?php

require_once(__DIR__."/../include/footer.php");

?>

