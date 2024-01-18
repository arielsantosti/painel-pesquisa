<?php
	
	require '../model/conecta.php';
	require '../model/banco-usuario.php';
	#require 'envia-senha.php';
	
	$login = $_GET['l'];
	$senha = $_GET['s'];

	//$pagina = $_POST['pagina'];

		if(atualizaSenhaUsuarioPortal($conn, $login, $senha)){
				header("Location:../senhas-divergentes.php?l=$login&msg=success");
		}else{

			header("Location:../senhas-divergentes.php?msg=erro");
		}
								
?>