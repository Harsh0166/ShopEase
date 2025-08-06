<?php
include_once('../connection.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = md5($_POST['password']);


    $sql = "SELECT * FROM `admin_registration` WHERE `email` = '$email'  ";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);

        if($count == 1){
        $sql_user = "SELECT * FROM `admin_registration` WHERE `email` = '$email'";
        $result_user =mysqli_query($conn,$sql_user);
        $row = $result_user->fetch_assoc();

        $_SESSION['admin_name'] = $row['name'];
        $_SESSION['admin_email'] = $row['email'];

        header("Location: admin_pg.php");

        }
        else{
            echo "<script>
            alert('User not found');
            window.location.href = 'admin_login.php';
            </script>";
        }



    

}

?>