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
    
    $foodId = $_POST['foodId'] ?? null;
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $status = $_POST['status'] ?? '';
    $price=trim($_POST['price'] ??'');
    $quantity = trim($_POST['quantity'] ??'');

    if(empty($foodId) || empty($name) || empty($category) || empty($status) || empty($price) || empty($quantity)){
         $response['success'] = false;
            $response['message'] = 'food\'s data is not found';
            echo json_encode($response);
            exit();
    }
    else 
    {
        if(Updatefood($foodId,$name,$category,$price,$status,$quantity))
        {
            $response['success'] = true;
            $response['message'] = 'Food information updated successfully!';
            echo json_encode($response);
            exit();
        }
        else
        {
            $response['success'] = false;
            $response['message'] = 'Error updating Food information!';
            echo json_encode($response);
            exit();
        }
    }
}
?>