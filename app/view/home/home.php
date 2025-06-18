<?php

$html_content = <<<HTML
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookSwap - Livros em Destaque</title>
<link rel="stylesheet" href="../css/home.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="./assets/bookswap_logo.png" alt="BookSwap Logo">
                <span>BookSwap</span>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Pesquisar">
                <button>Q</button>
            </div>
            <div class="user-menu">
                <span>Meus livros</span>
                <img src="./assets/user_icon.png" alt="User Icon">
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <img src="./assets/bookswap_logo.png" alt="BookSwap Logo Grande">
            <span>BookSwap</span>
        </section>

        <section class="featured-books">
            <h2>LIVROS EM DESTAQUE</h2>
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

    <footer>
        <div class="footer-content">
            <div class="logo">
                <img src="./assets/bookswap_logo.png" alt="BookSwap Logo">
                <span>BookSwap</span>
            </div>
            <p>O Bookswap é um projeto que tem como objetivo incentivar a leitura e reduzir o impacto ambiental por meio da troca de livros.</p>
        </div>
    </footer>
</body>
</html>
HTML;

echo $html_content;

?>

