<!DOCTYPE html>
<html lang="Pt-Br">

  <?php

  include 'model/conecta.php';
	include 'model/banco-usuario.php';
  include 'controller/logica_usuario.php';

  verificaUsuario();

	$http_host = $_SERVER['HTTP_HOST'];
	$server_port = $_SERVER['SERVER_PORT'];	
	$http_porta = 8000;
	$usuario = $_GET['user'];
	$key = $_GET['key'];

  $usuarioLogado = $_SESSION["login"];

?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pesquisas Ceadis</title>

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
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"> Pesquisas Ceadis</span>
                </a>
              </div>

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Alterar senha</h5>
                    <!--<p class="text-center small">Usuário e senha fornecidos pela equipe de Qualidade</p>-->

                    <?php if(isset($_GET["login"]) && $_GET["login"]==1){ ?>
                    <span class="text-success text-center small">Usuário logado com sucesso!</span> <?php } ?>

                    <?php if(isset($_GET["msg"]) && $_GET["msg"]=='erro'){ ?>
                    <span class="text-danger text-center small">  E-mail não cadastrado na base do Portal Pesquisa! </span> <?php } ?>

                    <?php if(isset($_GET["msg"]) && $_GET["msg"]=='false'){ ?>
                    <span class="text-danger text-center small" > Não foi possível enviar a sua nova senha pelo e-mail. <br>Senha: <?=$_GET['s']?> </span> <?php } ?>

                  </div>

                  <form class="row g-3 needs-validation" method="POST" action="controller/altera-senha.php" >

                    <div class="col-12">
                    <input type="text" name="login" class="form-control invisible" id="login" value=<?=$usuarioLogado?>>
                      <label for="senha" class="form-label">Nova senha</label>
                      <div class="input-group has-validation">
                        
                        <div style="width: 90%;">
                        <input type="password" name="senha" class="form-control" id="senha" minlength="3" required>
                        
                        <i id="olho" style="margin-left:92%; margin-top:-30px; width: 25px; cursor: pointer; position: absolute;" class="bi bi-eye olho"></i>
                        </div>

                        <div class="invalid-feedback">Por favor, insira a nova a senha.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-ceadis w-100 " type="submit">Alterar</button>
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
  </script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
