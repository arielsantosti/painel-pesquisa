<?php include_once 'header.php';

if(isset($_GET['msg']) && $_GET['msg'] == 'success'){
    $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='width:80%'>
              <strong><center>Senha alterada com sucesso!</center></strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
  }
  if(isset($_GET['msg']) && $_GET['msg'] == 'erro'){
    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='width:80%'>
              <strong><center>Erro ao alterar senha!</center></strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
  }

  ?>

  <main id="main" class="main">
    
  <?=$msg?>

    <div class="pagetitle">
      <h1>Meu Perfil</h1><br>

    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Visualizar</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Editar senha</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Detalhes do perfil</h5>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label">Nome</div>
                    <div class="col-lg-9 col-md-8"><?=$nome?></div>
                  </div>

                  
                  <div class="row">
                    <div class="col-lg-2 col-md-4 label">Perfil</div>
                    <div class="col-lg-9 col-md-8"><?=$perfil?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label">Login</div>
                    <div class="col-lg-9 col-md-8"><?=$login?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label">E-mail</div>
                    <div class="col-lg-9 col-md-8"><?=$email?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label">Unidade</div>
                    <div class="col-lg-9 col-md-8"><?=$unidade?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label">Ativo</div>
                    <div class="col-lg-9 col-md-8"><?php if($ativo == 1){echo '<i class="bi bi-check-lg text-success"></i>';}else{ echo '<i class="bi bi-x-lg text-danger"></i>';}?></div>
                  </div>

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">

                  <!-- Change Password Form -->

                  <form class="row g-3" action="controller/altera-senha.php" method="POST">

                    <input type="text" name="login" class="form-control invisible" id="login" value=<?=$login?>>
                    
                    <div class="col-auto">
                        <label for="senha" class="col-lg-2 col-md-4 form-control-plaintext label">Nova senha</label>
                      </div>
                      <div class="col-auto">
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="****"  minlength="3" required>
                        <i id="olho" style="margin-left:180px; margin-top:-30px; width: 25px; cursor: pointer; position: absolute;" class="bi bi-eye olho"></i>
                      </div>
                      <div class="col-auto">

                      <input type="text" name="pagina" class="form-control invisible" id="pagina" value=<?=$pagina?>>
                        <button type="submit" class="btn btn-primary">Alterar senha</button>                     

                      </div>

                  </form>

                  <!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include_once 'footer.php'; ?>

  <script>
        document.getElementById('olho').addEventListener('mousedown', function() {
      document.getElementById('senha').type = 'text';
    });

    document.getElementById('olho').addEventListener('mouseup', function() {
      document.getElementById('senha').type = 'password';
    });

    // Para que o password não fique exposto apos mover a imagem.
    document.getElementById('olho').addEventListener('mousemove', function() {
      document.getElementById('senha').type = 'password';
    });
  </script>