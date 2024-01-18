<?php

include_once 'model/conecta_portal.php';
include_once 'header.php';


verificaPerfil();

$login_user = $_GET['l'];

if(isset($_GET['msg']) && $_GET['msg'] == 'success'){
  $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert' style='width:80%'>
            <strong><center>A senha do usuário $login_user foi atualizada com sucesso!</center></strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}
if(isset($_GET['msg']) && $_GET['msg'] == 'erro'){
  $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='width:80%'>
            <strong><center>Não foi possível atualizar a senha do usuário $login_user!</center></strong>
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
                  <h5 class="card-title">Senhas Divergentes</h5>
                </div>
                
                <!--

                <div class="col">
                  <br>
                  <a href="cadastrar-usuario.php"><button type="button" class="btn btn-light btn-sm d-none d-sm-block btn-ceadis" style="margin-left: 70%;"><i class="bi bi-person-plus"></i> Cadastrar</button></a>
                  <a href="cadastrar-usuario.php"><button type="button" class="btn btn-light d-block d-sm-none btn-ceadis" style="margin-left: 75%;"><i class="bi bi-person-plus"></i></button></a>
                  <br>
                </div>

                -->

              </div>

              <div class='row alert alert-danger alert-dismissible fade show' role='alert' style='width:70%'>
            <strong>Essa tela apresenta todos os usuários que tem <u>divergência de senha entre Portal Pesquisas e Portal Ceadis</u>, portanto tenha certeza de que a senha do colaborador deve ser atualizada! <a href="hash-portais.php" target="_blank"><i class="bi bi-info-circle"></i></a></strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>

              <!--<p>Abaixo estão todos os uauários!</p> -->

              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table table-sm datatable">
                <thead>
                  <tr>
                   <!-- <th scope="col">Nome</th> -->
                    <th scope="col">Login</th>
                   <!-- <th scope="col">E-mail</th> -->
                   <!-- <th scope="col">Unidade</th>-->
                   <!-- <th scope="col">Ativo</th> -->
                    <th scope="col">Atualiza Senha</th>
                   <!-- <th scope="col">Ações</th> -->
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
                  $senha_user = $u['senha'];
                  //$codigo_unidade = $u['codigo'];
                  $ativo_user = $u['ativo'];
                  $troca_senha_user = $u['troca_senha']; 

                  //BUSCA TODOS OS USUÁRIOS ATIVOS DO PORTAL
                  $result = $conn_portal->query("SELECT * FROM public.user_usuario WHERE isativo = true and login = '{$login_user}' and senha != '{$senha_user}' ORDER BY login ASC");
                      
                  //CRIANDO UM ARRAY
                  $usuarios = array();
                  
                  //SE EXISTIR RETORNO NO SELECT AVANÇA
                  if($result){   
                        
                      $i = 0;
                      foreach($result as $row){

                          #echo "Id: $row[id_user]<br>";
                          $usuarios[$i]["nome"] = $row['nome'];
                          $usuarios[$i]["email"] = $row['email'];
                          $usuarios[$i]["login"] = $row['login'];
                          $usuarios[$i]["senha"] = $row['senha'];
                          $usuarios[$i]["ativo"] = $row['isativo'];

                        //TODOS OS USUÁRIOS FORAM SALVOS NO ARRAY

                        //echo '<strong style="color:blue">Portal Ceadis:</strong> '.$usuarios[$i]["login"].' - '.$usuarios[$i]["senha"].'<br>';
                        //echo '<strong style="color:green">Portal Pesquisa:</strong> '.$login_user.' - '.$senha_user.'<br><br>';

                        //if(alteraSenhaUsuario($conn, $usuarios[$i]["login"], $usuarios[$i]["senha"])){
                          //   echo 'Senha alterada com sucesso!';
                        //}            
                          ?>
                        <tr>
                        <!--<td><?=$nome_user?></td>-->
                        <td><?=$login_user?></td>
                        <!--<td><?=$email_user?></td>-->
                        <!--<td><?=$referencia_unidade?></td>-->
                        <!--<td><?=$ativo_user?></td>-->
                        <!--<td><?=$troca_senha_user?></td>-->
                        <td><a href="controller/atualiza-senha-portal.php?l=<?=$usuarios[$i]["login"]?>&s=<?=$usuarios[$i]["senha"]?>"><button type="button" class="btn btn-sm btn-danger" ><i class="bi bi-arrow-left-right"></i></button></a></td>
                    </tr>

                    <?php
                        $i++;
                      }
                      
                  }

                  ?>
                
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