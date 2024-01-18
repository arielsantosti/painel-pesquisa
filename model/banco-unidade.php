<?php

function buscaTodosUnidades($conn){
    $sql = $conn->prepare("SELECT * FROM tb_unidade");
    $sql->execute();

    $resultado = $sql->fetchAll();
   
    return($resultado);
    
} 

?>
