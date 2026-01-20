<?php
session_start();
include "../../Model/mydb.php";
header('Content-Type: application/json');

if(!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] !== true){
    header("Location: ../../../Index.php");
    exit();
}
$response = array();

if($_SERVER['REQUEST_METHOD']=="POST"){
   $name= $_POST["name"] ?? "";
   $category= $_POST["category"] ??"";
   $price = $_POST["price"] ??"";
   $status= $_POST["status"] ??"";
   $quantity= $_POST["quantity"] ??"";

    if($name== "" || $category== ""|| $price== ""|| $quantity== ""){
        $response["success"] = false;
        $response["message"] = "Data is not found";
        echo json_encode($response);
        exit();
    }

    if(Addfood($name, $category, $price, $status, $quantity)){
        $response["success"] = true;
        $response["message"] = "Food add successfully";
        echo json_encode($response);
        exit();
    }
    else{
        $response["success"] = false;
        $response["message"] = "Add food error";
        echo json_encode($response);
        exit();
    }

}
?>