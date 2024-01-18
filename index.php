<?php 
//phpinfo();

  include("controller/logica_usuario.php");
  usuarioEstaLogado();

  $http_host = $_SERVER['HTTP_HOST'];
  $server_port = $_SERVER['SERVER_PORT'];	
  $ip_server = explode(':',$http_host);
  $usuario = $_GET['user'];
  $key = $_GET['key'];

?>

<!DOCTYPE html>
<html lang="Pt-Br">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Portal Pesquisas</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/login.css" rel="stylesheet">

</head>

<body>

<?php if(isset($_SESSION["login"])) {
  
  header("Location: http://$http_host/painel-pesquisa/painel.php");
  
}else{
  ?>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">

                  <div class="d-flex justify-content-center">
                    <img class="d-flex align-items-center" src="assets/img/logo-ceadis.png" alt="" style="width: 150px">
                                   <!--<span class="d-none d-lg-block"> Pesquisas Ceadis</span>-->
      
                  </div>

                  <div class="d-flex justify-content-center">
                    
                    <p class="text-secondary d-none d-lg-block"><strong><em>Portal Pesquisas</em></strong></p>
      
                  </div>

                   <!--<h5 class="card-title text-center pb-0 fs-4">Login</h5> -->
                    <!--<p class="text-center small">Usuário e senha fornecidos pela equipe de Qualidade</p>-->

                    <?php if(isset($_GET["login"]) && $_GET["login"]==1){ ?>
                    <span class="text-success text-center small" id="alert">
                      <strong>Usuário logado com sucesso!
                        <a href="#" class="text-danger" onclick="fecharAlerta()">
                          <i class="ri-close-circle-line"></i>
                        </a>
                      </strong>
                    </span>
                     <?php } ?>

                    <?php if(isset($_GET["login"]) && $_GET["login"]==0){ ?>
                    <span class="text-danger text-center small" id="alert">
                      <strong>Login e senha invalidos ou perfil não finalizado! 
                        <a href="#" class="text-danger icon" onclick="fecharAlerta()"> 
                          <i class="ri-close-circle-line"></i>
                        </a>
                      </strong>
                    </span>
                    <?php } ?>

                    <?php if(isset($_GET["logout"])){ ?>
                    <span class="text-success text-center small" id="alert">
                      <strong> Deslogado com sucesso! 
                      <a href="#" class="text-success icon" onclick="fecharAlerta()"> 
                          <i class="ri-check-double-line"></i>
                        </a>
                      </strong>
                    </span>
                    <?php } ?>

                    <?php if(isset($_GET["falhaDeSeguranca"])){ ?>
                    <span class="text-danger text-center small" id="alert">
                      <strong>Você não tem acesso a está página!
                      <a href="#" class="text-danger icon" onclick="fecharAlerta()"> 
                          <i class="ri-close-circle-line"></i>
                        </a>
                      </strong>
                    </span>
                    <?php } ?>

                    <?php if(isset($_GET["msg"]) && $_GET["msg"]=='false' && isset($_GET["s"])){ ?>
                    <span class="text-danger text-center small" id="alert">
                      Não foi possível enviar a sua nova senha pelo e-mail.<br>
                      <strong>Senha provisória: <?=$_GET['s']?>
                        <a href="#" class="text-danger icon" onclick="fecharAlerta()"> 
                          <i class="ri-close-circle-line"></i>
                        </a>
                      </strong>
                    </span>
                    <?php } ?>

                    <?php if(isset($_GET["msg"]) && $_GET["msg"]=='true'){ ?>
                    <span class="text-success text-center small" id="alert">
                      <strong>Sua nova senha provisória foi enviada para o e-mail cadastrado!
                        <a href="#" class="text-success icon" onclick="fecharAlerta()"> 
                          <i class="ri-check-double-line"></i>
                        </a>
                      </strong>
                    </span>
                    <?php } ?>

                  </div>

                  <form class="row g-3 needs-validation" method="POST" action="controller/login.php" >

                    <div class="col-12">
                      <label for="login" class="form-label">Usuário</label>
                      <div class="input-group has-validation">
                        <!--<span class="input-group-text" id="inputGroupPrepend">@</span>-->
                        <input type="text" name="login" class="form-control" id="login" required>
                        <div class="invalid-feedback">Por favor, insira o usuário.</div>
                      </div>
                    </div>

                    <div class="col-12" style="width: 90%;">
                      <label for="senha" class="form-label">Senha</label>
                      <input type="password" name="senha" class="form-control" id="senha" required>
                      <i id="olho" style="margin-left:83%; margin-top:-30px; width: 25px; cursor: pointer; position: absolute;" class="bi bi-eye olho"></i>
                      <div class="invalid-feedback">Por favor, insira a senha.</div>
                    </div>

                    <div class="col-12">
                      <button class="btn w-100 btn-ceadis" type="submit">Acessar</button>
                    </div>

                    <div class="col-12">
                      <p class="small mb-0"><a href="recuperar-acesso.php">Esqueci minha senha!</a></p>
                    </div>

                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

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

    function fecharAlerta(){

      document.getElementById("alert").innerText = "";

    }

  </script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<?php } ?>