<?php
  include('./model/conecta.php');
  include("./model/banco-etiqueta.php");
  include("./controller/logica_usuario.php");

  verificaUsuario();

var_dump($_SESSION);
?>