<?php
	require_once("support.php");
	require_once("dblogin.php");

	session_start();
	
	$body=<<<EBODY
		<div class="container">
			<fieldset>
				<form action="{$_SERVER['PHP_SELF']}" method="post">
					<h2 style="text-decoration: underline"><strong>Log in To Shop</strong></h2></br>
		
					<img src="login.jpg" width="18" height="18" alt="login" />
					Login ID: <input type="email" name="email" maxlength="30" size="30" placeholder="example@gmail.com" required/><br><br>
	
					<img src="pw.jpg" width="20" height="20" alt="pw" />
					Password: <input type="password" name="password" maxlength="20" size="20" required/></br></br></br>
		
					<div id="buttonHolder">
						<input type="submit" name="login" value="Login"/>
				</form>
				<form action="register.php">
						<input type="submit" value="Register Now!"/>
					</div><br>
				</form>
				<input type="checkbox" name="rememberME" value="Remember Me" />Remember Me</br>
				<a href ="forgotpw.php"/>Forgot Password?</a>
			</fieldset>
			<img src="cart.jpg" style="float:right" width="300" height="300" alt="Shopping cart" />
		</div>
EBODY;
	//rememberme and forgotpw have not done yet!!!!!!!!!

	if (isset($_POST['login'])) {
		//connect to database
		$db_connection = new mysqli($host,$user,$password,$database);
		if ($db_connection->connect_error) {
			die($db_connection->connect_error);
		}

		//prevent sql injection (cyber security)
		$sqlQuery = $db_connection->prepare("select email,password,firstname,lastname from $table where email=?");
		$sqlQuery->bind_param("s", $_POST['email']);
		if(!$sqlQuery->execute()) {
			die("Retrieval failed: ".$sqlQuery->error);
		}
				
        $sqlQuery->bind_result($email, $password, $firstname, $lastname);
		if(!$sqlQuery->fetch()) {
			$body .= "<br><p class=text-center><strong>No entry exists in the database for the specified username and password.</strong></p>";
		}

        if(password_verify($_POST['password'], $password)){// login successful
			$_SESSION['user'] = $firstname ." ". $lastname;
            header("location: main.php");
        }else{
			$body .= "<br><p class=text-center><strong>Invalid username and password combination.</strong></p>";
        }
				
		/* Closing connection */
		$db_connection->close();
	}
	echo generatePage($body, $title = "Login");
?>
