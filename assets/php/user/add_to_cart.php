<?php
include_once('../connection.php');

    if(isset($_GET['product_id']) && isset($_GET['product_name']) && isset($_GET['price']) && isset($_GET['product_image'])){
        $product_id = $_GET['product_id'];
        $product_name = $_GET['product_name'];
        $price = $_GET['price'];
        $product_image = $_GET['product_image'];
        $user_id = $_SESSION['user_id'];

        $check_ordered_sql = "SELECT * FROM `cart` WHERE `product_id` ='$product_id' && `user_id` ='$user_id'";
        $check_ordered_result = mysqli_query($conn,$check_ordered_sql);
        $count_oredered = mysqli_num_rows($check_ordered_result);
        if($count_oredered == 0){
            $add_to_cart_sql = "INSERT INTO `cart`(`sno`, `product_id`,`user_id`, `product_name`, `product_price`, `product_image`, `product_quantity`) VALUES (Null,'$product_id','$user_id','$product_name','$price','$product_image',1)";
            $add_to_cart_result = mysqli_query($conn,$add_to_cart_sql);

            if($add_to_cart_result == 1){
                header("Location: cart.php");
            }
        }
        else if($count_oredered == 1){
            $ab = $check_ordered_result->fetch_assoc();
            $product_q = $ab['product_quantity']+1;
            $update_sql = "UPDATE `cart` SET `product_quantity`='$product_q' WHERE `product_id` ='$product_id' && `user_id` ='$user_id'";
            mysqli_query($conn,$update_sql);
            header("Location: cart.php");
        }
        else{
            header("Location: cart.php");
        }
   
        
    }

    if(isset($_GET['value']) && isset($_GET['sno'])){
        $product_quantity = $_GET['value'];
        $sno = $_GET['sno'];

        $update_oredered_sql = "UPDATE `cart` SET `product_quantity`='$product_quantity' WHERE `sno` = '$sno'";
        $update_oredered_result = mysqli_query($conn,$update_oredered_sql);

        if($update_oredered_result){
            header("Location: cart.php");
        }

    }
?>