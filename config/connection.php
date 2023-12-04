<?php

    $host = "localhost";
    $db = "agenda2";
    $user = "root";
    $pass = "";


    try{

        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

        // Ativar ModO DE erros

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

    } catch(PDOException $e) {
        // erro conexao
        $error = $e->getMessage();
        echo "Erro: $error";
    }