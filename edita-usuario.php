<?php

include_once 'header.php';

verificaPerfil();

  $login_user = $_GET['l'];

  $resultado = buscaUsuarioPerfil($conn, $login_user);

  $nome_user = $resultado[0]['nome'];
  $login_user = $resultado[0]['login'];
  $email_user = $resultado[0]['email'];
  $ativo_user = $resultado[0]['ativo'];
  $troca_senha_user = $resultado[0]['troca_senha'];
  $perfil_user = $resultado[0]['perfil'];
  $id_user = $resultado[0]['id_usuario'];

  $resultadoUnidadeUsuario = buscaUsuarioUnidade($conn, $id_user);
  $unidade_cod_user = $resultadoUnidadeUsuario[0]['codigo'];
  $unidade_ref_user = $resultadoUnidadeUsuario[0]['referencia'];
  $unidade_desc_user = $resultadoUnidadeUsuario[0]['descricao'];
  
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
      <h1>Editar Usuário</h1><br>

    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview">Visualizar</button>
                </li>

              <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade profile-overview" id="profile-overview">

                  <h5 class="card-title">Detalhes do perfil</h5>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label ">Nome</div>
                    <div class="col-lg-9 col-md-8"><?=$nome_user?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label">Login</div>
                    <div class="col-lg-9 col-md-8"><?=$login_user?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label">E-mail</div>
                    <div class="col-lg-9 col-md-8"><?=$email_user?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label">Unidade</div>
                    <div class="col-lg-9 col-md-8"><?=$unidade_ref_user?> - <?=$unidade_desc_user?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label">Ativo</div>
                    <div class="col-lg-9 col-md-8"><?php if($ativo_user == 1){echo '<i class="bi bi-check-lg text-success"></i>'; $checked = 'checked';}else{ echo '<i class="bi bi-x-lg text-danger"></i>';}?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-4 label">Perfil</div>
                    <div class="col-lg-9 col-md-8"><?=$perfil_user?></div>
                  </div>

                </div>

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

<!-- Profile Edit Form -->
<form action="controller/altera-perfil.php" method="POST">

<input name="id_user" type="hidden" class="form-control bg-light" id="id_user" value="<?=$id_user?>" readonly>

  <div class="row mb-3">
    <label for="nome" class="col-md-4 col-lg-2 col-form-label">Nome</label>
    <div class="col-md-8 col-lg-9">
      <input name="nome" type="text" class="form-control bg-light" id="nome" value="<?=$nome_user?>" readonly>
    </div>
  </div>

  <div class="row mb-3">
    <label for="login" class="col-md-4 col-lg-2 col-form-label">Login</label>
    <div class="col-md-8 col-lg-9">
      <input name="login" type="text" class="form-control bg-light" id="login" value="<?=$login_user?>" readonly>
    </div>
  </div>

  <div class="row mb-3">
    <label for="email" class="col-md-4 col-lg-2 col-form-label">E-mail</label>
    <div class="col-md-8 col-lg-9">
      <input name="email" type="text" class="form-control" id="email" value="<?=$email_user?>">
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-4 col-lg-2 form-check-label">Unidade</label>
    <div class="col-md-8 col-lg-9">
      <select class="form-select" aria-label="" name="codigo_unidade">
        <option value="<?=$unidade_cod_user?>" selected><?=$unidade_ref_user?> - <?=$unidade_desc_user?></option>
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
        <input class="form-check-input" type="checkbox" id="gridCheck1" name="ativo" <?=$checked?>>
      </div>

    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-4 col-lg-2 form-check-label">Perfil</label>
    <div class="col-md-8 col-lg-9">
      <select class="form-select" aria-label="" name="perfil">
        <option selected><?=$perfil_user?></option>
        <option value="1">ADM</option>
        <option value="2">PESQUISAS</option>
      </select>
    </div>
  </div><br>

    <center><a href="usuarios.php"class="btn btn-light btn-sm btn-ceadis-y">Voltar</a> <button type="submit" class="btn btn-ceadis btn-sm">Salvar Alterações</button></center>
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