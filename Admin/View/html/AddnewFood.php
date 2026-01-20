<?php
session_start();
$isLoggedIn = $_SESSION["isLogin"] ?? false;
if (!$isLoggedIn) {
    header("Location: ../../../Index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Food</title>
    <link rel="shortcut icon" href="../Assest/ODUJEJ0.jpg" type="image/x-icon">
    <!-- <link rel="stylesheet" href="../CSS/AddEdit.css"> -->
     <link rel="stylesheet" href="../CSS/EditUser.css">
</head>
<body>
    <!-- Navigation Bar -->
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
                <h1>Add New Food</h1>
                <p>Add a new item to the menu</p>
            </div>

            <form action="" method="" id="foodForm">
                <div class="inputFieldGroup">
                    <label for="food_name">Food Name *</label>
                    <input type="text" id="food_name" name="food_name" placeholder="Enter food name" required>
                </div>

                <div class="inputFieldGroup">
                    <label for="category">Category *</label>
                     <input type="text" id="food_category" name="category" placeholder="Enter food category" required>
                </div>

                <div class="formRow">
                    <div class="inputFieldGroup formGroupHalf">
                        <label for="price">Price (tk) *</label>
                        <input type="number" id="price" name="price" placeholder="Enter price" min="0" step="0.01" required>
                    </div>

                    <div class="inputFieldGroup formGroupHalf">
                        <label for="quantity">Quantity *</label>
                        <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" min="0" step="1" required>
                    </div>
                </div>

                <div class="inputFieldGroup">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>

                <div class="formButtonsGroup">
                    <button type="submit" id="submitFood" class="submitButton">Add Food</button>
                    <button type="reset" class="cancelButton">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../Controller/js/Addfood.js"></script>
</body>
</html>
