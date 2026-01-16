<?php
session_start();

$isLoggedIn= $_SESSION["isLogin"]?? false;
if(!$isLoggedIn){
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
    <a href="../../Controller/php/LogoutController.php">Logout</a>
</div>

<form method="post" action="../../Controller/php/CartController.php">

<table border="1">
    <tr>
        <th>Select</th>
        <th>Food ID</th>
        <th>Food Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Available Quantity</th>
        <th>Order Quantity</th>
    </tr>
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
            <input type="number" name="qty[<?php echo $row['menu_id']; ?>]" value="1" min="1" max="<?php echo $row['quantity']; ?>">
        </td>
    </tr>
<?php
}
?>
</table>

<br>
<div style="text-align:center;">
<button type="submit" name="add_to_cart">Add to Cart</button>
</div>

</form>

</body>
</html>
