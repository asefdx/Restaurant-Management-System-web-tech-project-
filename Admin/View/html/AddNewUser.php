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
    <title>Add New Users</title>
     <link rel="shortcut icon" href="../Assest/ODUJEJ0.jpg" type="image/x-icon">
     <link rel="stylesheet" href="../CSS/AddEdit.css">

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
                    <a href="FoodList.php" class="nav-link">Food List</a>
                </li>
                <li class="nav-item">
                    <a href="userList.php" class="nav-link">User List</a>
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
<main>
    <div class="form-container">
        <h2>Add New User</h2>
        <!-- <form action="../../Controller/php/UserValidation.php" method="post" enctype="multipart/form-data" id="UserFrom" onsubmit="return validationUser()"> -->
            <form action="" method="" enctype="multipart/form-data" id="UserFrom">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter user name">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"  placeholder="Enter email address" onkeyup="checkEmailExists(this.value)">
                <p id="emailErr"></p>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"  placeholder="Enter password">
            </div>

            <div class="form-group">
                <label>Role:</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="role" value="admin">
                        <span>Admin</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="role" value="employee">
                        <span>Employee</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="role" value="customer">
                        <span>Customer</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" id="submitUser" class="submit-btn">Add User</button>
                <button type="reset" class="reset-btn" onclick="reset()">Reset</button>
            </div>
            
        </form>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../../Controller/js/UserValidation.js"></script>
</body>
</html>