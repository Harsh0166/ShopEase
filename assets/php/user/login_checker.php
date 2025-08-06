<?php
include_once('../connection.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM `user_registration` WHERE `email` = '$email'  ";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);

    while($row = $result->fetch_assoc()){
        $status = $row['status'];
    }

    if($status == 1){
        if($count == 1){
        $sql_user = "SELECT * FROM `user_registration` WHERE `email` = '$email'";
        $result_user =mysqli_query($conn,$sql_user);
        $row = $result_user->fetch_assoc();

        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_id'] = $row['S.no.'];

        header("Location: homepage.php");

        }
        else{
            echo "<script>
            alert('User not found');
            window.location.href = '../../../index.php';
            </script>";
        }
    }
    else{
        echo "
        <script> alert('You are blocked. Contact Admin');
        window.location.href='contact.php';
        </script>";
        
    }

    

}

?>