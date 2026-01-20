<?php
session_start();
$isLoggedIn= $_SESSION["isLogin"]?? false;
if(!$isLoggedIn){
    header("Location: ../../../Index.php");
}
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

<div class="topbar">
    <h2>Cart</h2>
    <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'Employee'); ?></span>
</div>

<div class="nav-buttons">
    <a href="dashboard.php">Dashboard</a>
    <a href="menu.php">Menu</a>
    <a href="../../Controller/php/logout.php">Logout</a>
</div>

<?php if (empty($cart)) { ?>
    <p style="text-align:center;">Your cart is empty. <br> <br> <a href="menu.php"><button type="submit">Continue Shopping</button></a></p>
<?php } else { ?>

<table border="1">
    <tr>
        <th>Food Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
    </tr>

<?php
$grand_total = 0;
foreach ($cart as $item) {
    $total = $item['price'] * $item['qty'];
    $grand_total += $total;
?>
    <tr>
        <td><?php echo $item['item_name']; ?></td>
        <td><?php echo $item['price']; ?></td>
        <td><?php echo $item['qty']; ?></td>
        <td><?php echo $total; ?></td>
        <td>
            <a href="../../Controller/php/RemoveCartItem.php?id=<?php echo $item['menu_id']; ?>">Delete</a>
        </td>
    </tr>
<?php } ?>
    <tr>
        <td colspan="3">Grand Total</td>
        <td><?php echo $grand_total; ?></td>
        <td></td>
    </tr>
</table>

<br>
<div style="text-align:center;">
<a href="menu.php"><button type="button">Continue Shopping</button></a>
<form method="post" action="../../Controller/php/OrderController.php" style="display:inline;">
    <button type="submit" name="place_order" value="1">Place Order</button>
</form>
</div>

<?php } ?>

</body>
</html>
