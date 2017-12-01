<?php
    declare(strict_types=1);
    require_once("dbLogin.php");
    require("itemClass.php");

    if(isset($_POST['item'])){
        $item = $_POST['item'];
    }
    if(isset($_POST['price'])){
        $price = $_POST['price'];
    }
    if(isset($_POST['link'])){
        $link = $_POST['link'];
    }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $db_connection = new mysqli($host,$user,$password,$database);
        if ($db_connection->connect_error) {
        	die($db_connection->connect_error);
        }
        $objItem = new Item ($item, floatval($price), $link);
        $toTable = $_POST['table'];
        $sqlQuery = $db_connection->prepare("SELECT obj FROM $toTable WHERE email=?");
        $sqlQuery->bind_param("s", $email);
        $sqlQuery->execute();
        $sqlQuery -> bind_result($objString);
        $sqlQuery -> fetch();
        if($objString != null){
            $objs = unserialize($objString);
            array_push($objs, $objItem);
            $obj = serialize($objs);
            $db_connection->query("UPDATE $toTable SET obj=$obj WHERE email=$email");
        }else{
            $objs = [];
            array_push($objs, $objItem);
            $obj = serialize($objs);
            $sqlQuery = $db_connection->prepare("INSERT INTO $toTable (email, obj) VALUES (?, ?)");
            $sqlQuery->bind_param("ss", $email, $obj);
            $sqlQuery->execute();

        }
        echo $objItem->toString();
        $db_connection->close();
    }



?>