<?php
    include("connection.php");
    //$conexao =mysqli_connect('localhost:3306', 'root', '','agenda') or die("initial host/db connection problem");
    $sqlInsert = $mysqli->prepare("INSERT INTO dados (nome,telefone) VALUES ('".$_POST['nome']."','".$_POST['telefone']."')"); 

    $sqlInsert->execute();
    
    echo mysqli_error($mysqli);
    if($sqlInsert == true){
        echo 'Cadastrado com sucesso!';
    }else{
        echo 'Houve um erro ao cadastrar!';
    }
?>