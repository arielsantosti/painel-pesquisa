<?php

include_once 'header.php';

verificaPerfil();

//$login_user = $_GET['l'];

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
                  <h5 class="card-title">Notificação de Pesquisas</h5>
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

              <!--<p>Abaixo estão todos os usuários!</p> -->

              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table table-sm datatable">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Título</th>
                    <th scope="col">Qtd Usuários</th>
                    <th scope="col">Qtd Questões</th>
                    <th scope="col">Data Início</th>
                    <th scope="col">Data Fim</th>
                    <th scope="col">Ativa</th>
                    <th scope="col">Pausa</th>
                    <th scope="col">Obrigatório</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>

                <?php 
                
                $resultado = buscaTodasPesquisas($conn);

                foreach($resultado as $p){

                  $id_pesquisa = $p['id_pesquisa'];
                  $titulo_pesquisa = $p['titulo'];
                  $qtd_questao_pesquisa = $p['qtd_questao'];
                  $dt_inicio_pesquisa = $p['dt_inicio'];
                  $dt_fim_pesquisa = $p['dt_fim'];
                  $ativa_pesquisa = $p['ativa'];
                  $pause_pesquisa = $p['pause'];
                  $obrigatorio_pesquisa = $p['obrigatorio'];

                  $qtd_usuarios_pesquisa = count(buscaUsuariosPesquisa($conn, $id_pesquisa));

                  //$resultado2 = buscaUsuarioUnidade($conn, $id_user);
                  //$referencia_unidade = $resultado2[0]['referencia'];

                  //if($referencia_unidade == ''){ $referencia_unidade = '-';}

                  ?>

                  <tr>
                      <td><?=$id_pesquisa?></td>
                      <td><?=$titulo_pesquisa?></td>
                      <td><?=$qtd_usuarios_pesquisa?></td>
                      <td><?=$qtd_questao_pesquisa?></td>
                      <td><?=$dt_inicio_pesquisa?></td>
                      <td><?=$dt_fim_pesquisa?></td>
                      <td><?php if($ativa_pesquisa == 1){echo '<i class="bi bi-check-lg text-success"></i>';}else{ echo '<i class="bi bi-x-lg text-danger"></i>';}?></td>
                      <td><?php if($pause_pesquisa == 1){echo '<i class="bi bi-pause-fill text-warning"></i>';}elseif($pause_pesquisa == 0 || $pause_pesquisa = ''){ echo '<i class="bi bi-play-fill text-success"></i>';}?></td>
                      <td><?=$obrigatorio_pesquisa?></td>
                      <td>
                      <?php if($ativa_pesquisa == 0 || $qtd_usuarios_pesquisa == 0 || $pause_pesquisa == 1){ ?>
                          <button type="button" class="btn btn-sm btn-secondary disabled" ><i class="bi bi-megaphone"></i></button>
                      <?php }else{ ?>
                        <a href="usuarios-notificacao.php?p=<?=$id_pesquisa?>&t=<?=$titulo_pesquisa?>"><button type="button" class="btn btn-sm btn-primary" ><i class="bi bi-megaphone"></i></button></a>
                      <?php } ?>
                      </td>
                        
                      
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
