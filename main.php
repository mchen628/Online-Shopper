<?php
	require_once("support.php");
    //require("itemClass.php");
    require_once("dblogin.php");
    session_start();

	$email = $_SESSION['email'];

    $db_connection = new mysqli($host,$user,$password,$database);
    if ($db_connection->connect_error) {
        die($db_connection->connect_error);
    }

    //prevent sql injection (cyber security)
    $sqlQuery = $db_connection->prepare("select * from wishlist where email=?");
    $sqlQuery->bind_param("s", $email);
    $result = $sqlQuery->execute();
    $addToWishCol = "";


    if (!$result) {
        die("Retrieval failed: ". $db_connection->error);
    } else {
        $sqlQuery->bind_result($email, $objs);
        if (!$sqlQuery->fetch()) {
             $addToWishCol = "<strong>No entry</strong>";
        } else {

            $items = explode("^^^^", $objs);
            if(sizeof($items) > 0  && $items[0] != null){

                for($i=0; $i<sizeof($items);$i++){
                    $itemObj = explode(",",$items[$i]);

                    $addToWishCol = $addToWishCol."<ul class=\"row\" style='list-style: none; padding: 0; margin: 0;'>" .
                                                      "<li class=\"col-sm-3\">" .
                                                      "<input type=\"checkbox\">" .
                                                        "</li>" .
                                                       "<li class=\"col-sm-5\">" . $itemObj[0] .
                                                      "</li>" .
                                                       "<li class=\"col-sm-4\">" .
                                                       "<span style=\"font-size: .75em; float: left\">$" . $itemObj[1] . "</span>" .
                                                       "<input type=\"image\" src=\"delete.jpg\"  width=\"15\" height=\"15\" id=\"delete\"/>" .
                                                        "</li>" .
                                                        "</ul>";

                }
            }


        }
    }
    $sqlQuery->free_result();
     //prevent sql injection (cyber security)
        $sqlQuery = $db_connection->prepare("select * from cartlist where email=?");
        $sqlQuery->bind_param("s", $email);
        $result = $sqlQuery->execute();
        $addToCartCol = "";

        if (!$result) {
            die("Retrieval failed: ". $db_connection->error);
        } else {
            $sqlQuery->bind_result($email, $objs);
            if (!$sqlQuery->fetch()) {
                $addToCartCol = "<strong>No entry</strong>";
            } else {

                $items = explode("^^^^", $objs);
                if(sizeof($items) > 0  && $items[0] != null){
                    for($i=0; $i<sizeof($items);$i++){
                        $itemObj = explode(",",$items[$i]);

                        $addToCartCol = $addToCartCol."<ul class=\"row\" style='list-style: none; padding: 0; margin: 0;'>" .
                                                          "<li class=\"col-sm-3\">" .
                                                          "<input type=\"checkbox\">" .
                                                            "</li>" .
                                                           "<li class=\"col-sm-5\">" . $itemObj[0] .
                                                          "</li>" .
                                                           "<li class=\"col-sm-4\">" .
                                                           "<span style=\"font-size: .75em; float: left\">$" . $itemObj[1] . "</span>" .
                                                           "<button style=\"background-image:url('delete.jpg');width:17px; height:17px;
                                                                                background-size: 14px 14px;\"></button>" .
                                                            "</li>" .
                                                            "</ul>";

                    }
                }
                $sqlQuery->free_result();
            }
        }
     if(isset($_SESSION['profilePic'])){
        $profilePic = "<img id=\"profilePic\" src=\"".$_SESSION['profilePic']."\" alt=\"image\"/>";
     }else{
        $profilePic = "<img id=\"profilePic\" src=\"#\" alt=\"image\"/>";
     }

    /* Closing connection */
    $db_connection->close();


    $user = $_SESSION['user'];
    $email = $_SESSION['email'];
	$body=<<<EBODY
		<div class="row">
			<div class="col">
				<h2 id="welcome" align="right">Welcome to Online-Shopper, $user</h2>
			</div>
			<div class="col">
				{$profilePic}
				 <form name="upload_img" enctype="multipart/form-data" id="upload_img">
						 <input id="upload" type="file" accept="image/*">
				</form>
			</div>
		</div>


        <hr><br>
		<!-- ITEM INFO -->
		<div class="row">
			<div class="col-sm-4 text-center">
				Item: <input type="text" id="item" placeholder="Search" size="25em">
			</div>
			<div class="col-sm-4 text-center">
				Price: <input type="text" id="price" placeholder="$0.00 (optional)" size="25em">
			</div>
			<div class="col-sm-4 text-center">
				Link: <input type="text" id="link" placeholder="www.example.com (optional)" size="25em">
			</div>
		</div><br>

		<!-- ADD TO LIST / ADD TO CART / GENERATE LINKS -->
		<div class="row">
			<div class="col-sm-4 text-center">
				<input type="button" id="addList" value="Add to wish list">
			</div>
			<div class="col-sm-4 text-center">
				<input type="button" id="addCart" value="Add to cart">
			</div>
			<div class="col-sm-4 text-center">
				<input type="button" id="genLink" value="Generate links">
			</div>
		</div><br>

		<!-- LISTS -->
		<div class="row">
			<!-- WISH LIST -->
			<div class="col-sm-4 text-center" style="background-color: LightBlue; height: 30em;">
				<div id="wish" class="cssList">
					<!-- ITEM GETS ADDED HERE -->
					{$addToWishCol}
				</div>
			</div>

			<!-- CART -->
			<div class="col-sm-4 text-center" style="background-color: LightBlue; height: 30em;">
				<div id="cart" class="cssList">
					<!-- ITEM GETS ADDED HERE -->
					{$addToCartCol}
				</div>
			</div>

			<!-- LINKS -->
			<div class="col-sm-4 text-center" style="background-color: LightBlue; height: 30em;">
				<div id="links" class="cssList">
					<!-- LINKS GETS ADDED HERE -->

				</div>
			</div>
		</div><br>

		<div class="row">
			<div class="col-sm-4 ">
				<strong>Your Budget: </strong><input type="text" id="budget" placeholder="Please enter your budget"><br><br>
				<strong>Current Cart Cost: <strong><input type="text" id="cartCost" readonly><br>
			</div>
			<div class="col-sm-4 text-center">
			</div>
			<div class="col-sm-4 text-right text-down">
			<form action="checkout.php">
    		<input type="submit" value="Check out" style="color:white; border-radius:6px; background-color:black; width: 150px"/>
			</form>
		</div>
		<div id="email" style="visibility: hidden;">{$email}</div>
EBODY;

	echo generatePage($body, $title = "Main Page");
?>
