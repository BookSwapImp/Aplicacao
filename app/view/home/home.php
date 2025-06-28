    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="<?=BASEURL_CSS?>/home.css">
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
          
            <?php foreach ($dados['listarHome'] as $a ):?>                
               <div class="book-card">
                  <?php if(empty($dado['listarHome'])):
                    echo'não á livros';    
                         endif;
                         ?>  
                    <img src="<?= $a->getImagemLivro()?>" alt="<?= $a->getNomeLivro()?>">
                    <h3><?=$a->getNomeLivro()?></h3><!-- nome -->
                    <p><?=$a->getDescricao()?></p><!--descricao-->
                    <p><?=$a->getValorAnuncio()?></p><!-- preço -->
                    <p><?=$a->getDataPublicacao()->format('d/m/Y');?></p>
                    <button class="buy-button"id='<?= $a->getId()?>'>Comprar</button>
                    <button class="trade-button"id='<?=$a->getId()?>'>Trocar</button>
                </div>
            <?php endforeach;?>

                <!-- Livro 2 -->
                <div class="book-card">
                    <img src="./assets/segredo.png" alt="S.E.G.R.E.D.O">
                    <h3>S.E.G.R.E.D.O</h3>
                    <p>L. Monroe Adeline</p>
                    <p>R$ 49,99</p>
                    <button class="buy-button">Comprar</button>
                    <button class="trade-button">Trocar</button>
                </div>
                <!-- Livro 3 -->
                <div class="book-card">
                    <img src="./assets/dom_casmurro.png" alt="Dom Casmurro">
                    <h3>Dom Casmurro</h3>
                    <p>Machado de Assis</p>
                    <p>R$ 49,99</p>
                    <button class="buy-button">Comprar</button>
                    <button class="trade-button">Trocar</button>
                </div>
                <!-- Livro 4 -->
                <div class="book-card">
                    <img src="./assets/my_broken_mariko.png" alt="My Broken Mariko">
                    <h3>My broken Mariko</h3>
                    <p>Waka Hirako</p>
                    <p>R$ 49,99</p>
                    <button class="buy-button">Comprar</button>
                    <button class="trade-button">Trocar</button>
                </div>
            </div>
            <div class="book-grid">
                <!-- Livro 1 -->
                <div class="book-card">
                    <img src="./assets/a_teoria_de_tudo.png" alt="A Teoria de Tudo">
                    <h3>A Teoria de Tudo</h3>
                    <p>Jane Hawking</p>
                    <p>R$ 49,99</p>
                    <button class="buy-button">Comprar</button>
                    <button class="trade-button">Trocar</button>
                </div>
                <!-- Livro 2 -->
                <div class="book-card">
                    <img src="./assets/segredo.png" alt="S.E.G.R.E.D.O">
                    <h3>S.E.G.R.E.D.O</h3>
                    <p>L. Monroe Adeline</p>
                    <p>R$ 49,99</p>
                    <button class="buy-button">Comprar</button>
                    <button class="trade-button">Trocar</button>
                </div>
                <!-- Livro 3 -->
                <div class="book-card">
                    <img src="./assets/dom_casmurro.png" alt="Dom Casmurro">
                    <h3>Dom Casmurro</h3>
                    <p>Machado de Assis</p>
                    <p>R$ 49,99</p>
                    <button class="buy-button">Comprar</button>
                    <button class="trade-button">Trocar</button>
                </div>
                <!-- Livro 4 -->
                <div class="book-card">
                    <img src="./assets/my_broken_mariko.png" alt="My Broken Mariko">
                    <h3>My broken Mariko</h3>
                    <p>Waka Hirako</p>
                    <p>R$ 49,99</p>
                    <button class="buy-button">Comprar</button>
                    <button class="trade-button">Trocar</button>
                </div>
            </div>
            <div class="book-grid">
                <!-- Livro 1 -->
                <div class="book-card">
                    <img src="./assets/a_teoria_de_tudo.png" alt="A Teoria de Tudo">
                    <h3>A Teoria de Tudo</h3>
                    <p>Jane Hawking</p>
                    <p>R$ 49,99</p>
                    <button class="buy-button">Comprar</button>
                    <button class="trade-button">Trocar</button>
                </div>
                <!-- Livro 2 -->
                <div class="book-card">
                    <img src="./assets/segredo.png" alt="S.E.G.R.E.D.O">
                    <h3>S.E.G.R.E.D.O</h3>
                    <p>L. Monroe Adeline</p>
                    <p>R$ 49,99</p>
                    <button class="buy-button">Comprar</button>
                    <button class="trade-button">Trocar</button>
                </div>
                <!-- Livro 3 -->
                <div class="book-card">
                    <img src="./assets/dom_casmurro.png" alt="Dom Casmurro">
                    <h3>Dom Casmurro</h3>
                    <p>Machado de Assis</p>
                    <p>R$ 49,99</p>
                    <button class="buy-button">Comprar</button>
                    <button class="trade-button">Trocar</button>
                </div>
                <!-- Livro 4 -->
                <div class="book-card">
                    <img src="./assets/my_broken_mariko.png" alt="My Broken Mariko">
                    <h3>My broken Mariko</h3>
                    <p>Waka Hirako</p>
                    <p>R$ 49,99</p>
                    <button class="buy-button">Comprar</button>
                    <button class="trade-button">Trocar</button>
                </div>
            </div>
        </section>
    </main>

<?php

require_once(__DIR__."/../include/footer.php");

?>

