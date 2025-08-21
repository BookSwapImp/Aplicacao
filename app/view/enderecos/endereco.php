<?php
include_once(__DIR__.'/../include/header.php');
include_once(__DIR__.'/../include/menu.php');
?>
    <div class="container">
        <a href="<?= BASEURL . '/controller/EnderecosController.php?action=cadastroEnderecoPage' ?>">+<?php /* Adicionar*/?></a>
    </div>
    <div class="container">
            <?php if(isset($dados)):?>
                <div class="title">
                    <h2>Não á enderços</h2>
                </div>
            <?php else:?>
                <?php foreach($dados as $endereco):?>

        <div class="card">
                <div class="card-header">
                <h2 class="card-title"><?php echo $endereco->getgetNome();?></h2>
            </div>

            <div class="card-body">
                <p><?php echo $endereco->getRua();?></p>
                <p><?php echo $endereco->getCidade();?></p>
                <p><?php echo $endereco->getCep();?></p>
                <p><?php echo $endereco->getEstado();?></p>

                <p><?php echo $endereco->getNumero();?></p>
            </div>
        </div>
        <?php endforeach;
        endif;?>
    </div>
<?php
include_once(__DIR__.'/../include/footer.php');
?>