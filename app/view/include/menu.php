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
                 <a class="nav-link" href="<?= HOME_PAGE ?>"><img src="<?=BASEURL_ARQUIVOS?>/bookSwapLogo7.jpeg" alt="BookSwap Logo"  class="img-fluid" style="width: 60px; height: 60px;"></a>
                <span>BookSwap</span>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Pesquisar">
                <button>Q</button>
            </div>
            <div>
                <div>                           
                <a class="nav-link dropdown-toggle" href="#" id="navbarUsuario"
                    data-bs-toggle="dropdown">
                    <?= $nome ?>
                </a>
                </div>
                <div class="dropdown-menu-->">
                    <a class="dropdown-item"
                          href="<?= BASEURL . '/controller/MeusLivrosController.php?action=view' ?>">Meus Livros</a>
                    <a class="dropdown-item" href="<?= LOGOUT_PAGE ?>">Sair da conta</a>
                </div>
            </li>
        </ul>
    </div>
        </nav>
    </header>
