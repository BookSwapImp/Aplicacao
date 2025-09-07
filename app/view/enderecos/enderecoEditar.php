<?php
include_once(__DIR__.'/../include/header.php');
include_once(__DIR__.'/../include/menu.php');
?>
<main>
    <div class="container">
        <h3 class="text-center mb-4"><?php echo isset($dados['endereco']) ? 'Editar Endereço' : 'Cadastrar Novo Endereço'; ?></h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="<?= BASEURL . '/controller/EnderecosController.php?action=' . (isset($dados['endereco']) ? 'editarEnderecosOn' : 'cadastroEnderecoOn') ?>" enctype="multipart/form-data">
                            <?php if(isset($dados['endereco'])): ?>
                                <input type="hidden" name="id" value="<?= $dados['endereco']->getId() ?>">
                            <?php endif; ?>
                                <label for="nome">Nome do Endereço:</label>
                                <input type="text" id="nome" name="nome" required placeholder="Ex: Casa, Trabalho, etc." value="<?php echo isset($dados['endereco']) ? htmlspecialchars($dados['endereco']->getNome()) : ''; ?>">

                                <label for="estado">Estado:</label>
                                <select id="estado" name="estado" required>
                                    <option value="">Selecione o estado</option>
                                    <?php
                                    $estados = [
                                        'AC' => 'Acre',
                                        'AL' => 'Alagoas',
                                        'AP' => 'Amapá',
                                        'AM' => 'Amazonas',
                                        'BA' => 'Bahia',
                                        'CE' => 'Ceará',
                                        'DF' => 'Distrito Federal',
                                        'ES' => 'Espírito Santo',
                                        'GO' => 'Goiás',
                                        'MA' => 'Maranhão',
                                        'MT' => 'Mato Grosso',
                                        'MS' => 'Mato Grosso do Sul',
                                        'MG' => 'Minas Gerais',
                                        'PA' => 'Pará',
                                        'PB' => 'Paraíba',
                                        'PR' => 'Paraná',
                                        'PE' => 'Pernambuco',
                                        'PI' => 'Piauí',
                                        'RJ' => 'Rio de Janeiro',
                                        'RN' => 'Rio Grande do Norte',
                                        'RS' => 'Rio Grande do Sul',
                                        'RO' => 'Rondônia',
                                        'RR' => 'Roraima',
                                        'SC' => 'Santa Catarina',
                                        'SP' => 'São Paulo',
                                        'SE' => 'Sergipe',
                                        'TO' => 'Tocantins'
                                    ];
                                    $selectedEstado = isset($dados['endereco']) ? $dados['endereco']->getEstado() : '';
                                    foreach($estados as $sigla => $nome):
                                    ?>
                                        <option value="<?= $sigla ?>" <?php echo $selectedEstado == $sigla ? 'selected' : ''; ?>><?= $nome ?></option>
                                    <?php endforeach; ?>

                                <label for="cidade">Cidade:</label>
                                <input type="text" id="cidade" name="cidade" required value="<?php echo isset($dados['endereco']) ? htmlspecialchars($dados['endereco']->getCidade()) : ''; ?>">

                                <label for="cep">CEP:</label>
                                <input type="text" id="cep" name="cep" required pattern="\d{5}-?\d{3}" placeholder="Ex: 12345-678" value="<?php echo isset($dados['endereco']) ? htmlspecialchars($dados['endereco']->getCep()) : ''; ?>">

                                <label for="rua">Rua:</label>
                                <input type="text" id="rua" name="rua" required value="<?php echo isset($dados['endereco']) ? htmlspecialchars($dados['endereco']->getRua()) : ''; ?>">

                                <label for="numero">Número da Residência:</label>
                                <input type="text" id="numero" name="numero" required value="<?php echo isset($dados['endereco']) ? htmlspecialchars($dados['endereco']->getNumb()) : ''; ?>">

                                <?php if(isset($dados['endereco'])): ?>
                                    <label for="main">Principal:</label>
                                    <input type="checkbox" id="main" name="main" value="main" <?php echo $dados['endereco']->getMain() == 'main' ? 'checked' : ''; ?>>
                                <?php endif; ?>

                               <button type="submit"><?php echo isset($dados['endereco']) ? 'Editar Endereço' : 'Cadastrar Endereço'; ?></button>
                               <a href="<?= BASEURL . '/controller/EnderecosController.php?action=EnderecosPage' ?>">Cancelar</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once(__DIR__.'/../include/footer.php');
?>