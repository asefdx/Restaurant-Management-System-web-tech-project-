<?php
function connection()
{
    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="restaurant_management";

    $connection = new mysqli($db_host,$db_user,$db_pass,$db_name);
    if($connection->connect_error){
        $_SESSION["connnectionError"]=$connection->connect_error;

    }
    else{
        $_SESSION["connectionSuccess"]="Successful";
    }
    return $connection ;
}


function getAllFoods(){
    $con = connection();
    $sql = "SELECT * FROM menu";
    $foods = [];
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $foods[] = $row;
        }
    }
    mysqli_close($con);
    return $foods;
}

function saveOrder($menu_id, $employee_id, $total_amount) {
    $con = connection();
    $order_date = date("Y-m-d H:i:s");
    
    $sql = "INSERT INTO orders (menu_id, employee_id, order_date, total_amount) VALUES ('$menu_id', '$employee_id', '$order_date', '$total_amount')";
    
    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        return true;
    } else {
        mysqli_close($con);
        return false;
    }
}

function getOrdersToday($employee_id = null) {
    $con = connection();
    $today = date("Y-m-d");
    
    if ($employee_id) {
        $sql = "SELECT o.order_id, m.item_name, o.employee_id, o.order_date, o.total_amount FROM orders o JOIN menu m ON o.menu_id = m.menu_id WHERE DATE(o.order_date) = '$today' AND o.employee_id = '$employee_id' ORDER BY o.order_date DESC";
    } else {
        $sql = "SELECT o.order_id, m.item_name, o.employee_id, o.order_date, o.total_amount FROM orders o JOIN menu m ON o.menu_id = m.menu_id WHERE DATE(o.order_date) = '$today' ORDER BY o.order_date DESC";
    }
    
    $orders = [];
    $result = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $orders[] = $row;
        }
    }
    
    mysqli_close($con);
    return $orders;
}