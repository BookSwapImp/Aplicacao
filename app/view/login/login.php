<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href=" <?php BASEURL_CSS?>/custom.css">
</head>
<body>
    <div class="form-container">
        <div class="form-logo">
            <img src="logo.png" alt="Logo">
            <h1>Login</h1>
        </div>
        <form action="processar_login.php" method="post">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="senha" class="form-control" placeholder="Senha" required>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a class="form-link" href="cadastro.php">FAZER CADASTRO</a>
            </div>
            <button type="submit" class="btn btn-confirm w-100">CONFIRMAR</button>
        </form>
    </div>
</body>
</html>


<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
