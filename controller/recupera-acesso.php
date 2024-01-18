<?php
	
	require '../model/conecta.php';
	require '../model/banco-usuario.php';
	require '../mail/envia-email.php';
	//require 'envia-senha.php';
	
	$email = $_POST['email'];

		if ($resultado = consultaEmail($conn, $email)) {
			
			$nome = $resultado[0]['nome'];
			$login = $resultado[0]['login'];
			$assunto = "Redefinição de senha";

			//Gerando a nova senha com 4 digitos numericos
			$senha = rand(1000,9999);

			//Salvando a senha provisória no banco
			recuperaSenhaUsuario($conn, $email, $senha);

			if(mailReseteSenha($nome, $email, $login, $senha, $assunto)){

				header("Location:../index.php?msg=true");

			}else{

				header("Location:../index.php?msg=false&s=$senha");

			}	
			
		}else{header("Location:../recuperar-acesso.php?msg=erro");}

?>