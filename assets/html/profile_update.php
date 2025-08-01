<?php
include_once("connection.php");
    $name = $_SESSION['username'];
    $email = $_SESSION['email'];
  if(isset($_GET['username']) && isset($_GET['email']) && isset($_GET['address'])){
        $username = $_GET['username'];
        $email = $_GET['email'];
        $address = $_GET['address'];
    $update_profile_sql = "UPDATE `user_registration` SET `username`='$username',`email`='$email',`address`='$address' WHERE `username`= '$name' AND `email` ='$email'";
    $update_profile_result = mysqli_query($conn,$update_profile_sql);
    if($update_profile_result){
      header('Location: profile.php');
    }
  }

?>