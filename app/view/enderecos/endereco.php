<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Meus Endereços</h2>
        <a href="<?= BASEURL ?>/controller/EnderecosController.php?action=cadastroEnderecoPage" class="btn btn-primary btn-sm">Adicionar</a>
    </div>

    <?php if (!isset($dados['enderecos']) || empty($dados['enderecos'])): ?>
        <div class="alert alert-info">Nenhum endereço cadastrado.</div>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Rua</th>
                    <th>Cidade</th>
                    <th>CEP</th>
                    <th>Estado</th>
                    <th>Número</th>
                    <th>Main</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados['enderecos'] as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nome']) ?></td>
                        <td><?= htmlspecialchars($row['rua']) ?></td>
                        <td><?= htmlspecialchars($row['cidade']) ?></td>
                        <td><?= htmlspecialchars($row['cep']) ?></td>
                        <td><?= htmlspecialchars($row['estado']) ?></td>
                        <td><?= htmlspecialchars($row['numero']) ?></td>
                        <td><?= htmlspecialchars($row['main']) ?></td>
                        <td>
                            <a href="<?= BASEURL ?>/controller/EnderecosController.php?action=editarEnderecoPage&id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="<?= BASEURL ?>/controller/EnderecosController.php?action=DeletarEnderecos&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar exclusão?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once(__DIR__ . "/../include/footer.php"); ?>