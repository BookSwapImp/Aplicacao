<?php
#Nome do arquivo: perfil/perfil.php
#Objetivo: interface para perfil dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">
    Meus livros
</h3><!-- -->

<div class="container mt-4">
    <div class="text-left">
         <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-12">       
                    <a class="dropdown-item" href="<?= BASEURL . '/controller/MeusLivrosController.php?action=cadastroLivroPage' ?>">
                    <h4>+</h4>
                    </a>
            </div>
        </div>
    </div>
</div>
  <h1><!--<?=$dados['usuario']->getNome()?>--></h1>
<div class="container mt-4">
    <?php if (empty($dados['anuncios'])): ?>
        <p>Não há livros cadastrados.</p>
    <?php else: ?>
        <div class="d-flex flex-wrap gap-3">
            <?php foreach ($dados['anuncios'] as $a): ?>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" 
                         src="<?= BASEURL_ARQUIVOS."/".htmlspecialchars($a->getImagemLivro())?>" 
                         alt="<?= htmlspecialchars($a->getNomeLivro())?>">
                    <div class="card-body">
                        <h5 class="card-title"><?=htmlspecialchars($a->getNomeLivro())?></h5>
                        <p class="card-text"><?=htmlspecialchars($a->getDescricao())?></p>
                        <p class="text-muted">Anuncio Publicado: <?=$a->getDataPublicacao()->format('d/m/Y');?></p>
                        <a href="<?= BASEURL . '/controller/MeusLivrosController.php?action=deletarLivro&idLivro=' . $a->getId() ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Tem certeza que deseja deletar este livro?')">Deletar</a>
                        <a href="<?= BASEURL . '/controller/MeusLivrosController.php?action=editarLivroPage&idLivro=' . $a->getId() ?>" 
                           class="btn btn-primary btn-sm">Editar</a>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    <?php endif;?>
</div>

       


<?php  
require_once(__DIR__ . "/../include/footer.php");
?>