<?php
include_once(__DIR__ . "/headerMantenedor.php");
?>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <?php include_once(__DIR__ . "/sidebar.php"); ?>

    <div class="content col-10">
      <!-- Barra superior -->
      <div class="top-bar">
        <h2>Dashboard</h2>
        <div>
          <img src="http://localhost/Aplicacao/app/view/mantenedor/Logo_Simples.png" width=70 height=60>
        </div>
      </div>


      <br>
      <div class="row mb-4">
        <div class="card p-3">
          <h5>Gerenciamento de anúncios
          </h5>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dados['anuncios'] as $anuncios) : ?>

                <tr>
                  <td><?= $anuncios->getNomeLivro()  ?></td>
                  <td><?= $anuncios->getDescricao() ?></td>
                  <td><?= $anuncios->getStatus() ?></td>
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