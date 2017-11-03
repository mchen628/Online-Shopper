<html>
	<head>
		<link rel="stylesheet" href = "general.css"/>
	</head>	

	<body>
		<?php
			require_once("support.php");
			require_once("dblogin.php");
						
			$body = <<<EBODY
					<form action="{$_SERVER['PHP_SELF']}" method="post">
						Login: <input type="text" name="username" maxlength="30" required/><br><br>
						Password: <input type="password" name="password" required/><br><br>
						<div id="buttonHolder">
							<input type="submit" name="login" value="Login"/>
					</form>
					<form action="register.php">
							<input type="submit" value="Register Now!"/>
						</div>
					</form>
EBODY;
					
			if (isset($_POST['login'])) {
				//connect to database
				$db_connection = new mysqli($host,$user,$password,$database);
				if ($db_connection->connect_error) {
					die($db_connection->connect_error);
				}
				
				//prevent sql injection (cyber security)
				$sqlQuery = $db_connection->prepare("select username, password, email from $table where username = ?");
                if (!$sqlQuery) {// cannot connect to database
					die("Retrieval failed: ". $db_connection->error);
				} 
                //select a user from database based on username
				$sqlQuery->bind_param("s", $_POST['username']);
				$sqlQuery->execute();	
                if(!$sqlQuery){//no such user found
                    echo "<strong>No such username and password combination is found!<strong>";
                }
                else{
                    //fetch the selected user info
				    $sqlQuery->bind_result($username, $password, $email);
				    $sqlQuery->fetch();
                    
                    
                    if(password_verify($_POST["password"], $password)){ // login successful
                        echo "<strong>login successful!<strong>";
                    }else{//password don't match
                        echo "<strong>No such username and password combination is found!2<strong>";
                    }
                }               
				/* Closing connection */
				$db_connection->close();
			}
			echo generatePage($body, $title = "Login");
		?>
	</body>
</html>