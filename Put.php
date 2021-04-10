<?php
    include("connection.php");
    $nome = $_POST['nome_d'];
    $telefone = $_POST['telefone_d'];
    $id = $_POST['delete_id'];
    $sql = "UPDATE `dados` 
	SET `nome`='$nome',
	`telefone`='$telefone' WHERE ID=$id";
    if (mysqli_query($mysqli, $sql)) {
        echo json_encode(array("statusCode"=>200));
    } 
    else {
        echo json_encode(array("statusCode"=>201));
    }
    mysqli_close($mysqli);
?>