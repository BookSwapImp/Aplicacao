<?php 
require_once(__DIR__ . "/../include/header.php");
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
        <form action="trocaInto" method="POST">
         <select name="idAnSolicitador" id="idAnSolicitador">
             <?php foreach($dados['AnunciosSolicitador'] as $ans):?>
                <option value="<?= $ans->getId();?>"><?= $ans->getNomeLivro();?></option>        
             <?php endforeach;?>
         </select>
            <input value="<?=$dados['AnuncioOferta']->getid();?>"style='hidden'>
            <button class="btn btn-primary" type="submit">confirmar</button>
            <button class="btn btn-danger">cancelar</button>
        </form>
    </div>
</div><br>
<?php
require_once(__DIR__ . "/../include/footer.php");
?>