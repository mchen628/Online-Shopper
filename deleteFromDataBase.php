<?php
    require_once("dbLogin.php");

        if(isset($_POST['item'])){
            $item = $_POST['item'];
        }
        if(isset($_POST['price'])){
            $price = $_POST['price'];
        }
        if(isset($_POST['email'])){
            $email = $_POST['email'];
            $db_connection = new mysqli($host,$user,$password,$database);
            if ($db_connection->connect_error) {
            	die($db_connection->connect_error);
            }
            $toTable = $_POST['table'];
            $sqlQuery = $db_connection->prepare("SELECT obj FROM $toTable WHERE email=?;");

            $sqlQuery->bind_param("s", $email);
            $sqlQuery->execute();
            $sqlQuery -> bind_result($objString);
            $sqlQuery -> fetch();
            if($objString != null){

                $objs = explode("^^^^",$objString);
                if(sizeof($objs) > 0 && $objs[0] != null){
                    for($i = 0; $i<sizeof($objs);$i++){
                        $data = explode(",",$objs[$i]);
                        if($data[0] == $item && $data[1] == $price){

                            unset($objs[$i]);
                        }
                    }
                }
                $obj = implode("^^^^", $objs);
                $sqlQuery->free_result();
                if(sizeof($objs) == 0){
                    $query = "DELETE FROM $toTable WHERE email="."\"".$email."\"";
                    mysqli_query($db_connection,$query) or die(mysqli_error($db_connection));
                }else{
                    $query = "UPDATE $toTable SET obj=\"".$obj."\" WHERE email=\"".$email."\"";
                     mysqli_query($db_connection,$query) or die(mysqli_error($db_connection));
                }
            }
            $db_connection->close();
        }

?>