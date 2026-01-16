<?php
include "../../Model/mydb.php";
header('Content-Type: application/json');

$email = $_POST["email"] ?? "";
$response=array();

if(empty($email)){
     $response['success'] = false;
     echo json_encode($response);
     exit();
    
}
else 
    {
        if(SearchEmail($email))
            {
                 $response['success'] = true;
            }
            else {
                 $response['success'] = false;
            }
    }

echo json_encode($response);
    exit();

?>