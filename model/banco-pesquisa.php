<?php

function buscaTodasPesquisas($conn){
    $sql = $conn->prepare("SELECT * FROM tb_pesquisa");
    $sql->execute();

    $resultado = $sql->fetchAll();
   
    return($resultado);
    
} 

function buscaPesquisa($conn, $id_pesquisa){
    $sql = $conn->prepare("SELECT * FROM tb_pesquisa WHERE id_pesquisa = '{$id_pesquisa}'");
    $sql->execute();

    $resultado = $sql->fetchAll();
   
    return($resultado);
    
}

function buscaUsuariosPesquisa($conn, $id_pesquisa){
    $sql = $conn->prepare("SELECT * FROM tb_usuario_pesquisa p 
                                        INNER JOIN tb_usuario us ON p.login = us.login 
                                        INNER JOIN tb_usuario_unidade usn ON us.id_usuario = usn.id_usuario
                                        INNER JOIN tb_unidade un ON usn.cod_unidade = un.codigo
                                        WHERE id_pesquisa = '{$id_pesquisa}' ORDER BY us.login ASC");
    $sql->execute();

    $resultado = $sql->fetchAll();
   
    return($resultado);
    
} 

?>
