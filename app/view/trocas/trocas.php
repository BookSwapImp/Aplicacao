<?php

 include_once(__DIR__ . "/../include/header.php");

 include_once(__DIR__."/../include/menu.php");

 include_once(__DIR__."/../include/msg.php");
?>
<script>
function showSecCode(cod) {
    alert("Código de segurança: " + cod);
}
</script>
<div class="countainer">
    <div class="book-grid">
     <?php if(empty($dados)): echo'
<div class="data-message">
    <!-- Título ou cabeçalho para a mensagem -->
    <h4 class="text-muted mb-3">Aviso</h4>
    
    <!-- O texto principal, com ênfase e cor de texto sutil -->
    <p class="lead text-secondary">
        <strong>Não há dados</strong>
    </p>
    
    <!-- Texto de apoio opcional -->
    <small class="text-muted">Nenhum registro foi encontrado para os critérios de busca.</small>
</div>';
      else: foreach($dados['solicitacao'] as $sol):?>
        <div class="book-card">
            <h6>Solicitadas</h6>
            <div class="">
                <img src="<?=BASEURL_ARQUIVOS.DIRECTORY_SEPARATOR.$sol['anuncio']->getImagemLivro()?>" alt="<?=$sol['anuncio']->getNomeLivro()?>"><br>
            </div>
            <h3><?=$sol['anuncio']->getNomeLivro()?></h3><br>
<p><a href="http://localhost/Aplicacao/app/controller/PerfilController.php?action=otherUserPerfilPage&id=<?=$sol['anuncio']->getUsuarioIdInt()?>">Ver Perfil do Dono</a></p><br>
          <?php if($sol['anuncio']->getStatusTroca() === true): ?>
               <strong><p>Codigo segurança: <?=$sol['secCode']?></p></strong>
        <?php else: ?>
            <strong><p>Não ativa, aguarde o outro usuário</p></strong>
            <?php endif; ?>
            <p>Telefone: <?=$sol['OtherUserData']->getTelefone()?></p><br>
            <form method="POST" action="?action=buttonDeleteTrade">
                <input type="hidden" name="idTroca" value="<?=$sol['trocaId']?>">
                <button class="btn btn-danger" type="submit" onclick="return confirm('Tem certeza que deseja cancelar esta troca?')">Cancelar Troca</button>
            </form>
         </div>
         <?php endforeach;
            foreach ($dados['ofertas'] as $of):?>
            <div class="book-card">
                <h6>ofertas</h6>
                <img src="<?=BASEURL_ARQUIVOS.DIRECTORY_SEPARATOR.$of['anuncio']->getImagemLivro()?>"alt="<?=$of['anuncio']->getNomeLivro()?>">
                <h3><?=$of['anuncio']->getNomeLivro()?></h3>
<p><a href="http://localhost/Aplicacao/app/controller/PerfilController.php?action=otherUserPerfilPage&id=<?=$of['anuncio']->getUsuarioIdInt()?>"><?=$of['OtherUserData']->getNome()?></a></p>
              <p>Troca Iniciada: </p>
                <?php if($of['anuncio']->getStatusTroca() === true):?>
                    <p>Telefone: <?=$of['OtherUserData']->getTelefone()?></p>
                 <form method="POST" action="?action=inputCodeSec">
                   <input type="hidden" name="idTroca" value="<?=$of['trocaId']?>">
                   <input name="codeSec"id="codeSec">
                    <button class="btn btn-primary" type="submit">comfir</button>
                 </form>
                <?php else:?>
                    <form method="POST" action="?action=trocasActive">
                        <input type="hidden" name="idTroca" value="<?=$of['trocaId']?>"><p><?=$of['trocaId']?></p>
                        <button class="btn btn-primary" type="submit">ativar Troca</button>
                    </form>
                <?php endif;?>
                <form method="POST" action="?action=buttonDeleteTrade">
                    <input type="hidden" name="idTroca" value="<?=$of['trocaId']?>">
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Tem certeza que deseja cancelar esta troca?')">Cancelar Troca</button>
                </form>
            </div>
            <?php endforeach;?>
        <?php endif;?>  
    </div>
</div>
<?php

 include_once(__DIR__ . "/../include/footer.php");   
?>