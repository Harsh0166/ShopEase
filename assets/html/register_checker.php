<?php
include_once("connection.php");
$name = $_POST["name"];
$email =$_POST["email"];
$password =$_POST["password"];

$sql_registration_checker = "SELECT * FROM `user_registration` WHERE `username`= '$name' AND `email` ='$email'";
$result_registration = mysqli_query($conn,$sql_registration_checker);
$count = mysqli_num_rows($result_registration);
if($count == 0){

    $sql = "INSERT INTO `user_registration`(`S.no.`, `username`, `email`, `password`,`address`,`status`) VALUES (NULL ,'$name','$email','$password','','1')";

    $result = mysqli_query($conn,$sql);
    
    if($result == 1){
       
        header("Location: ../../index.php");
    }
    else{
        echo "error in insertion";
    }
}
else{
    echo "User already exist";
}




?>