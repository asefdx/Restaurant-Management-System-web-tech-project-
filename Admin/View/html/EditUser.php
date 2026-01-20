<?php
session_start();


$user = [
    'user_id' => '',
    'email' => '',
    'name' => '',
    'password' => '',
    'role' => ''
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Restaurant Admin</title>
    <link rel="shortcut icon" href="../Assest/ODUJEJ0.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/EditUser.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="topNavigationBar">
        <div class="navigationContainer">
            <div class="siteBrandName">Restaurant Admin</div>
            <ul class="navigationMenu">
                <li><a href="Dashboard.php" class="menuLink">Dashboard</a></li>
                <li><a href="userList.php" class="menuLink">User List</a></li>
                <li><a href="../../Controller/php/logout.php" class="logoutButton">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="pageContainer">
        <div class="editFormCard">
            <div class="formTitle">
                <h1>Edit Profile</h1>
                <p>Update your account information</p>
            </div>


            <form id="editProfileForm" action="" method="">
                <input type="hidden" name="user_id" id="userId">

                <div class="inputFieldGroup">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name">
                </div>

                <div class="inputFieldGroup">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email">
                   
                </div>

                <div class="inputFieldGroup">
                    <label for="password">Password *</label>
                    <div class="passwordFieldWrapper">
                        <input type="password" id="password" name="password">
                        <span class="showPasswordToggle" onclick="togglePassword('password')">Show</span>
                    </div>
                    <small>Enter password (Minimum 6 characters)</small>
                   
                </div>

                <div class="inputFieldGroup">
                    <label for="role">Role *</label>
                    <select id="role" name="role">
                       <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="employee">Employee</option>
            <option value="customer">Customer</option>
                    </select>
                    
                </div>

                <div class="button-group">
                    <button type="submit" class="submitButton">Update User</button>
                    <a href="userList.php" class="cancelButton">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <script src="../../Controller/js/userEditValidation.js"></script>
</body>
</html>