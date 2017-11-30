<html>
	<head>
		<link rel="stylesheet" href = "general.css"/>
	</head>

	<body>
		<?php
			require_once("support.php");
			require_once("dblogin.php");

			$body=<<<EBODY
					<form action="{$_SERVER['PHP_SELF']}" method="post">
					<fieldset>
					<em><h2><strong>Log in To Shop</strong></h2></em></br>

						<img src="login.jpg" width="18" height="18" alt="login" />
						Login ID: <input type="email" name="email" maxlength="30" size="30" placeholder="example@gmail.com" required/><br><br>

						<img src="pw.jpg" width="20" height="20" alt="pw" />
						Password: <input type="password" name="password" maxlength="20" size="20" required/></br></br></br></br></br></br>

						<div id="buttonHolder">
							<input type="submit" name="login" value="Login"/>

					</form>
					<form action="register.php">
							<input type="submit" value="Register Now!"/>

						</div>
					</form>
					<input type="checkbox" name="rememberME" value="Remember Me" />Remember Me</br>
					<a href ="forgotpw.php"/>Forgot Password?


					</fieldset>

					<img src="cart.jpg" style="float:right" width="300" height="300" alt="Shopping cart" />

EBODY;
	//rememberme and forgotpw have not done yet!!!!!!!!!

			if (isset($_POST['login'])) {
				//connect to database
				$db_connection = new mysqli($host,$user,$password,$database);
				if ($db_connection->connect_error) {
					die($db_connection->connect_error);
				}

				$email = trim($_POST['email']);
				$password = trim($_POST['password']);

				//prevent sql injection (cyber security)
				$sqlQuery = $db_connection->prepare("select password from $table where email=?");
				$sqlQuery->bind_param("s", $email);
				$result = $sqlQuery->execute();


				if (!$result) {
					die("Retrieval failed: ". $db_connection->error);
				} else {
					$sqlQuery->bind_result($hashed);
					if (!$sqlQuery->fetch()) {
						$body .= "<strong>No entry exists in the database for the specified username and password.</strong>";
					} else {
						echo $password ." ". $hashed;
						if(password_verify($password,$hashed)) {
							header("location: main.php");
						} else {
							$body .= "<strong>No entry exists in the database for the specified username and password.</strong>";
						}
					}
				}
				/* Closing connection */
				$db_connection->close();
			}
			echo generatePage($body, $title = "Login");
		?>
	</body>
</html>
