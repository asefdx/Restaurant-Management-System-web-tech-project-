<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>
    <link rel="shortcut icon" href="Admin/View/Assest/ODUJEJ0.jpg" type="image/x-icon">
    <link rel="stylesheet" href="Admin/View/CSS/login.css">
</head>
<body>
    <main class="main">
        <section class="login-Container">
            <?php if(isset($_SESSION['signupSuccess'])): ?>
                <div class="success-message"><?php echo $_SESSION['signupSuccess']; unset($_SESSION['signupSuccess']); ?></div>
            <?php endif; ?>
           <form action="Admin/Controller/php/LoginProcess.php"
                 method="POST"
                 enctype="multipart/form-data"
                 onsubmit="return validation()">

               <div class='heading-container'>
                 <h2>Welcome</h2>
                <p>Sign in to your dashboard</p>
               </div>

                <table>
                    <tr>
                        <td><label for="email" class="email-lb">Email</label></td>
                        <td><input type="text" name="email" id="email"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php if(isset($_SESSION['emailErr'])): ?>
                                <p class="error"><?php echo $_SESSION['emailErr']; unset($_SESSION['emailErr']); ?></p>
                            <?php else: ?>
                                <p></p>
                            <?php endif; ?>
                        </td>
                    </tr>
                     <tr>
                        <td><label for="password">Password</label></td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php if(isset($_SESSION['passwordErr'])): ?>
                                <p class="error"><?php echo $_SESSION['passwordErr']; unset($_SESSION['passwordErr']); ?></p>
                            <?php else: ?>
                                <p></p>
                            <?php endif; ?>
                        </td>
                    </tr>

                </table>
                   <div class='btn-container'>

                     <button type="submit" name="login" id="btn-login" class='btn'>login</button>
                    </div>
                     <div class="login-link">
                Don't have an account? <a href="Admin/View/html/SignUp.php">SignUp here</a>
            </div>

            </form>
        </section>
    </main>
    <script src="Admin/Controller/js/LoginValidation.js"></script>
</body>
</html>