<?php
	require_once("support.php");

    session_start();

	$user = $_SESSION['user'];
	$email = $_SESSION['email'];

$body=<<<EBODY
<h2>Check Out Summary</h2>
  <div class="row">
    <div class="col-sm-4 text-left" id="checkoutItem">
    <h3>Item:</h3>
    </div>
    <div class="col-sm-4 text-left" id="checkoutPrice">
    <h3>Price:</h3>
    </div>
    <h3>Budget:</h3>
  </div>




EBODY;
  echo generatePage($body, $title = "Main Page");
?>
