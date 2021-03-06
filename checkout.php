<?php
	require_once("support.php");
	require("itemClass.php");
	require_once("dblogin.php");
	session_start();

	$email = $_SESSION['email'];
	$budget = $_SESSION['budget'];
	$total = 0;
	$tax = $_SESSION['tax'];
	$db_connection = new mysqli($host,$user,$password,$database);
	if ($db_connection->connect_error) {
			die($db_connection->connect_error);
	}
	
	$sqlQuery = $db_connection->prepare("select * from cartlist where email=?");
	$sqlQuery->bind_param("s", $email);
	$result = $sqlQuery->execute();
	$addToCartCol = "";



	if (!$result) {
		die("Retrieval failed: ". $db_connection->error);
	} else {
		$sqlQuery->bind_result($email, $objs);
		if (!$sqlQuery->fetch()) {//fetch from all items into $objs, its one string
			$addToCartCol = "<strong>No entry</strong>";
		} else {
			//each item is seperated by ^^^^
			$items = explode("^^^^", $objs);
			if(sizeof($items) > 0  && $items[0] != null){
				for($i=0; $i<sizeof($items);$i++){
				//inside each item its seperated by a comma (e.g name,cost,link)
				$itemObj = explode(",",$items[$i]);
				$addToCartCol = $addToCartCol."<ul class=\"row\" style='list-style: none; padding: 0; margin: 0;'>" .
				"<li class=\"col-sm-5\">" . $itemObj[0] .
				"</li ><li>".
				"<span style=\"font-size: .80em; float: right\">$" . $itemObj[1] . "&nbsp&nbsp</span>" .
				"</li>" .
				"</ul>";
				$total += $itemObj[1];
				}
			}
		}
	}

	$sqlQuery->free_result();


	$body=<<<EBODY
<form action="{$_SERVER['PHP_SELF']}" method="post">
<div class="row">
<u><h1>Check Out Summary</h1></u>
</div>
  <div class="row">
	<!-- CARTlist -->
	<div class="col-sm-4 text-center" style="background-color: LightBlue; height: 30em;">

		<div id="cart" class="checkoutcss">
			<!-- ITEM GETS ADDED HERE -->
			{$addToCartCol}
		</div>
	
		<button><a href ="main.php">Edit your cart! </button>
		
	</div>
	<div class="col-sm-4 " style="background-color: LightBlue; height: 30em;">
		<strong>Your Budget :</strong>&nbsp;&nbsp;$ {$budget} </br></br>
		<strong>Your cart cost :</strong> $ {$total}
		<hr>
		<strong>Tax : &nbsp; </storng> <input type="text" name="tax" size="3" value="$tax" readonly>%
		<hr>


EBODY;

$tx = ($tax*0.01) + 1;
$totalAfterTax = ($total * $tx);
$balance = $budget - $totalAfterTax;
$body .= "<strong>Total cost after tax = </strong> {$totalAfterTax} </br></br>";
$body .= "<strong>Your balance : $</strong> {$balance}";
$body .= "</div>";
$body .= "<div class='col-sm-4' >";
$body .= "<input type='submit' name ='logout' value='LOGOUT'>";
$body .= "</div>";
$body .= "</div></form>";


if (isset($_POST['logout'])){
	setcookie("remember", "", time()-3600);
	header("location:login.php");
}

  echo generatePage($body, $title = "Main Page");
?>
