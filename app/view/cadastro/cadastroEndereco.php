<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<main>
    <div class="container">
        <h3 class="text-center mb-4">Cadastrar Novo Endereço</h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="<?= BASEURL . '/controller/MeusLivrosController.php?action=cadastroEnderecoOn' ?>" enctype="multipart/form-data">
                                <label for="nome">Nome do Endereço:</label>
                                <input type="text" id="nome" name="nome" required placeholder="Ex: Casa, Trabalho, etc.">

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
                                    foreach($estados as $sigla => $nome):
                                    ?>
                                        <option value="<?= $sigla ?>"><?= $nome ?></option>
                                    <?php endforeach; ?>

                                <label for="cidade">Cidade:</label>
                                <input type="text" id="cidade" name="cidade" required>

                                <label for="cep">CEP:</label>
                                <input type="text" id="cep" name="cep" required pattern="\d{5}-?\d{3}" placeholder="Ex: 12345-678">

                                <label for="rua">Rua:</label>
                                <input type="text" id="rua" name="rua" required>


                                <label for="numero">Número da Residência:</label>
                                <input type="text" id="numero" name="numero" required>


                                <label for="complemento">Complemento:</label>
                                <input type="text" id="complemento" name="complemento">


                                <label for="referencia">Ponto de Referência:</label>
                                <input type="text" id="referencia" name="referencia">

                                <button type="submit">Cadastrar Endereço</button>
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