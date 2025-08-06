<?php
include_once('../connection.php');
$name = $_POST["name"];
$email =$_POST["email"];
$password =md5($_POST["password"]);

$sql_registration_checker = "SELECT * FROM `admin_registration` WHERE `name`= '$name' AND `email` ='$email'";
$result_registration = mysqli_query($conn,$sql_registration_checker);
$count = mysqli_num_rows($result_registration);
if($count == 0){

    $sql = "INSERT INTO `admin_registration`(`sno`, `name`, `email`, `password`) VALUES (NULL ,'$name','$email','$password')";

    $result = mysqli_query($conn,$sql);
    
    if($result == 1){
       
        header("Location: admin_login.php");
    }
    else{
        echo "error in insertion";
    }
}
else{
    echo "User already exist";
}




?>