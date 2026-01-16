<?php
session_start();
include "../../Model/mydb.php";

// Set header for JSON response
header('Content-Type: application/json');

$name = $_POST["name"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";
$role = $_POST["role"] ?? "";

$hasError = false;
$response = array();

if(empty($name) || empty($email) || empty($password) || empty($role)){
    $hasError = true;
}

if($hasError){
    $_SESSION["Message"]="Fail to Add User first";
    $response['success'] = false;
    $response['message'] = "Fail to send data. All fields are required.";
    echo json_encode($response);
    exit();
}
else {
    $result = signup($name,$email,$password,$role);
    if($result === true){
        $_SESSION["Message"]="Successfully Add User";
        $response['success'] = true;
        $response['message'] = "User added successfully!";
    }else{
        $_SESSION["Message"]="Fail to Add User";
        $response['success'] = false;
        $response['message'] = "Failed to add user. Please try again.";
    }
    echo json_encode($response);
    exit();
}

?>