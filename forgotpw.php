<?php
require_once("support.php");
require_once("dblogin.php");

session_start();

$body=<<<EBODY
<div id="forgotPW">
<form action="{$_SERVER['PHP_SELF']}" method="post">
<u><h2>FORGOT YOUR PASSWORD</h2></u></br>
PLEASE ENTER YOUR EMAIL ADDRESS BELOW </br>
and you will receive your validation code by email</br></br>
<input type="email" id="pwSearch" name="pwSearch" size="50"></br></br>
<input type="submit" name="submit" value="Send"></br><br>

</form>
<a href="login.php"><button>Back to login</button></a></br></br>
</div>

EBODY;

if (isset($_POST['submit'])) {
    $body ="";
    $db_connection = new mysqli($host,$user,$password,$database);
    if ($db_connection->connect_error) {
         die($db_connection->connect_error);
    }
    $email = trim($_POST["pwSearch"]);
    $sqlQuery = sprintf("select * from $table where email = '%s'", $email);
    $result = mysqli_query($db_connection,$sqlQuery);
    if ($result) {
      $numberOfRows = mysqli_num_rows($result);
      if ($numberOfRows == 0) {
        $body.= "<h3> Incorrect Email address</h3>";
        $body.= "<strong>The email address your entered does not belong to any account</strong></br>";
        $body.= "<strong>Please register first</strong></br></br> ";
        $body.= "<a href='login.php'><button>Back to login</button></a></br></br>";
      }
      else{
        $body.="<Strong>An email has been sent, please check your Email </Strong></br></br>";
        $body.= "<a href='login.php'><button>Back to login</button></a></br></br>";
      }
      mysqli_free_result($result);
    }
    else {
      $body.="Retrieving records failed.".mysqli_error($db_connection);
    }
    mysqli_close($db_connection);
}
echo generatePage($body, $title = "Main Page");
?>
