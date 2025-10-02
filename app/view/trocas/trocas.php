<?php

 include_once(__DIR__ . "/../include/header.php");

 include_once(__DIR__."/../include/menu.php")  
?>

<div class="countainer">
    <div class="book-grid">
     <?php if(empty($dados)): echo'<h2 style="text-aling: center;">Não a trocas</h2>'; 
      else: foreach($dados['solicitacao'] as $sol):?>     
        <div class="book-card">
            <div class="">
                <img src="<?=BASEURL_ARQUIVOS.DIRECTORY_SEPARATOR.$sol->getImagemLivro();?>" alt="<?=$sol->getNomeLivro();?>"><br>
            </div>
            <h4>UserNome</h4><br>
            <p><?=$sol->getNomeLivro()?></p><br>
            <p><?php if($sol->getStatusTroca() === true) echo'antiva';else echo 'nao ativa';?></p>
         </div>
         <?php endforeach;
            foreach ($dados['ofertas'] as $of):?>
            <div class="book-card">
                <img src="<?=BASEURL_ARQUIVOS.DIRECTORY_SEPARATOR.$of->getImagemLivro()?>"alt="<?=$of->getNomeLivro()?>">
                <p><?=$of->getNomeLivro()?></p>
                <?php if($of->getStatusTroca() === true):?>
                    <input type="submit" name="codeSec"id="codeSec">    
                <?php else:?>
                    <button class="btn btn-primary" type="submit" name="idTroca"id="idTroca">ativar Troca</button>
                <?php endif;?>    
            </div>
            <?php endforeach;?>
        <?php endif;?>  
    </div>
</div>
<?php

 include_once(__DIR__ . "/../include/footer.php");   
?>