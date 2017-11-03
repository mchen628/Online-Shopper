<html>
	<head>
		<link rel="stylesheet" href = "general.css"/>
	</head>	

	<body>
		<?php
			require_once("support.php");
            
            $login = $_POST["username"];
            
			$body = <<<EBODY
					Login: $login
EBODY;
			echo generatePage($body, $title = "Login");

		?>
	</body>

</html>