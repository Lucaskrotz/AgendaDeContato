<?php

session_start();

include_once("connection.php");
include_once("url.php");

$data = $_POST;
// modificações no banco
if(!empty($data)) {


    //criar contato

    if($data["type"] === "create") {
        $name =  $data["name"];
        $phone =  $data["phone"];
        $observations =  $data["observations"];

        $query = "INSERT INTO contacts (name, phone , observations) VALUES (:name, :phone, :observations)";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":observations", $observations);

        try{

            $stmt->execute();
            $_SESSION["msg"] = "Contato criado com sucesso!";

        } catch(PDOException $e) {
            // erro conexao
            $error = $e->getMessage();
            echo "Erro: $error";
        }
    } else if($data["type"] === "edit") {

        $name =  $data["name"];
        $phone =  $data["phone"];
        $observations =  $data["observations"];
        $id =  $data["id"];

        $query = "UPDATE contacts SET name = :name, phone = :phone, observations = :observations WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":observations", $observations);
        $stmt->bindParam(":id", $id);

        try{

            $stmt->execute();
            $_SESSION["msg"] = "Contato Editado/Atualizado com Sucesso!";

        } catch(PDOException $e) {
            // erro conexao
            $error = $e->getMessage();
            echo "Erro: $error";
        }
        
    } else if($data["type"] === "delete") {

        $id = $data["id"];

        $query = "DELETE FROM contacts WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id", $id);

        try{

            $stmt->execute();
            $_SESSION["msg"] = "Contato Removido com Sucesso!";

        } catch(PDOException $e) {
            // erro conexao
            $error = $e->getMessage();
            echo "Erro: $error";
        }
    }

    //redirect home

    header("Location:" . $BASE_URL . "../index.php");

    //selecao de dados
} else {

    if(!empty($_GET)) {
        $id = $_GET["id"];
    }

    //retorna o dado de um contato
    if(!empty($id)) {

        $query = "SELECT * FROM contacts WHERE id = :id";

        $stmt =$conn->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $contacts = $stmt->fetch();


    } else {
        //retorna todos os contatos
        $contacts = [];

        include_once("connection.php");
        include_once("url.php");

        $query = "SELECT * FROM contacts";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $contacts = $stmt->fetchAll();
    }

}

//fechar conexão

$conn = null;





