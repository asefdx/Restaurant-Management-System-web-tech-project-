<?php
session_start();

$isLoggedIn = $_SESSION["isLogin"] ?? false;
if (!$isLoggedIn) {
	header("Location: ../../../Index.php");
	exit();
}

$food = [
	'food_id' => '',
	'item_name' => '',
	'category' => '',
	'price' => '',
	'quantity' => '',
	'status' => 'available'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Food Item</title>
	<link rel="shortcut icon" href="../Assest/ODUJEJ0.jpg" type="image/x-icon">
	<link rel="stylesheet" href="../CSS/EditUser.css">
</head>
<body>
	<nav class="topNavigationBar">
		<div class="navigationContainer">
			<div class="siteBrandName">Restaurant Admin</div>
			<ul class="navigationMenu">
				<li><a href="Dashboard.php" class="menuLink">Dashboard</a></li>
				<li><a href="Foodlist.php" class="menuLink">Food List</a></li>
				<li><a href="../../Controller/php/logout.php" class="logoutButton">Logout</a></li>
			</ul>
		</div>
	</nav>

	<div class="pageContainer">
		<div class="editFormCard">
			<div class="formTitle">
				<h1>Edit Food Item</h1>
				<p>Update menu item information</p>
			</div>

			<form id="editFoodForm" action="" method="post">
				<input type="hidden" name="food_id" id="foodId">

				<div class="inputFieldGroup">
					<label for="food_name">Food Name *</label>
					<input type="text" id="food_name" name="food_name" placeholder="Enter food name">
				</div>

				<div class="inputFieldGroup">
					<label for="food_category">Category *</label>
					<input type="text" id="food_category" name="category"  placeholder="Enter category">
				</div>

				<div class="formRow">
					<div class="inputFieldGroup formGroupHalf">
						<label for="price">Price (tk) *</label>
						<input type="number" id="price" name="price" min="0" step="0.01"  placeholder="Enter price">
					</div>

					<div class="inputFieldGroup formGroupHalf">
						<label for="quantity">Quantity *</label>
						<input type="number" id="quantity" name="quantity" min="0" step="1" placeholder="Enter quantity">
					</div>
				</div>

				<div class="inputFieldGroup">
					<label for="status">Status *</label>
					<select id="status" name="status">
						<option value="available" <?= $food['status'] === 'available' ? 'selected' : '' ?>>Available</option>
						<option value="unavailable" <?= $food['status'] === 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
					</select>
				</div>

				<div class="button-group">
					<button type="submit" id="submit" class="submitButton">Update Food</button>
					<a href="Foodlist.php" class="cancelButton">Cancel</a>
				</div>
			</form>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="../../Controller/js/EditFood.js"></script>
</body>
</html>
