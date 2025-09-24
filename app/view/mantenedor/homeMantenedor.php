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
    <div class="sidebar col-2">
        
      <a href="http://localhost/Aplicacao/app/controller/HomeController.php?action=home">Página inicial</a>
      <br></br>
      <a href="#">Dashboard</a>
      <a href="#">Usuários</a>
      <a href="#">Livros</a>
      <a href="#">Trocas</a>
      <a href="#">Denúncias</a>
    </div>
 
    <div class="content col-10">
      <!-- Barra superior -->
      <div class="top-bar">
        <h2>Dashboard</h2>
        <div>
          <img src="http://localhost/Aplicacao/app/view/mantenedor/Logo_Simples.png"  width=70 height=60>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-4">
          <div class="card-metric bg-white">
            <h2>1,250</h2>
            <p>Usuários</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-metric bg-white">
            <h2>830</h2>
            <p>Livros</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-metric bg-white">
            <h2>112</h2>
            <p>Trocas ativas</p>
          </div>
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
                <tr>
                  <td>John Smith</td>
                  <td>john.smith@example.com</td>
                  <td>Active</td>
                  <td><button class="btn btn-sm btn-secondary">View</button></td>
                </tr>
                <tr>
                  <td>Jane Doe</td>
                  <td>jane.doe@example.com</td>
                  <td>Inactive</td>
                  <td><button class="btn btn-sm btn-secondary">View</button></td>
                </tr>
                <tr>
                  <td>Alice Johnson</td>
                  <td>alice.johnson@example.com</td>
                  <td>Active</td>
                  <td><button class="btn btn-sm btn-secondary">View</button></td>
                </tr>
                <tr>
                  <td>Michael Brown</td>
                  <td>michael.brown@example.com</td>
                  <td>Active</td>
                  <td><button class="btn btn-sm btn-secondary">View</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
       
        <!-- Report Management -->
        <div>
          <div class="row mb-4">
            <div class="card p-3">
              <h5>Gerenciamento de denúncias</h5>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Apr 24, 2024</td>
                    <td>Swap Issue</td>
                    <td>Open</td>
                    <td><button class="btn btn-sm btn-secondary">View</button></td>
                  </tr>
                  <tr>
                    <td>Apr 23, 2024</td>
                    <td>Inappropriate Content</td>
                    <td>Closed</td>
                    <td><button class="btn btn-sm btn-secondary">View</button></td>
                  </tr>
                  <tr>
                    <td>Apr 23, 2024</td>
                    <td>User Misconduct</td>
                    <td>Closed</td>
                    <td><button class="btn btn-sm btn-secondary">View</button></td>
                  </tr>
                  <tr>
                    <td>Apr 22, 2024</td>
                    <td>Swap Issue</td>
                    <td>Open</td>
                    <td><button class="btn btn-sm btn-secondary">View</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
