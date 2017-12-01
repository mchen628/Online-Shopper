<?php
	require_once("support.php");

    session_start();

	$user = $_SESSION['user'];
	$email = $_SESSION['email'];

	$body=<<<EBODY
		<h2>Welcome to Online-Shopper, $user</h2><br>

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
				</div>
			</div>

			<!-- CART -->
			<div class="col-sm-4 text-center" style="background-color: LightBlue; height: 30em;">
				<div id="cart" class="cssList">
					<!-- ITEM GETS ADDED HERE -->
				</div>
			</div>

			<!-- LINKS -->
			<div class="col-sm-4 text-center" style="background-color: LightBlue; height: 30em;">
				<div id="links" class="cssList">
					<div class="row">
						<div class="col-sm-4 text-center">
							<input type="checkbox">
						</div>
						<div class="col-sm-4 text-center">
							asdfasd
						</div>
						<div class="col-sm-4 text-center">
						<img src="delete.jpg" width="15" height="15" alt="delete" id="delete">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 text-center">
							<input type="checkbox">
						</div>
						<div class="col-sm-4 text-center">
							asdfasd
						</div>
						<div class="col-sm-4 text-center">
						<img src="delete.jpg" width="15" height="15" alt="delete" id="delete">
						</div>
					</div>
				</div>
			</div>
		</div><br>

		<div class="row">
			<div class="col-sm-4 ">
				<strong>Your Budget: </strong><input type="text" id="budget" placeholder="Please enter your budget"><br><br>
				<strong>Current Cart Cost: <strong><input type="text" id="budget" readonly><br>
			</div>
			<div class="col-sm-4 text-center">
			</div>
			<div class="col-sm-4 text-right text-down">
				<input type="button" value="Check Out" id="checkout" style="color:white; border-radius:6px; background-color:black; width: 150px">
		</div>
		<div id="email" style="visibility: hidden;">{$email}</div>
EBODY;
	echo generatePage($body, $title = "Main Page");
?>
