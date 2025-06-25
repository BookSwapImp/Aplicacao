<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

$nome = "(Sessão expirada)";
if (isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];

?>
    <header>
        <nav>
            <div class="logo">
                <img src="<?=BASEURL_ARQUIVOS?>/bookSwapLogo7.jpeg" alt="BookSwap Logo">
                <span>BookSwap</span>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Pesquisar">
                <button>Q</button>
            </div>
            <div class="user-menu">
                <button>Meus livros</button>
                <img src="<?= BASEURL_ARQUIVOS ?>/user_icon.png" alt="User Icon">
            </div>
        </nav>
    </header>
