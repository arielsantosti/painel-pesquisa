<?php   

	include('../model/conecta.php');
  	include('../model/banco-usuario.php');
  	include('logica_usuario.php');

	  $http_host = $_SERVER['HTTP_HOST'];
	  $server_port = $_SERVER['SERVER_PORT'];	
	  $http_porta = 8080;
	  $usuario = $_GET['user'];
	  $key = $_GET['key'];

  	$resultado = buscaUsuario($conn, $_POST["login"], $_POST["senha"]);

	$id_usuario = $resultado[0]["id_usuario"];
	$nome = $resultado[0]["nome"];
	$login = $resultado[0]["login"];
	$email = $resultado[0]["email"];
	$ativo =  $resultado[0]["ativo"];
	$troca = $resultado[0]["troca_senha"];
	//$codigo = $resultado[0]["codigo"];

	$resultadoPerfil = buscaUsuarioPerfil($conn, $login);
	$perfil = $resultadoPerfil[0]['perfil'];

	$resultadoUnidadeUsuario = buscaUsuarioUnidade($conn, $id_usuario);
	$unidade = $resultadoUnidadeUsuario[0]['referencia'];

	if($resultado == null || $resultadoPerfil == null){

		header("Location: ../index.php?login=0");

	}else{

			if(logaUsuario($id_usuario, $nome, $login, $email, $ativo, $troca, $perfil, $unidade)){
				echo 'Certo';
			}else{echo 'Erro';}


			if($troca == '1'){
				header("Location: ../trocar-senha.php");
			}else{
				header("Location: http://$http_host/painel-pesquisa/painel.php");
			}

	}

	die();