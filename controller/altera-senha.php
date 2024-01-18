<?php
	
	require '../model/conecta.php';
	require '../model/banco-usuario.php';
	#require 'envia-senha.php';
	
	$login = $_POST['login'];
	$senha = $_POST['senha'];

	//$pagina = $_POST['pagina'];

	$resultado = alteraSenhaUsuario($conn, $login, $senha);

		if ($resultado == true){
			
				//var_dump($resultado);
				header("Location:../perfil-usuario.php?msg=success");

			}else{
				
				//var_dump($resultado);
				header("Location:../perfil-usuario.php?msg=error");
				
			}
			
?>