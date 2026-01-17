<?php
include "../../Model/mydb.php";
session_start();
$email=$_POST["email"];

$password=$_POST['password'];

$errors=[];

$values=[];

if(!$email){
    $errors['email']="Email field is required";
}

if(!$password){
    $errors['password']="Password field is required";
}

if(count($errors)>0){
    
    if($errors['email']){
        $_SESSION["emailErr"]=$errors['email'];
    }
    if($errors["password"]){
        $_SESSION["passwordErr"]=$errors["password"];
    }

    header("Location: ../../View/html/login.php");
    exit();

}
else {
   
    
        // Fetch users (function defined in mydb.php)
        $users = login();
        $loginSuccess = false;
        
        if(!empty($users)){
            foreach ($users as $user) {
                if($user['email'] == $email && $user['password'] == $password){
                    $_SESSION["user_email"] = $email;
                    $_SESSION['last_activity'] = time();
                    $_SESSION["isLogin"] = true;
                    $loginSuccess = true;
                    If($user["role"]=="admin")
                    {
                        header("Location: ../../View/html/Dashboard.php");
                    }
                    else if ($user["role"]== "employee")
                    {
                        header("Location: ../../../Employee/View/html/dashboard.php");
                    }
                    exit();
                }
            }
        
        
        if(!$loginSuccess){
            $_SESSION["loginErr"] = "Invalid email or password";
            header("Location: ../../../Index.php");
            exit();
        }
    }
    
}



?>