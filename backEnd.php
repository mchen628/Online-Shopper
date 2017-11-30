<?php
    declare(strict_types=1);
    require_once("dbLogin.php");

    class Item {
        private $name, $price, $link;
        function __construct(string $name, float $price, string $link){
            $this->name = $name;
            $this->price = $price;
            $this->link = $link;
        }
        function getName(){
            
            return $this->name;
        }
        function getPrice(){
            return $this->price;
        }
        function getLink(){
            return $this->link;
        }
        function setName($name){
            $this->name =$name;
            
        }
        function setPrice($price){
            $this->price = $price;
        }
        function setLink($link){
            $this->link = $link;
        }
        function toString(){
            return $this->name.",".$this->price.",".$this->link;
        }
    }
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
        $obj = serialize($objItem);
        $toTable = $_POST['table'];
        $sqlQuery = $db_connection->prepare("insert into $toTable (email, obj) values (?,?)");
        $sqlQuery->bind_param("ss", $email, $obj);
        $result = $sqlQuery->execute();
        if (!$result) {
            die("Insertion failed: " . $sqlQuery->error);
        }
        echo $objItem->toString();
        $db_connection->close();
    }



?>