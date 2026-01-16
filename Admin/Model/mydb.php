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



?>