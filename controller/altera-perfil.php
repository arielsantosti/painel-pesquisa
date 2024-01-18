<?php
	
	require '../model/conecta.php';
	require '../model/banco-usuario.php';
	#require 'envia-senha.php';
	
	$id_user = $_POST['id_user'];
	$login = $_POST['login'];
	$email = $_POST['email'];
	$ativo = $_POST['ativo'];
	$perfil = $_POST['perfil'];

	$codigo_unidade = $_POST['codigo_unidade'];

	if($ativo == 'on'){
		$ativo = 1;
	}else{
		$ativo = 0;
	}

	if($perfil == 'ADM' || $perfil == '1'){
		$perfil = 1;
	  }
	  
	if($perfil == 'PESQUISAS' || $perfil == '2'){
		$perfil = 2;
	  }

	//$pagina = $_POST['pagina'];

		if ($resposta = editaUsuario($conn, $id_user, $login, $email, $ativo, $perfil, $codigo_unidade)){
				
				header("Location:../edita-usuario.php?l=$login&msg=success");
				
			}else{
				
				header("Location:../edita-usuario.php?l=$login&msg=erro");
				
			}
			 
?>