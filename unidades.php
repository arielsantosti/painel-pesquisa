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
                  <h5 class="card-title">Cadastro de Unidades</h5>
                </div>
                
                <!--
                <div class="col">
                  <br>
                  <a href="cadastrar-usuario.php"><button type="button" class="btn btn-sm btn-success d-none d-sm-block" style="margin-left: 70%;"><i class="bi bi-person-plus"></i> Cadastrar</button></a>
                  <a href="cadastrar-usuario.php"><button type="button" class="btn btn-success d-block d-sm-none" style="margin-left: 75%;"><i class="bi bi-person-plus"></i></button></a>
                  <br>
                </div>
                -->

              </div>

              <!--<p>Abaixo estão todos os uauários!</p> -->

              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table table-sm datatable">
                <thead>
                  <tr>
                    <th scope="col">Descricão</th>
                    <th scope="col">Referência</th>
                    <th scope="col">Sigla</th>
                    <th scope="col">CNPJ</th>
                  </tr>
                </thead>
                <tbody>

                <?php 
                
                $resultado = buscaTodosUnidades($conn);

                foreach($resultado as $u){

                  $descricao_unidade = $u['descricao'];
                  $referencia_unidade = $u['referencia'];
                  $sigla_unidade = $u['sigla'];
                  $cnpj_unidade = $u['cnpj']; ?>

                  <tr>
                      <td><?=$descricao_unidade?></td>
                      <td><?=$referencia_unidade?></td>
                      <td><?=$sigla_unidade?></td>
                      <td><?=$cnpj_unidade?></td>
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