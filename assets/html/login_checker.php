<?php
include_once("connection.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM `user_registration` WHERE `email` = '$email'  ";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);

    if($count == 1){
        $sql_user = "SELECT * FROM `user_registration` WHERE `email` = '$email'";
        $result_user =mysqli_query($conn,$sql_user);
        $row = $result_user->fetch_assoc();

        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];

        header("Location: homepage.php");

    }
    else{
        header("Location: ../../index.php");
    }

}

?>