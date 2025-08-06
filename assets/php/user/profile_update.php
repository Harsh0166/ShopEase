<?php
include_once('../connection.php');
    $name = $_SESSION['username'];
    $original_email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
    $update_profile_sql = "UPDATE `user_registration` SET `username`='$username',`email`='$email',`address`='$address' WHERE `username`= '$name' AND `email` ='$original_email'";
    $update_profile_result = mysqli_query($conn,$update_profile_sql);
    if($update_profile_result){
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['address'] = $address;
             echo "<script>
        alert('Profile Updated Successfully');
        window.location.href = 'profile.php';
        </script>";
    }
  }

?>