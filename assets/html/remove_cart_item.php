<?php
include_once("connection.php");
    if(isset($_GET['sno'])){
        $cart_no = $_GET['sno'];

        $remove_item_sql = "DELETE FROM `cart` WHERE `sno` = $cart_no";
        $remove_item_result = mysqli_query($conn,$remove_item_sql);

        if($remove_item_result){
            header("Location: cart.php");
        }
    }
?>