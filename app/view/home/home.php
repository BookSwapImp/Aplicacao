<?php

$html_content = <<<HTML
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookSwap - Livros em Destaque</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

header {
    background-color: #fff;
    padding: 10px 20px;
    border-bottom: 1px solid #ddd;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

nav .logo {
    display: flex;
    align-items: center;
}

nav .logo img {
    height: 30px;
    margin-right: 10px;
}

nav .search-bar {
    display: flex;
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
}

nav .search-bar input {
    border: none;
    padding: 8px;
    outline: none;
}

nav .search-bar button {
    background-color: #eee;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
}

nav .user-menu {
    display: flex;
    align-items: center;
}

nav .user-menu img {
    height: 25px;
    margin-left: 10px;
}

.hero-section {
    background-color: #e0e0e0;
    text-align: center;
    padding: 50px 20px;
    margin-bottom: 20px;
}

.hero-section img {
    height: 100px;
    margin-bottom: 10px;
}

.hero-section span {
    display: block;
    font-size: 2em;
    font-weight: bold;
    color: #333;
}

.featured-books {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.featured-books h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

.book-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.book-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.book-card img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.book-card h3 {
    font-size: 1.2em;
    margin-bottom: 5px;
    color: #333;
}

.book-card p {
    font-size: 0.9em;
    color: #666;
    margin-bottom: 10px;
}

.book-card .buy-button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 5px;
    width: 100%;
}

.book-card .trade-button {
    background-color: #6c757d;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

footer {
    background-color: #fff;
    padding: 20px;
    border-top: 1px solid #ddd;
    text-align: center;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.footer-content .logo {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.footer-content .logo img {
    height: 30px;
    margin-right: 10px;
}

.footer-content p {
    font-size: 0.9em;
    color: #666;
}
    </style>
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

