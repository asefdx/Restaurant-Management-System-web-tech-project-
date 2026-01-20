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
    $manuId= $_POST["manu_id"] ?? "";

    if($manuId == ""){
        $response["success"] = false;
        $response["message"] = "Data is not found";
        echo json_encode($response);
        exit();
    }
    if(DeleteFood($manuId)){
        $response["success"] = true;
        $response["message"] = "Food deleted successfully";
        echo json_encode($response);
        exit();
    }
    else{
        $response["success"] = false;
        $response["message"] = "Food deletion error";
        echo json_encode($response);
        exit();
    }

}
?>