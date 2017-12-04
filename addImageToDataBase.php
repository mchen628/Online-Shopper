<?php
    declare(strict_types=1);
    require_once("dbLogin.php");


     $db_connection = new mysqli($host,$user,$password,$database);
     if ($db_connection->connect_error) {
          die($db_connection->connect_error);
     }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $file = $_FILES["image"]["name"];


        $name = $_FILES["image"]["name"];
          $target_dir = "upload/";
          $target_file = $target_dir.basename($file);

          // Select file type
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

          // Valid file extensions
          $extensions_arr = array("jpg","jpeg","png","gif");

          // Check extension
          if( in_array($imageFileType,$extensions_arr) ){

               // Convert to base64
               $image_base64 = base64_encode(file_get_contents($file));
               $image = "data:image/".$imageFileType.";base64,".$image_base64;

               // Insert record
               $query = "UPDATE carts SET picture='".$image."' WHERE email='".$email."'";
               mysqli_query($db_connection,$query) or die(mysqli_error($db_connection));
           }
         echo $image;
    }
    $db_connection->close();



?>