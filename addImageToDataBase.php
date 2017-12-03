<?php
    declare(strict_types=1);
    require_once("dbLogin.php");


     $db_connection = new mysqli($host,$user,$password,$database);
     if ($db_connection->connect_error) {
          die($db_connection->connect_error);
     }

    if(isset($_POST['email']) && isset($_POST['file']) && isset($_POST['table'])){
        $email = $_POST['email'];
        $file = $_POST['file'];
        $table = $_POST['table'];



    }
    $db_connection->close();



?>