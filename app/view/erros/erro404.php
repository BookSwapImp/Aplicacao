<?php 
include_once(__DIR__."/../include/header.php");
include_once(__DIR__."/../include/menu.php");
?><body>
    <div class="cointainer">
        <div class="row justify-content-center align-items-center" style="height: 80vh;">
            <div class="col-md-6 text-center">
                <h1 class="display-1 text-black">404</h1>
                <h2 class="mb-4">Página Não Encontrada</h2>
                <p class="lead mb-4">Desculpe, a página que você está procurando não existe.</p>
                <a href="<?= BASEURL ?>" class="btn btn-primary">
                    <i class="fas fa-home me-2" data-src="controller/MeusLivrosController.php?action=home">Voltar para a Página Inicial</i>
                </a>
            </div>
        </div>    
    </div>
</body>
</html>