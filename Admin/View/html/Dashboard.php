<?php
session_start();

$isLoggedIn= $_SESSION["isLogin"]?? false;
if(!$isLoggedIn){
    header("Location: ../../../Index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="shortcut icon" href="../Assest/ODUJEJ0.jpg" type="image/x-icon">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">Restaurant Admin</div>
            
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="Dashboard.php" class="nav-link active">Home</a>
                </li>
                <li class="nav-item">
                    <a href="foodlist.php" class="nav-link">Food List</a>
                </li>
                <li class="nav-item">
                    <a href="userlist.php" class="nav-link">User List</a>
                </li>
                <li class="nav-item">
                    <a href="saleslist.php" class="nav-link">Sales List</a>
                </li>
                <li class="nav-divider"></li>
                <li class="nav-item">
                    <span class="user-info">Welcome, <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'Admin'); ?></span>
                </li>
                <li class="nav-item">
                    <a href="../../Controller/php/logout.php" class="logout-btn">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="welcome-section">
            <h1>Welcome to Restaurant Management System</h1>
            <p>Manage your restaurant efficiently using the navigation menu above.</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <!-- Total Sales Box -->
            <div class="stat-box sales">
                <div class="stat-label">Total Sales</div>
                <div class="stat-value">12,450 tk</div>
            </div>
        </div>
    </div>
</body>
</html>