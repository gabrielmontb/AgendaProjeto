<?php
    $mysqli =new mysqli('localhost:3306', 'root', '','agenda') or die("initial host/db connection problem");
    if($mysqli->connect_errno)
       echo "Falha na conexão (".$mysqli->connect_errno.") " .$mysqli->connect_error;
?>