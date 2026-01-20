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

function login(){
    $con=connection();
    $sql="SELECT * FROM users";
    $users=[];
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $users[] = $row;
        }
    }
    mysqli_close($con);
    return $users;
}


function signup($name, $email, $password, $role)
{
    $con = connection();  
    $created_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO users (name, email, password, role, created_at)
            VALUES ('$name', '$email', '$password', '$role', '$created_at')";

    try {
        if (mysqli_query($con, $sql)) {
            mysqli_close($con);
            return true;   
        } else {
            $error = mysqli_error($con);
            mysqli_close($con);
            if (strpos($error, 'Duplicate entry') !== false) {
                return "duplicate";
            }
            return false;  
        }
    } catch (Exception $e) {
        mysqli_close($con);
        return false;
    }
}

function getAllFoods(){

     $con=connection();
    $sql="SELECT * FROM `menu`";
    $manus=[];
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $manus[] = $row;
        }
    }
    mysqli_close($con);
    return $manus;

}

function SearchEmail($email)
    {
        $con=connection();
    $sql="SELECT COUNT(*) as count FROM users WHERE email = '$email';";
    $result=mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($con);
    if($row['count'] > 0){
        return true;
    }
    return false;
}

function getUserById($userId)
{
    $con = connection();
    $sql = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        mysqli_close($con);
        return $user;
    }
    mysqli_close($con);
    return null;
}

function updateUser($userId, $name, $email, $password,$role)
{
    $con = connection();
    $sql = "UPDATE users 
                    SET name='$name', email='$email', password='$password',role='$role'
                    WHERE user_id=$userId";
    
    try {
        if (mysqli_query($con, $sql)) {
            mysqli_close($con);
            return true;
        } else {
            $error = mysqli_error($con);
            return false;
        }
    } catch (Exception $e) {
        mysqli_close($con);
        return false;
    }
}

function DeleteUser($userId)
{
    $con = connection();
    $sql = "DELETE FROM users WHERE user_id = '$userId';";

     try {
        if (mysqli_query($con, $sql)) {
            mysqli_close($con);
            return true;
        } else {
            $error = mysqli_error($con);
            return false;
        }
    } catch (Exception $e) {
        mysqli_close($con);
        return false;
    }
}

function Addfood($name, $category, $price, $status,$quantity)
{
    $con = connection();  
    

    $sql = "INSERT INTO `menu` (`item_name`, `category`, `price`, `status`, `quantity`) VALUES ('$name', '$category', '$price', '$status', '$quantity');";

    try {
        if (mysqli_query($con, $sql)) {
            mysqli_close($con);
            return true;   
        } else {
            $error = mysqli_error($con);
            mysqli_close($con);
            return false;  
        }
    } catch (Exception $e) {
        mysqli_close($con);
        return false;
    }
}

function Updatefood($foodId, $foodName, $category, $foodPrice, $status, $quantity)
{
    $con = connection();
    $sql = "UPDATE menu 
        SET item_name = '$foodName',
            category  = '$category',
            price     = '$foodPrice',
            status    = '$status',
            quantity  = '$quantity'
        WHERE menu_id = '$foodId'";



     try {
        if (mysqli_query($con, $sql)) {
            mysqli_close($con);
            return true;   
        } else {
            $error = mysqli_error($con);
            mysqli_close($con);
            return false;  
        }
    } catch (Exception $e) {
        mysqli_close($con);
        return false;
    }
}


function DeleteFood($manuId)
{
    $con = connection();
    $sql = "DELETE FROM menu WHERE menu_id = '$manuId';";

     try {
        if (mysqli_query($con, $sql)) {
            mysqli_close($con);
            return true;
        } else {
            $error = mysqli_error($con);
            return false;
        }
    } catch (Exception $e) {
        mysqli_close($con);
        return false;
    }
}

function getSalesList()
    {
        $con = connection();
        $sql = "SELECT o.order_id, o.menu_id, o.employee_id, o.order_date, o.total_amount,
                       m.item_name, m.category
                FROM orders o
                LEFT JOIN menu m ON o.menu_id = m.menu_id
                ORDER BY o.order_date DESC";

        $sales = [];
        $result = mysqli_query($con, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sales[] = $row;
            }
        }
        mysqli_close($con);
        return $sales;
    }



?>