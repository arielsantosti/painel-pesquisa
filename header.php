<?php 

  $ip_usuario = $_SERVER['REMOTE_ADDR'];
  $http_host = $_SERVER['HTTP_HOST'];
  $ip_server = explode(':',$http_host);
  $server_port = $_SERVER['SERVER_PORT'];
  $pagina = $_SERVER['PHP_SELF'];	
  $http_porta = ":8000";
  $usuario = $_GET['user'];
  $key = $_GET['key'];

  include("controller/logica_usuario.php");
  verificaUsuario();

  $id = $_SESSION['id'];
  $login = $_SESSION['login'];
  $perfil = $_SESSION['perfil'];
  $nome = $_SESSION['nome'];
  $email = $_SESSION['email'];
  $troca_senha = $_SESSION['troca_senha'];
  $ativo = $_SESSION['ativo'];
  $unidade = $_SESSION['unidade'];

$iphone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
$ipad = strpos($_SERVER['HTTP_USER_AGENT'], "iPad");
$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'], "webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
$symbian = strpos($_SERVER['HTTP_USER_AGENT'], "Symbian");
$windowsphone = strpos($_SERVER['HTTP_USER_AGENT'], "Windows Phone");

if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian || $windowsphone == true) {
  $dispositivo = "mobile";
  $ativaMenu = "";

} else {
  $dispositivo = "computador";
  $ativaMenu = "toggle-sidebar";

}

  include_once('model/conecta.php');
  include_once('model/banco-usuario.php');
  include_once('model/banco-unidade.php');
  include_once('model/banco-pesquisa.php');

  $oculta = 'hidden';
  $acaoMenu = 'toggle-sidebar-btn';

 if($perfil == 'ADM'){
    $oculta = '';
  }

?>

<!DOCTYPE html>
<html lang="Pt-Br">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ceadis - Portal Pesquisas</title>

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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/login.css" rel="stylesheet">

</head>

<!--<body class="toggle-sidebar"> -->
  <body class="<?=$ativaMenu?>">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center" style="margin-bottom: 60px;">

    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center <?=$acaoMenu?>">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Portal Pesquisas</span>
      </a>
      <!--<i class="bi bi-list toggle-sidebar-btn"></i>-->
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!--<img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
            <span class="dropdown-toggle ps-2"><?=$login?></span>
          </a>
          
          <!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?=$login?></h6>
              <span><?=$perfil?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="perfil-usuario.php">
                <i class="bi bi-person"></i>
                <span>Meu perfil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="controller/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sair</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
  <br>

  <!-- ======= Sidebar ======= -->

  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="painel.php">
          <i class="bi bi-grid-fill"></i>
          <span>Painel Pesquisas</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="usuarios.php" <?=$oculta?>>
          <i class="bi bi-person-fill"></i>
          <span>Usuários</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="unidades.php" <?=$oculta?>>
          <i class="bi bi-geo-alt-fill"></i>
          <span>Unidades</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="notificacao.php" <?=$oculta?>>
          <i class="bi bi-megaphone-fill"></i>
          <span>Notificação</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="senhas-divergentes.php" <?=$oculta?>>
          <i class="bi bi-arrow-left-right"></i>
          <span>Senha Divergente</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->
