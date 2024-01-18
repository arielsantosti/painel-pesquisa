<?php

  //INICIA UMA SESSÃO
  session_start();

  function usuarioEstaLogado() {

    return isset($_SESSION['login']);

  }
  
  function verificaUsuario(){
  	if(!usuarioEstaLogado()){

     Header("Location: ../painel-pesquisa/index.php?falhaDeSeguranca=true");

     die();
     }
   }

   function verificaPerfil(){

    $http_host = $_SERVER['HTTP_HOST'];

    if($_SESSION['perfil'] != 'ADM'){

      echo "<script> window.location.href = 'http://$http_host'; </script>";

      //Header("Location: http://$http_host");

      die();

    }
   }

function usuarioLogado() {

    return $_SESSION["login"];

}

function logaUsuario($id, $nome, $login, $email, $ativo, $troca, $perfil, $unidade) {

  $_SESSION['id_usuario'] = $id;
  $_SESSION['nome'] = $nome;
  $_SESSION['login'] = $login;
  $_SESSION['email'] = $email;
  $_SESSION['ativo'] = $ativo;
  $_SESSION['troca_senha'] = $troca;
  $_SESSION['perfil'] = $perfil;
  $_SESSION['unidade'] = $unidade;

}

function logout(){

	session_destroy();

}