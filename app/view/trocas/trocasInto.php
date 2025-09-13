<?php 
require_once(__DIR__ . "/../include/header.php");
?>
<div class="container">
    <div class="img-anuncio-oferta">
        <label><?php print_r ($dados['AnuncioOferta']);?></label>
    </div>
    <div class="select-anucnios-solicitador">
        <?php foreach($dados['AnunciosSolicitador'] as $ans):?>
            <label><?php // echo $ans->getNome();?></label>
        <?php endforeach;?>
        <button class="btn btn-primary">cuuu</button>
        <button class="btn btn-alert">cuu3</button>
    </div>
</div>
<?php
require_once(__DIR__ . "/../include/footer.php");
?>