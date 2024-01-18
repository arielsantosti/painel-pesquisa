<?php
    
    include 'conecta_portal.php';
    include 'banco-usuario.php';
    //include 'atualiza_usuarios_pesquisas.php';
    include_once 'conecta.php';
    
    $resultado = buscaTodosUsuarios($conn);

    //var_dump($resultado);

    foreach($resultado as $r){

        $usuarioAtivo = $r['ativo'];
        $usuarioSenha = $r['senha'];
        $usuarioLogin = $r['login'];

        //BUSCA TODOS OS USUÁRIOS ATIVOS DO PORTAL
        $result = $conn_portal->query("SELECT * FROM public.user_usuario WHERE isativo = true and login = '{$usuarioLogin}' and senha = '{$usuarioSenha}' ORDER BY login ASC");
            
        //CRIANDO UM ARRAY
        $usuarios = array();
        
        //SE EXISTIR RETORNO NO SELECT AVANÇA
        if($result){   
              
            $i = 0;
            foreach($result as $row){

                #echo "Id: $row[id_user]<br>";
                $usuarios[$i]["nome"] = $row['nome'];
                $usuarios[$i]["email"] = $row['email'];
                $usuarios[$i]["login"] = $row['login'];
                $usuarios[$i]["senha"] = $row['senha'];
                $usuarios[$i]["ativo"] = $row['isativo'];

               //TODOS OS USUÁRIOS FORAM SALVOS NO ARRAY

               echo '<strong style="color:blue">Portal Ceadis:</strong> '.$usuarios[$i]["login"].' - '.$usuarios[$i]["senha"].'<br>';
               echo '<strong style="color:green">Portal Pesquisa:</strong> '.$usuarioLogin.' - '.$usuarioSenha.'<br><br>';

               //if(alteraSenhaUsuario($conn, $usuarios[$i]["login"], $usuarios[$i]["senha"])){
                 //   echo 'Senha alterada com sucesso!';
               //}            

               $i++;
            }
            
        }
                //ARMAZENA NA VARIÁVEL QTD A QUANTIDADE DE LINHAS NO ARRAY
               // $qtd = count($usuarios);
    }

       // echo '<br> Quantidade: '.$qtd;

        $conn_portal = null;
        
        
        
?>