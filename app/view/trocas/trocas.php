<?php

 include_once(__DIR__ . "/../include/header.php");

 include_once(__DIR__."/../include/menu.php")  
?>
<script>
function showSecCode(cod) {
    alert("Código de segurança: " + cod);
}
</script>
<div class="countainer">
    <div class="book-grid">
     <?php if(empty($dados)): echo'<h2 style="text-aling: center;">Não a trocas</h2>';
      else: foreach($dados['solicitacao'] as $sol):?>
        <div class="book-card">
            <h6>Solicitadas</h6>
            <div class="">
                <img src="<?=BASEURL_ARQUIVOS.DIRECTORY_SEPARATOR.$sol['anuncio']->getImagemLivro();?>" alt="<?=$sol['anuncio']->getNomeLivro();?>"><br>
            </div>
            <h3><?=$sol['anuncio']->getNomeLivro()?></h3><br>
            <p>user name</p><br>
            <?php if($sol['anuncio']->getStatusTroca() === true): ?>
               <strong><p>Codigo segurança: <?=$sol['secCode']?></p></strong>
        <?php else: ?>
            <strong><p>Não ativa, aguarde o outro usuário</p></strong>
            <?php endif; ?>
         </div>
         <?php endforeach;
            foreach ($dados['ofertas'] as $of):?>
            <div class="book-card">
                <h6>ofertas</h6>
                <img src="<?=BASEURL_ARQUIVOS.DIRECTORY_SEPARATOR.$of['anuncio']->getImagemLivro()?>"alt="<?=$of['anuncio']->getNomeLivro()?>">
                <h3><?=$of['anuncio']->getNomeLivro()?></h3>
                <p>user name</p>
                <p>Troca Iniciada: </p>
                <?php if($of['anuncio']->getStatusTroca() === true):?>
                 <form method="POST" action="?action=inputCodeSec">
                   <input type="hidden" name="idTroca" value="<?=$of['trocaId']?>">
                   <input name="codeSec"id="codeSec">
                    <button class="btn btn-primary" type="submit">comfir</button>
                 </form>
                <?php else:?>
                    <form method="POST" action="?action=trocasActive">
                        <input type="hidden" name="idTroca" value="<?=$of['trocaId']?>">
                        <button class="btn btn-primary" type="submit">ativar Troca</button>
                    </form>
                <?php endif;?>
            </div>
            <?php endforeach;?>
        <?php endif;?>  
    </div>
</div>
<?php

 include_once(__DIR__ . "/../include/footer.php");   
?>