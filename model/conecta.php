<?php
    
    date_default_timezone_set('America/Sao_Paulo');

    $user = 'root';
	$password = 'C34d15T12023*';
	$tipobanco = 'mysql';
	$database = 'pesquisas';
	$server =  'localhost';
    $port = '3306';

    try{
        //instancia objeto PDO, conectando no MySQL
        $conn = new PDO("$tipobanco:host=$server;port=$port;dbname=$database", "$user", "$password");
        //print_r($conn);

    }
    catch(PDOException $e){
        // caso ocorra uma exceção, exibe na tela
        print "Erro: " . $e->getMessage() . "\n";
    }
