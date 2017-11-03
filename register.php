<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="general.css"/>
    </head>
    <body>
        <?php
            require_once("support.php");
			require_once("dbLogin.php");
            
            $body = <<<EBODY
                <form action="{$_SERVER['PHP_SELF']}" method="post">
                    Username: <input type="text" name="username" required><br><br>
                    Email: <input type="email" name="email" required><br><br>
                    Password: <input type="password" name="password" required><br><br>
                    Verify password : <input type="password" name="vpassword" required><br><br>
                    <div id="buttonHolder">
                        <input type="submit" name="submit" value="Sumbit"/>
                </form>
                <form action="login.php">
                        <input type="submit" value="Return to login page"/>
                    </div>
				</form>
EBODY;

            if(isset($_POST['submit'])) {
                
                session_start();
				 
                $db_connection = new mysqli($host,$user,$password,$database);
                if ($db_connection->connect_error) {
                    die($db_connection->connect_error);
                }
                           
                $sqlQuery = $db_connection->prepare("insert into $table (username, password, email) values (?,?,?)");
                if($sqlQuery == false){//prepare statement failed
                    die("Insertion failed");
                }           
                else {//put the user data into database
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    
                    if(password_verify($_POST['vpassword'], $hashed)){//verify the password
                        $sqlQuery->bind_param("sss", $username, $hashed, $email);
                        $sqlQuery->execute();
                    }else{
                        //password is different
                    }
                }
                $db_connection->close();
            }
            echo generatePage($body, $title = "Register");
        ?>
    </body>
</html>