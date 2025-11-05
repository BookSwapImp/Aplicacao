<?php 

 include_once(__DIR__ . "/../include/header.php");

 include_once(__DIR__."/../include/menu.php");

 include_once(__DIR__."/../include/msg.php");
?>
<div class="container">
    <div class="anuncio-oferta">
        <div class="anuncio-oferta img">
            <img src="<?= BASEURL_ARQUIVOS.'/'.$dados['AnuncioOferta']->getImagemLivro();?>" alt="">
        </div>
        <label>
        <?= $dados['AnuncioOferta']->getNomeLivro();?>
        </label>
    </div>
    <div class="select-anuncios-solicitador">
        <form action="TrocasController.php?action=trocaInto" method="POST">
         <select name="idAnSolicitador" id="idAnSolicitador">
             <?php foreach($dados['AnunciosSolicitador'] as $ans):?>
                <option value="<?= $ans->getId();?>"><?= $ans->getNomeLivro();?></option>        
             <?php endforeach;?>
         </select>
            <input type="hidden" name="idAnOferta" id="idAnOferta" value="<?=$dados['AnuncioOferta']->getId();?>">
            <button class="btn btn-primary" type="submit">confirmar</button>
            <button class="btn btn-danger">cancelar</button>
        </form>
    </div>
</div><br>
<?php
require_once(__DIR__ . "/../include/footer.php");
?>