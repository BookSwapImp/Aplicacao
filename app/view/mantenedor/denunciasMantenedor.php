<?php
  # Nome do arquivo: homeMantenedor.php
  # Objetivo: Página principal do mantenedor/admin do sistema BookSwap
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - BookSwap</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .sidebar {
      background-color: #0a4b7dff;
      color: white;
      padding: 20px;
    }
    .sidebar a {
      display: block;
      color: white;
      padding: 10px 0;
      text-decoration: none;
    }
    .sidebar a.active, .sidebar a:hover {
      background-color: #334155;
      border-radius: 8px;
      padding-left: 10px;
    }
    .content {
      padding: 20px;
    }
    .card-metric {
      text-align: center;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
    }
    .table thead {
      background-color: #f1f5f9;
    }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <?php include_once(__DIR__ . "/sidebar.php"); ?>
 
    <div class="content col-10">
      <!-- Barra superior -->
      <div class="top-bar">
        <h2>Dashboard</h2>
        <div>
          <img src="http://localhost/Aplicacao/app/view/mantenedor/Logo_Simples.png"  width=70 height=60>
        </div>
      </div>


    <br>
      <div class="row mb-4">
          <div class="card p-3">
            <h5>Gerenciamento de usuários</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dados['usuarios'] as $usuario) : ?>
                
                <tr>
                  <td><?= $usuario->getNome()  ?></td>
                  <td><?= $usuario->getEmail() ?></td>
                  <td><?= $usuario->getStatus() ?></td>
                  <td><button class="btn btn-sm btn-secondary">View</button></td>
                </tr>

                <?php endforeach; ?>
                
              </tbody>
            </table>

          </div>
        </div>
       
      </div>
    </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>