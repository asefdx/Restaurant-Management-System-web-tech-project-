<?php

use Dba\Connection;

include "../../Model/mydb.php";
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["signup"])){
	$name   = trim($_POST["name"] ?? "");
	$email  = trim($_POST["email"] ?? "");
	$pass   = trim($_POST["password"] ?? "");
	$cpass  = trim($_POST["confirm_password"] ?? "");
	$role   = trim($_POST["role"] ?? "");

	$hasError = false;

	if($email === ""){
		$_SESSION['emailErr'] = "Please enter a valid email address";
		$hasError = true;
	}

	if($pass === ""){
		$_SESSION['passwordErr'] = "Password is required";
		$hasError = true;
	} elseif(strlen($pass) < 6){
		$_SESSION['passwordErr'] = "Password must be at least 6 characters";
		$hasError = true;
	}

	if($cpass === ""){
		$_SESSION['confirm_passwordErr'] = "Please confirm your password";
		$hasError = true;
	} elseif($pass !== $cpass){
		$_SESSION['confirm_passwordErr'] = "Passwords do not match";
		$hasError = true;
	}

	if($hasError){
		header("Location: ../../View/html/SignUp.php");
		exit();
	}

    if (signup($name, $email, $cpass, $role)) {
        header("Location: ../../../Index.php");
        exit();
    } else {
    
    header("Location: ../../View/html/SignUp.php");
    exit();
    }

}

?>
