<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

$nome = "(Sessão expirada)";
if (isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="<?= HOME_PAGE ?>">
                <img src="<?= BASEURL_ARQUIVOS ?>/bookSwapLogo7.jpeg" alt="BookSwap Logo" style="width: 40px; height: 40px;" class="me-2">
                <span class="fw-bold">BookSwap</span>
            </a>

            <!-- Botao responsivo -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPrincipal" aria-controls="navbarPrincipal" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Conteúdo do menu -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarPrincipal">
                
                <!-- Barra de pesquisa -->
                <form class="d-flex mx-auto" role="search">
                    <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                    <button class="btn btn-outline-secondary" type="submit">🔍</button>
                </form>

                <!-- Menu do usuário -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarUsuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $nome ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUsuario">
                            <li>
                                <a class="dropdown-item" href="<?= BASEURL . '/controller/MeusLivrosController.php?action=perfilPage' ?>">Perfil</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= BASEURL . '/controller/MeusLivrosController.php?action=meusLivrosPage' ?>">Meus Livros</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="<?= LOGOUT_PAGE ?>">Sair da conta</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

