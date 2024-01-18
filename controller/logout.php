<?php 
include("logica_usuario.php");
logout();
header("Location: ../index.php?logout=true");
die();
?>