<?php
session_start();

$isLoggedIn = $_SESSION["isLogin"] ?? false;
if (!$isLoggedIn) {
    header("Location: ../../../Index.php");
}

include "../../Model/mydb.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

<div class="topbar">
    <h2>Food Menu</h2>
    <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'Employee'); ?></span>
</div>

<div class="nav-buttons">
    <a href="dashboard.php">Dashboard</a>
    <a href="cart.php">Cart</a>
    <a href="../../Controller/php/logout.php">Logout</a>
</div>

<!-- SEARCH BAR  -->
<div style="text-align:center; margin:15px 0;">
    <input type="text"
           id="searchInput"
           placeholder="Search food"
           onkeyup="searchFood()"
           style="padding:6px; width:250px;">
</div>

<form method="post" action="../../Controller/php/CartController.php">

<table border="1">
    <thead>
        <tr>
            <th>Select</th>
            <th>Food ID</th>
            <th>Food Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Available Quantity</th>
            <th>Order Quantity</th>
        </tr>
    </thead>

    <!-- AJAX  -->
    <tbody id="menuBody">
    <?php
    $foods = getAllFoods();

    foreach ($foods as $row) {
    ?>
        <tr>
            <td>
                <input type="checkbox" name="menu_id[]" value="<?php echo $row['menu_id']; ?>">
            </td>
            <td><?php echo $row['menu_id']; ?></td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>
                <input type="number"
                       name="qty[<?php echo $row['menu_id']; ?>]"
                       value="1"
                       min="1"
                       max="<?php echo $row['quantity']; ?>">
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>

<br>
<div style="text-align:center;">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</div>

</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../../Controller/js/menuSearch.js"></script>

</body>
</html>
