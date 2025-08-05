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
                        <form method="POST" action="<?= BASEURL . '/controller/MeusLivrosController.php?action=saveLivro' ?>" enctype="multipart/form-data">
                                <label for="estado">Estado:</label>
                                <select id="estado" name="estado" required>
                                    <option value="">Selecione o estado</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>

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