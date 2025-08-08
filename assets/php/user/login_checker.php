<?php
include_once('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `user_registration` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $status = $row['status'];

        if ($status == 1) {

            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_id'] = $row['S.no.'];

            header("Location: homepage.php");
            exit();

        } else {
            echo "<script>
                alert('You are blocked. Contact Admin');
                window.location.href='contact.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('User not found');
            window.location.href = '../../../index.php';
        </script>";
    }
}
?>
