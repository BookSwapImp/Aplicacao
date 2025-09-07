<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
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
                                <div class="mb-3">
                                    <label for="nome">Nome do Endereço:</label>
                                    <input type="text" id="nome" name="nome" required placeholder="Ex: Casa, Trabalho, etc." value="<?php echo isset($dados['endereco']) ? htmlspecialchars($dados['endereco']->getNome()) : ''; ?>">
                                </div>
                                <div class="mb-3">
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
                                    </div>
                                <div class="mb-3">
                                    <label for="cidade">Cidade:</label>
                                    <input type="text" id="cidade" name="cidade" required value="<?php echo isset($dados['endereco']) ? htmlspecialchars($dados['endereco']->getCidade()) : ''; ?>">
                                </div>
                                <div class="mb-3">
                                <label for="cep">CEP:</label>
                                    <input type="text" id="cep" name="cep" required pattern="\d{5}-?\d{3}" placeholder="Ex: 12345-678" value="<?php echo isset($dados['endereco']) ? htmlspecialchars($dados['endereco']->getCep()) : ''; ?>">
                                    <label for="rua">Rua:</label>
                                    <input type="text" id="rua" name="rua" required value="<?php echo isset($dados['endereco']) ? htmlspecialchars($dados['endereco']->getRua()) : ''; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="numero">Número da Residência:</label>
                                    <input type="text" id="numb" name="numb" class="form-control" required value="<?php echo isset($dados['endereco']) ? htmlspecialchars($dados['endereco']->getNumb()) : ''; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="main">Tipo de Endereço</label>
                                    <select id="main" name="main" class="form-select" required>
                                        <option value="normal" <?php echo isset($dados['endereco']) && $dados['endereco']->getMain() == 'normal' ? 'selected' : ''; ?>>Normal</option>
                                        <option value="main" <?php echo isset($dados['endereco']) && $dados['endereco']->getMain() == 'main' ? 'selected' : ''; ?>>Principal</option>
                                    </select>
                                    <div class="form-text">Marque como <strong>Principal</strong> se for o endereço principal.</div>
                                </div>

                                <?php include_once(__DIR__.'/../include/msg.php')?>

                                <button type="submit" class="btn btn-primary"><?php echo isset($dados['endereco']) ? 'Editar Endereço' : 'Cadastrar Endereço'; ?></button>
                                <a href="<?= BASEURL . '/controller/EnderecosController.php?action=EnderecosPage' ?>" class="btn btn-secondary">Cancelar</a>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>