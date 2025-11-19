<?php
include_once(__DIR__ . "/headerMantenedor.php");
?>
 
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <?php include_once(__DIR__ . "/sidebar.php"); ?>
    
    
    <!-- Main Content -->
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
            <h2><?= $dados['numeroUsuarios'] ?></h2>
            <p>Usuários</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-metric bg-white">
            <h2><?= $dados['numeroLivros'] ?></h2>
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

            <a href="<?= BASEURL ?>/controller/MantenedorController.php?action=usuarios" type="button" class="btn btn-primary col-2">Ver todos</a>

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

              <!-- 
              <a href="<?= BASEURL ?> /controller/MantenedorController.php?action=usuarios" type="button" class="btn btn-primary col-2" >Ver todos</a>
              -->

            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>