<?php

include_once 'header.php';

verificaPerfil();

$login_user = $_GET['l'];

if(isset($_GET['msg']) && $_GET['msg'] == 'success'){
  $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='width:80%'>
            <strong><center>Usuário $login_user criado com sucesso!</center></strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'erro'){
  $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='width:80%'>
            <strong><center>Não foi possível criar o usuário $login_user!</center></strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}



?>

  <main id="main" class="main">

  <?=$msg?>

    <section class="section">
      <div class="row">
        <div class="col-lg-10">

        <div class="card" style="width:auto; height:auto;">
            <div class="card-body">

              <div class="row">

                <div class="col">
                  <h5 class="card-title">Cadastro de Usuários</h5>
                </div>
                
                <div class="col">
                  <br>
                  <a href="cadastrar-usuario.php"><button type="button" class="btn btn-light btn-sm d-none d-sm-block btn-ceadis" style="margin-left: 70%;"><i class="bi bi-person-plus"></i> Cadastrar</button></a>
                  <a href="cadastrar-usuario.php"><button type="button" class="btn btn-light d-block d-sm-none btn-ceadis" style="margin-left: 75%;"><i class="bi bi-person-plus"></i></button></a>
                  <br>
                </div>

              </div>

              <!--<p>Abaixo estão todos os uauários!</p> -->

              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table table-sm datatable">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Login</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Unidade</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Troca Senha</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>

                <?php 
                
                $resultado = buscaTodosUsuarios($conn);

                foreach($resultado as $u){

                  $id_user = $u['id_usuario'];
                  $nome_user = $u['nome'];
                  $login_user = $u['login'];
                  $email_user = $u['email'];
                  //$codigo_unidade = $u['codigo'];
                  $ativo_user = $u['ativo'];
                  $troca_senha_user = $u['troca_senha']; 

                  $resultado2 = buscaUsuarioUnidade($conn, $id_user);
                  $referencia_unidade = $resultado2[0]['referencia'];

                  if($referencia_unidade == ''){ $referencia_unidade = '-';}

                  ?>

                  <tr>
                      <td><?=$nome_user?></td>
                      <td><?=$login_user?></td>
                      <td><?=$email_user?></td>
                      <td><?=$referencia_unidade?></td>
                      <td><?php if($ativo_user == 1){echo '<i class="bi bi-check-lg text-success"></i>';}else{ echo '<i class="bi bi-x-lg text-danger"></i>';}?></td>
                      <td><?php if($troca_senha_user == 1){echo '<i class="bi bi-check-lg text-success"></i>';}else{ echo '<i class="bi bi-x-lg text-danger"></i>';}?></td>
                      <td><a href="edita-usuario.php?l=<?=$login_user?>"><button type="button" class="btn btn-sm btn-primary" ><i class="bi bi-pencil-square"></i></button></a></td>
                  </tr>
                
                <?php } ?>                       

                </tbody>
              </table>

              <center><a href="painel.php"class="btn btn-light btn-sm btn-ceadis-y">Voltar</a></center>
              </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include_once 'footer.php'; ?>