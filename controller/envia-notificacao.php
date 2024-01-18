<?php

        require '../model/conecta.php';
        require '../model/banco-usuario.php';
        require '../mail/envia-email.php';

        $assunto_pesquisa = 'Pesquisa de Satisfação';
        $qtd = $_POST['qtd'];
        $id_pesquisa = $_POST['id_pesquisa'];
        $titulo_pesquisa = $_POST['titulo'];
        $tempo_estimado = '3 min.';
        //$nome_usuario = $_POST['nome_usuario'];

        for($i = 0; $i < $qtd; $i++){
                $nome_usuario[$i] = $_POST["nome-$i"];
                $email[$i] = $_POST["email-$i"];
                $login[$i] = $_POST["login-$i"];
                $resp[$i] = $_POST["resp-$i"];

        if($email[$i] != '' || $resp[$i] != 1){

                if($nome_usuario[$i] != ''){
                        //$caixas .= "$email[$qtd];";
                        //$nome[$i] = $nome_usuario[$i];

                        $primeiro_nome = explode(" ", $nome_usuario[$i]);

                        echo $primeiro_nome[0].' - ';
                }

                        //$caixas .= "$email[$qtd];";
                        $caixa[$i] = $email[$i];

                        echo $caixa[$i].' - ';
                        echo $login[$i].'<br>';

                        if(mailNotificacao($assunto_pesquisa, $titulo_pesquisa, $caixa[$i], $primeiro_nome[0], $login[$i], $tempo_estimado)){
                                header("Location: ../usuarios-notificacao.php?p=$id_pesquisa&t=$titulo_pesquisa&msg=success");
                        }else{
                                header("Location: ../usuarios-notificacao.php?p=$id_pesquisa&t=$titulo_pesquisa&msg=erro-b");
                        }

                }else{
                        header("Location: ../usuarios-notificacao.php?p=$id_pesquisa&t=$titulo_pesquisa&msg=erro-b");
                }


        }

        /*
        while($qtd > 0){
                $email[$qtd] = $_POST["email-$qtd"];

                if($email[$qtd] != ''){
                        //$caixas .= "$email[$qtd];";
                        $caixas[$qtd] = "$email[$qtd];";
                }

                $qtd--;
        }
        */

        //echo $caixas;

        //$emails = 'ariel.santos@ceadis.org.br,ariel.santosti@gmail.com,ariel.santosti@outlook.com.br';


        //echo count($caixa).'<br>';
        //var_dump($caixa);

        //mailNotificacao($titulo_pesquisa, $email, $assunto_pesquisa);
?>
