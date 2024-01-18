<?php

include_once 'header.php';

verificaPerfil();

$id_pesquisa = $_GET['p'];
$titulo_pesquisa = $_GET['t'];

if(isset($_GET['msg']) && $_GET['msg'] == 'success'){
  $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='width:80%'>
            <strong><center>E-mail de notificação enviado com sucesso!</center></strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'erro'){
  $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='width:80%'>
            <strong><center>Não foi possível enviar o e-mail de notificação!</center></strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

if(isset($_GET['msg']) && $_GET['msg'] == 'erro-b'){
  $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='width:80%'>
            <strong><center>Não foi possível enviar o e-mail de notificação, o usuário pode não ter um e-mail válido ou a pesquisa já foi respondida por ele!</center></strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}

?>

  <main id="main" class="main">

  <?=$msg?>

    <section class="section">
      <div class="row">
        <div class="col-lg-10">

        <div class="card" style="width:auto; height:auto;">
        <form action="controller/envia-notificacao.php" method="POST">
            <div class="card-body">

              <div class="row">

                <div class="col">
                  <h1 class="card-title">Usuários Notificação</h1>
                </div>

                <?php
                $resultado = buscaUsuariosPesquisa($conn, $id_pesquisa);
                $qtd_usuarios_pesquisa = count($resultado);

                echo '<span><strong> Pesquisa: </strong>'.$titulo_pesquisa .'</span>';
                ?>

                <input name="id_pesquisa" type="text" class="form-check-input" id="exampleCheck1" value="<?=$id_pesquisa?>" style="display: none;">
                <input name="qtd" type="text" class="form-check-input" id="exampleCheck1" value="<?=$qtd_usuarios_pesquisa?>" style="display: none;">
                <input name="titulo" type="text" class="form-check-input" id="exampleCheck1" value="<?=$titulo_pesquisa?>" style="display: none;">

                
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
              <!-- <table class="table table-sm datatable"> -->
              <table class="table" style="margin-top: 20px;">
                <thead>
                  <tr>
                    <th scope="col">Login</th>
                    <th scope="col">Unidade</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Respondeu</th>
                    <th scope="col"><a id="btn-check" onclick="check()"><i class='bi bi-check'></i>Marcar</a></th>
                  </tr>
                </thead>
                <tbody>

                <?php
                
                $contador = 0;

                foreach($resultado as $p){
                  
                  $id_pesquisa = $p['id_pesquisa'];
                  $login_pesquisa = $p['login'];
                  $referencia_unidade = $p['referencia'];
                  $email_pesquisa = $p['email'];
                  $respondeu_pesquisa = $p['respondeu'];

                  $nome_usuario = $p['nome'];
                  
                  //$resultado2 = buscaUsuarioUnidade($conn, $id_user);
                  //$referencia_unidade = $resultado2[0]['referencia'];

                  //if($referencia_unidade == ''){ $referencia_unidade = '-';}

                  ?>

                  <input name="login-<?=$contador?>" type="text"  value="<?=$login_pesquisa?>" style="display: none;">
                  <input name="nome-<?=$contador?>" type="text" value="<?=$nome_usuario?>" style="display: none;">
                  <input name="resp-<?=$contador?>" type="text"   value="<?=$respondeu_pesquisa?>" style="display: none;">

                  <tr>
                      <td><?=$login_pesquisa?></td>
                      <td><?=$referencia_unidade?></td>
                      <td><?=$email_pesquisa?></td>
                      <td><?php if($respondeu_pesquisa == 1){echo '<i class="bi bi-check-lg text-success"></i>';}else{ echo '<i class="bi bi-x-lg text-danger"></i>';}?></td>
                      <td>
                      <?php if($respondeu_pesquisa == 1){ ?>
                            <input type="checkbox" class="form-check-input" id="check" value="of" disabled>
                      <?php }else{ ?>
                         <input name="email-<?=$contador?>" type="checkbox" class="form-check-input" id="check-<?=$contador?>" value="<?=$email_pesquisa?>">
                      <?php 
                          
                          } ?>
                      </td>
                  
                      </tr>
                
                <?php  $contador++; }?>
                
                

                </tbody>
              </table>

              <?=$qtd_usuarios_pesquisa?> - registros

              <center><a href="notificacao.php"class="btn btn-light btn-sm btn-ceadis-y">Voltar</a> <button type="submit" class="btn btn-light btn-ceadis btn-sm">Enviar Notificação</button></center>
              </form>
            </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script>

    var x;
    var valor;

    function check(){

      for(var i = 0; i < <?=$qtd_usuarios_pesquisa?>; i++){

        x = document.getElementById("check-".concat(i));

        if(x != null){
          valor = document.getElementById("check-".concat(i)).checked;
          if(valor == true){
            document.getElementById("check-".concat(i)).checked = false;
            document.getElementById("btn-check").innerHTML = "<i class='bi bi-check'></i>Marcar"; 
          }else{
            document.getElementById("check-".concat(i)).checked = true;
            document.getElementById("btn-check").innerHTML = "<i class='bi bi-x'></i>Desmarcar"; 
          }
        }
      }
      
    }
  </script>


  <?php include_once 'footer.php'; ?>