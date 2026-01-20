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
    $userId= $_POST["userId"] ?? "";

    if($userId == ""){
        $response["success"] = false;
        $response["message"] = "Data is not found";
        echo json_encode($response);
        exit();
    }
    if(DeleteUser($userId)){
        $response["success"] = true;
        $response["message"] = "User deleted successfully";
        echo json_encode($response);
        exit();
    }
    else{
        $response["success"] = false;
        $response["message"] = "Data deletion error";
        echo json_encode($response);
        exit();
    }

}
?>