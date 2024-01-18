<?php
    
    date_default_timezone_set('America/Sao_Paulo');

 	$user_p = 'ceadis';
	$password_p = 'ceadis2011';
	$tipobanco_p = 'pgsql';
	$database_p = 'ceadis';
	$server_p =  '172.22.0.105';
    #$port = '5432';

    try{
        //instancia objeto PDO, conectando no PostgreSQL
        $conn_portal = new PDO("$tipobanco_p:dbname=$database_p;user=$user_p;password=$password_p;host=$server_p");
        
    }
    catch(PDOException $e){
        // caso ocorra uma exceção, exibe na tela
        print "Erro: " . $e->getMessage() . "\n";
    }
    
?>