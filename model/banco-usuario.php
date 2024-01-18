<?php

// Logon de usuário geral
function buscaUsuario($conn, $login, $senha){

    $senhaSha1 = sha1($senha);
    $sql = $conn->prepare("SELECT * FROM tb_usuario where login='{$login}' and senha='{$senhaSha1}' and ativo=1");
    $sql->execute();

    $resultado = $sql->fetchAll();
   
    return($resultado);
    
}


function buscaTodosUsuarios($conn){
    $sql = $conn->prepare("SELECT * FROM tb_usuario");
    $sql->execute();

    $resultado = $sql->fetchAll();
   
    return($resultado);
    
} 


function buscaTodasUnidades($conn){
    $sql = $conn->prepare("SELECT * FROM tb_unidade");
    $sql->execute();

    $resultado = $sql->fetchAll();
   
    return($resultado);
    
} 

function buscaUsuarioUnidade($conn, $id_user){

    $sql = $conn->prepare("SELECT * FROM tb_usuario_unidade a INNER JOIN tb_unidade b ON a.cod_unidade = b.codigo WHERE a.id_usuario = '{$id_user}'");
    $sql->execute();

    $resultado = $sql->fetchAll();
   
    return($resultado);
    
}

function buscaUsuarioPerfil($conn, $login){

    $sql = $conn->prepare("SELECT * FROM tb_usuario_perfil a INNER JOIN tb_perfil b ON a.id_perfil = b.id_perfil 
                                                             INNER JOIN tb_usuario u ON a.login = u.login WHERE a.login='{$login}'");
    $sql->execute();

    $resultado = $sql->fetchAll();
   
    return($resultado);
    
}

function consultaEmail($conn, $email){

    $sql = $conn->prepare("SELECT * FROM tb_usuario WHERE email = '{$email}'");
    $sql->execute();
    $resultado = $sql->fetchAll();
   
    return($resultado);
}

function recuperaSenhaUsuario($conn, $email, $senha){
    
	$senhaSha1 = sha1($senha);
	$sql = $conn->prepare("UPDATE tb_usuario SET senha = '$senhaSha1', troca_senha = 1 WHERE email = '$email'");
    $sql->execute();
    
    return;
}

function alteraSenhaUsuario($conn, $login, $senha){
	$senhaSha1 = sha1($senha);
	$sql = $conn->prepare("UPDATE tb_usuario SET senha = '$senhaSha1', troca_senha = 0 WHERE login = '$login'");
    $sql->execute();
    
    return TRUE;
}

function editaUsuario($conn, $id_user, $login, $email, $ativo, $perfil, $codigo_unidade){
    
	$sql = $conn->prepare("UPDATE tb_usuario SET email = '$email', ativo = '$ativo' WHERE login = '$login'");
    $sql->execute();

    editaPerfilUsuario($conn, $login, $perfil);
    editaUnidadeUsuario($conn, $id_user, $codigo_unidade);
    
    return TRUE;
}

function editaPerfilUsuario($conn, $login, $perfil){
    
	$sql = $conn->prepare("UPDATE tb_usuario_perfil SET id_perfil = '$perfil' WHERE login = '$login'");
    $sql->execute();
    
    return TRUE;
}

function editaUnidadeUsuario($conn, $id_user, $codigo_unidade){
    
    $sql = $conn->prepare("DELETE FROM tb_usuario_unidade where id_usuario = {$id_user}");
    $sql->execute();
    
	$sql = $conn->prepare("INSERT INTO `tb_usuario_unidade` (`id_usuario`, `cod_unidade`) VALUES ('$id_user','$codigo_unidade')");
    $sql->execute();
    
    return TRUE;
}

function adicionaUsuario($conn, $nome, $login, $senha, $email, $cod_unidade, $ativo, $perfil) {
    $senhaMD5 = sha1($senha); 
    $sql = $conn->prepare("INSERT INTO `tb_usuario` (`nome`, `login`, `senha`, `email`, `ativo`, `troca_senha`) VALUES ('$nome', '$login', '$senhaMD5', '$email', '$ativo', 1)");
    $sql->execute();

    adicionaPerfilUsuario($conn, $login, $perfil);
    adicionaUnidadeUsuario($conn, $login, $cod_unidade);

    return TRUE;
}

function adicionaPerfilUsuario($conn, $login, $perfil){
    
	$sql = $conn->prepare("INSERT INTO `tb_usuario_perfil` (`login`, `id_perfil`) VALUES ('$login','$perfil')");
    $sql->execute();
    
    return TRUE;
}

function adicionaUnidadeUsuario($conn, $login, $cod_unidade){
    
    $sql = $conn->prepare("SELECT id_usuario FROM tb_usuario where login = '{$login}'");
    $sql->execute();
    $resultado = $sql->fetchAll();

    foreach($resultado as $r){ $id_usuario = $r['id_usuario'];}

	$sql = $conn->prepare("INSERT INTO `tb_usuario_unidade` (`id_usuario`, `cod_unidade`) VALUES ('$id_usuario','$cod_unidade')");
    $sql->execute();
    
    return TRUE;
}

//ATUALIZA SENHA DO USUÁRIO DE ACORDO A DO PORTAL
function atualizaSenhaUsuarioPortal($conn, $login, $senha){
	$sql = $conn->prepare("UPDATE tb_usuario SET senha = '$senha' WHERE login = '$login'");
    $sql->execute();
    
    return TRUE;
}

/*
function editaUltimoAcessoClienteEspecial($conn, $id, $nome, $ultimoAcesso){
	$query = "UPDATE empresas SET ultimoAcesso='$ultimoAcesso' WHERE id = '$id' and nome = '$nome'";
	return mysqli_query($conn, $query);
}

function editaUltimoAcessoCliente($conn, $empresa, $email, $ultimoAcesso){
	$query = "UPDATE usuarios_empresas SET ultimoAcesso='$ultimoAcesso' WHERE empresa = '$empresa' and email = '$email'";
	return mysqli_query($conn, $query);
}

function listaPerfil($conn, $email, $nome_usuario, $cnpj) {
    $usuarios = array();
    $resultado = mysqli_query($conn, "select * from empresas where email = '{$email}' and nome = '{$nome_usuario}' and cnpj = '{$cnpj}'");

    while($usuario = @mysqli_fetch_assoc($resultado)) {
        array_push($usuarios, $usuario);
    }

    return $usuarios;
}

function editaSenhaEmpresa($conn, $id, $nome, $senha, $mostraLogo, $editaAntes){
	$query = "UPDATE empresas SET senha='$senha', mostraLogo='$mostraLogo', edtAntImp='$editaAntes' WHERE id = '$id' and nome = '$nome'";
	return mysqli_query($conn, $query);
}
/*
function insereImgEmpresa($conn, $email, $nome, $img){
	$query = "INSERT INTO empresas (logotipo) VALUES ('$img') where email = '$email' and nome = '$nome'";
	return mysqli_query($conn, $query);
}


function insereLogoEmpresa($conn, $id, $logo){
	$query = "UPDATE empresas SET logotipo = '$logo' WHERE id = '$id'";
	return $resultado = mysqli_query($conn, $query);
}



function buscaUsuarioCliente($conn, $email, $senha) {
    $senhaMd5 = md5($senha);
    $query = "select * from usuarios_empresas where email='{$email}' and senha='{$senhaMd5}' and status='1'";
    $resultado = mysqli_query($conn, $query);
    $usuario = mysqli_fetch_assoc($resultado);
    return $usuario;
}

// Funções para usuário de empresas

function adicionaUsuario($conn, $cnpj, $editaEtq, $empresa, $nome, $email, $senha, $status) {
    $senhaMD5 = md5($senha); 
    $query = "INSERT INTO `usuarios_empresas`(`cnpj`, `editaEtq`, `empresa`, `nome`, `email`, `senha`, `permissao`, `status`) VALUES ('$cnpj', '$editaEtq', '$empresa', '$nome', '$email', '$senhaMD5', 0, '$status')";
    return mysqli_query($conn, $query);
}

function editaUsuario($conn, $id, $editaEtq, $nome, $senha, $status, $mostraLogo){
	$query = "UPDATE usuarios_empresas SET editaEtq='$editaEtq', nome='$nome', senha='$senha', status = '$status', mostraLogo = '$mostraLogo' WHERE id = '$id'";
	return mysqli_query($conn, $query);
}

function removeUsuario($conn, $id){
    $query = "delete from usuarios_empresas where id = {$id}";
    return mysqli_query($conn, $query);
}

function listaUsuarios($conn, $cnpj) {
    $usuarios = array();
    $resultado = mysqli_query($conn, "select * from usuarios_empresas where cnpj = '{$cnpj}'");

    while($usuario = @mysqli_fetch_assoc($resultado)) {
        array_push($usuarios, $usuario);
    }

    return $usuarios;
}

function listaUsuariosParaAdmin($conn) {
    $usuarios = array();
    $resultado = mysqli_query($conn, "select * from usuarios_empresas");

    while($usuario = mysqli_fetch_assoc($resultado)) {
        array_push($usuarios, $usuario);
    }

    return $usuarios;
}

*/

?>
