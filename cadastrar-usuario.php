<?php 

include_once 'header.php';
/*
verificaPerfil();

  $login_user = $_GET['l'];

  $resultado = buscaUsuarioPerfil($conn, $login_user);

  $nome_user = $resultado[0]['id'];
  $nome_user = $resultado[0]['nome'];
  $login_user = $resultado[0]['login'];
  $email_user = $resultado[0]['email'];
  $ativo_user = $resultado[0]['ativo'];
  $troca_senha_user = $resultado[0]['troca_senha'];
  $perfil_user = $resultado[0]['perfil'];
  */
  
  //var_dump($resultado);
  if(isset($_GET['msg']) && $_GET['msg'] == 'success'){
    $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='width:80%'>
              <strong><center>Alterado com sucesso!</center></strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
  }
  if(isset($_GET['msg']) && $_GET['msg'] == 'erro'){
    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='width:80%'>
              <strong><center>Erro ao alterar!</center></strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
  }
?>

  <main id="main" class="main">
  <h4><?=$msg?></h4>

    <div class="pagetitle">
      <h1>Cadastrar Usuário</h1><br>

    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

              <!--
              <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview">Visualizar</button>
                </li>
              -->

              <li class="nav-item">
                <button class="nav-link active btn-ceadis" data-bs-toggle="tab" data-bs-target="#profile-edit">Cadastro</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="controller/cria-usuario.php" method="POST">

                  <div class="row mb-3">
                    <label for="nome" class="col-md-4 col-lg-2 col-form-label">Nome</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="nome" type="text" class="form-control" id="nome" value="" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="login" class="col-md-4 col-lg-2 col-form-label">Login</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="login" type="text" class="form-control" id="login" value="" placeholder="nome.sobrenome" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Senha" class="col-md-4 col-lg-2 col-form-label">Senha</label>
                    <div class="col-md-8 col-lg-9">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="****"  minlength="3" maxlength="10" style="width: 210px;" required>
                    <i id="olho" style="margin-left:180px; margin-top:-30px; width: 25px; cursor: pointer; position: absolute;" class="bi bi-eye olho"></i>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-2 col-form-label">E-mail</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="text" class="form-control" id="email" value="" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                  <label class="col-sm-4 col-lg-2 form-check-label">Unidade</label>
                  <div class="col-md-8 col-lg-9">
                    <select class="form-select" aria-label="" name="codigo_unidade">
                      <option value="-" selected> - </option>
                        <?php
                        $resultadoUnidades = buscaTodasUnidades($conn);
                        foreach($resultadoUnidades as $r){ ?>
                          <option value="<?=$r['codigo']?>"><?=$r['referencia']?> - <?=$r['descricao']?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>

                  <div class="row mb-3">
                    <label class="col-sm-4 col-lg-2 form-check-label" for="gridCheck1">Ativo</label>
                    <div class="col-md-8 col-lg-9">
                
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1" name="ativo" checked>
                      </div>

                    </div>
                  </div>

                  <div class="row mb-3">
                  <label class="col-sm-4 col-lg-2 form-check-label">Perfil</label>
                  <div class="col-md-8 col-lg-9">
                    <select class="form-select" aria-label="" name="perfil" required>
                      <option selected>PESQUISAS</option>
                      <option value="1">ADM</option>
                      <option value="2">PESQUISAS</option>
                    </select>
                  </div>
                </div><br>

    <center><a href="usuarios.php"class="btn btn-light btn-ceadis-y btn-sm ">Voltar</a> <button type="submit" class="btn btn-sm btn-light btn-ceadis">Salvar Alterações</button></center>
  </div>
</form><!-- End Profile Edit Form -->

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