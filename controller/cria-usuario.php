<?php
	
	require '../model/conecta.php';
	require '../model/banco-usuario.php';
	#require 'envia-senha.php';
	
	$nome = $_POST['nome'];
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	$email = $_POST['email'];
	$cod_unidade = $_POST['codigo_unidade'];
	$ativo = $_POST['ativo'];
	$perfil = $_POST['perfil'];

	if($ativo == 'on'){
		$ativo = 1;
	}else{
		$ativo = 0;
	}

	if($perfil == 'ADM' || '1'){
		$perfil = 1;
	  }
	  
	if($perfil == 'PESQUISAS' || '2'){
		$perfil = 2;
	  }

	//$pagina = $_POST['pagina'];

		if ($resposta = adicionaUsuario($conn, $nome, $login, $senha, $email, $cod_unidade, $ativo, $perfil)){
				
				header("Location:../usuarios.php?l=$login&msg=success");
				
			}else{
				
				header("Location:../usuarios.php?l=$login&msg=erro");
				
			}
			 
?>