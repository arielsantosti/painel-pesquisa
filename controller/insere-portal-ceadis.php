<?php
    
    include '../model/conecta_portal.php';

    $data = date("Y-m-d H:i:s");
    $login = $_GET['login'];
    $id = $_GET['id'];

    if(!isset($login)){
        header("Location: ../painel.php?p=nao-salva");
    }
    if(!isset($id)){
        header("Location: ../painel.php?p=nao-salva");
    }
    
    //BUSCA TODOS OS USUÁRIOS ATIVOS DO PORTAL
    $result = $conn_portal->query("SELECT * FROM public.cead_usuarios_pesquisa_de_qualidade WHERE id = '$id' or login = '$login'");

    //CRIANDO UM ARRAY
    $usuarios = array();
    
    //SE EXISTIR RETORNO NO SELECT AVANÇA
    if($result == true){   
            
        //$i = 0;
        foreach($result as $row){

            #echo "Id: $row[id_user]<br>";
            echo $usuarios[0]["id"] = $row['id'].' - ';
            echo $usuarios[0]["login"] = $row['login'].' - ';
            echo $usuarios[0]["data"] = $row['data'].'<br><br>';

            //var_dump($row);

            echo 'O registro de id ou login já existe!<br><br>';
           header("Location: ../painel.php?p=nao-salva");

        }
        
    }
    //var_dump($usuarios);
   // if($usuarios = ''){

            $resultado = $conn_portal->query("INSERT INTO public.cead_usuarios_pesquisa_de_qualidade (id, login, data) VALUES ('$id', '$login', '$data')");

            if($resultado == true){
                echo 'Tudo certo, salvo!';
                header("Location: ../painel.php?p=resposta-salva");
        
            }else{
                echo 'O registro de id ou login já existe 2!<br><br>';
                header("Location: ../painel.php?p=nao-salva");
            }     
/*
            //BUSCA TODOS OS USUÁRIOS ATIVOS DO PORTAL
    $result = $conn_portal->query("SELECT * FROM public.cead_usuarios_pesquisa_de_qualidade ORDER BY data ASC");

    //CRIANDO UM ARRAY
    $usuarios = array();
    
    //SE EXISTIR RETORNO NO SELECT AVANÇA
    if($result){   
            
       //$i = 0;
        foreach($result as $row){

            #echo "Id: $row[id_user]<br>";
            echo $usuario[$i]["login"] = $row['login'].' - ';
            echo $usuario[$i]["data"] = $row['data'].'<br>';

        }
        
    } */

   // echo date("Y-m-d H:i:s");

?>