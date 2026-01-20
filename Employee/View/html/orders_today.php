<?php
session_start();
$isLoggedIn= $_SESSION["isLogin"]?? false;
if(!$isLoggedIn){
    header("Location: ../../../Index.php");
}
include "../../Model/mydb.php";

// Get all orders for today (not filtered by employee_id)
$orders = getOrdersToday();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orders Today</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

<div class="topbar">
    <h2>Orders Today</h2>
    <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'Employee'); ?></span>
</div>

<div class="nav-buttons">
    <a href="dashboard.php">Dashboard</a>
    <a href="menu.php">Menu</a>
    <a href="cart.php">Cart</a>
    <a href="../../Controller/php/logout.php">Logout</a>
</div>

<?php if (isset($_GET['success'])) { ?>
    <p>Order placed successfully!</p>
<?php } ?>

<?php if (empty($orders)) { ?>
    <p>No orders today.</p>
<?php } else { ?>

<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Food Name</th>
        <th>Employee ID</th>
        <th>Order Date</th>
        <th>Total Amount</th>
    </tr>

<?php
foreach ($orders as $order) {
?>
    <tr>
        <td><?php echo $order['order_id']; ?></td>
        <td><?php echo $order['item_name']; ?></td>
        <td><?php echo $order['employee_id']; ?></td>
        <td><?php echo $order['order_date']; ?></td>
        <td><?php echo $order['total_amount']; ?></td>
    </tr>
<?php } ?>
</table>

<?php } ?>

</body>
</html>
