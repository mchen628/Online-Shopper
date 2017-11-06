<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="general.css"/>
    </head>
    <body>
        <?php
            require_once("support.php");
			require_once("dbLogin.php");

            $body=<<<EBODY
                <form action="{$_SERVER['PHP_SELF']}" method="post">
                <fieldset>
                <h2>Create an Account</h2>
                    <strong>Firstname: <input type="text" name="firstname"></strong><br><br>
                    <strong>Lastname: <input type="text" name="lastname"></strong><br><br>
                    <strong>Email: <input type="email" name="email" maxlength="30" size="30" placeholder="example@gmail.com"></strong><br><br>
                    <strong>Password: <input type="password" name="password" required></strong><br><br>
                    <strong>Verify Password : <input type="password" name="vpassword" required></strong><br><br><br>

                    <div id="buttonHolder">
                        <input type="submit" name="submit" value="Create Account"/>
                </form>
                <form action="login.php">
                        <input type="submit" value="Return to login page"/>
                    </div>
				</form>
        </fieldset>
EBODY;

            if(isset($_POST['submit'])) {
              if (($_POST['password']) != ($_POST['vpassword'])){
                $body.= "<strong><h3> Password Does Not Match</h3></strong></br>";
              }
              else{
                session_start();

                $db_connection = new mysqli($host,$user,$password,$database);
                if ($db_connection->connect_error) {
                    die($db_connection->connect_error);
                }

				$email = trim($_POST['email']);
				$password = trim($_POST['password']);
				$firstname = trim($_POST['firstname']);
				$lastname = trim($_POST['lastname']);
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                
                if(password_verify($_POST['vpassword'], $hashed)){// verify password
                    $sqlQuery = $db_connection->prepare("insert into $table (email, password, firstname, lastname) values (?,?,?,?)");
                    $sqlQuery->bind_param("ssss", $email, $hashed, $firstname, $lastname);
                    $sqlQuery->execute();
                    header("location: login.php");
                }
                else{
                    echo "Password does not matched!";
                }
				

				/* Closing connection */
				$db_connection->close();
            }
          }
            echo generatePage($body, $title = "Register");
        ?>
    </body>
</html>
