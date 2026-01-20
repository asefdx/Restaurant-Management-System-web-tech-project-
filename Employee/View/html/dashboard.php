
<?php
session_start();
$isLoggedIn= $_SESSION["isLogin"]?? false;
if(!$isLoggedIn){
    header("Location: ../../../Index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<div class="topbar">
  <div class="topbar-left">
      <img src="../Assests/ODUJEJ0.jpg" alt="Logo">
      <h2>Dashboard</h2>
  </div>
  <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'Employee'); ?></span>
</div>
<div class="nav-buttons">
  <a href="menu.php">Menu</a>
  <a href="cart.php">Cart</a>
  <a href="orders_today.php">Today’s Orders</a>
  <a href="../../Controller/php/logout.php">Logout</a>
</div>
<div class="hero">
  <img src="../Assests/employee.png" width="300">
</div>
</body>
</html>
