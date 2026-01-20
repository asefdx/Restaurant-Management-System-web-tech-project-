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
    <title>Add New Users</title>
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
                <h1>Add New User</h1>
                <p>Create a new user account</p>
            </div>

            <form action="" method="post" enctype="multipart/form-data" id="UserFrom">
                <div class="inputFieldGroup">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" placeholder="Enter user name">
                </div>

                <div class="inputFieldGroup">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" placeholder="Enter email address" onkeyup="checkEmailExists(this.value)">
                    <p id="emailErr" class="validationErrorText"></p>
                </div>

                <div class="inputFieldGroup">
                    <label for="password">Password *</label>
                    <div class="passwordFieldWrapper">
                        <input type="password" id="password" name="password" placeholder="Enter password">
                        <span class="showPasswordToggle" onclick="togglePassword()">Show</span>
                    </div>
                    <p class="helperText">Enter password (Minimum 6 characters)</p>
                </div>

                <div class="inputFieldGroup">
                    <label for="role">Role *</label>
                    <select id="role" name="role">
                        <option value="admin">Admin</option>
                        <option value="employee">Employee</option>s
                    </select>
                </div>

                <div class="formButtonsGroup">
                    <button type="submit" name="submit" id="submitUser" class="submitButton">Add User</button>
                    <button type="reset" class="cancelButton" onclick="reset()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../Controller/js/UserValidation.js"></script>
    
</body>
</html>
