<?php
session_start();
include "../../Model/mydb.php";
header('Content-Type: application/json');

if(!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] !== true){
    header("Location: ../../../Index.php");
    exit();
}


$response = array();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $userId = $_POST['userId'] ?? null;
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $Password = $_POST['password'] ?? '';
    $role=trim($_POST['role'] ??'');

    if(empty($userId) || empty($name) || empty($email) || empty($Password) || empty($role)){
        $response['Success'] = false;
        $response['message'] = 'All fields are required!';
        echo json_encode($response);
        exit();
    }
    else 
    {
        if(updateUser($userId, $name, $email, $Password,$role))
        {
            $response['Success'] = true;
            $response['message'] = 'User information updated successfully!';
            echo json_encode($response);
            exit();
        }
        else
        {
            $response['Success'] = false;
            $response['message'] = 'Error updating user information!';
            echo json_encode($response);
            exit();
        }
    }
}
?>