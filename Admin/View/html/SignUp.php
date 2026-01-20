<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../CSS/SignUp.css">
</head>
<body>
    <div class="signup-container">
        <h2>Create Account</h2>
        <form action="../../Controller/php/SignUpProcess.php" method="POST" onsubmit="return signupValidation()">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
                <?php if(isset($_SESSION['emailErr'])): ?>
                    <span class="error"><?php echo $_SESSION['emailErr']; unset($_SESSION['emailErr']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required minlength="6">
                <?php if(isset($_SESSION['passwordErr'])): ?>
                    <span class="error"><?php echo $_SESSION['passwordErr']; unset($_SESSION['passwordErr']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <?php if(isset($_SESSION['confirm_passwordErr'])): ?>
                    <span class="error"><?php echo $_SESSION['confirm_passwordErr']; unset($_SESSION['confirm_passwordErr']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label>Select Role</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="role" value="employee" required>
                        Employee
                    </label>
                </div>
            </div>
            
            <button type="submit" name="signup" class="btn-signup">Sign Up</button>
            
            <div class="login-link">
                Already have an account? <a href="../../../Index.php">Login here</a>
            </div>
        </form>
    </div>

    <script src="../../Controller/js/ValidationSignup.js"></script>
</body>
</html>