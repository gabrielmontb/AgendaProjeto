<?php
    include("connection.php");
    $id = $_POST['delete_id'];
    $query = mysqli_query($mysqli,"DELETE from dados WHERE id='$id'");  

?>