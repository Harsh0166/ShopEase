<?php
include_once("connection.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST["fullname"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zipcode = $_POST["zipcode"];
    $country = $_POST["country"];
    $shipping = 0;
    $subtotal =0;
    $totalprice=0;
    $user_id = $_SESSION['user_id'];

    $retrive_product_sql = "SELECT * FROM `cart` WHERE `user_id`";
    $retrive_product_result = mysqli_query($conn,$retrive_product_sql);

    $product_name_array = [];
    $product_price_array = [];
    $product_quantity_string = [];
    while($row = $retrive_product_result->fetch_assoc()){
        $product_name_array[] = $row['product_name'];
        $product_price_array[] = $row['product_price'];
        $product_quantity_array[] = $row['product_quantity'];

        $subtotal += $row['product_price'] *$row['product_quantity'];
        $totalprice = $subtotal+$shipping;
    }
    $product_name_string = implode(", ", $product_name_array);
    $product_price_string = implode(", ", $product_price_array);
    $product_quantity_string = implode(", ", $product_quantity_array);

    
    // $shipping_checker_sql = "SELECT * FROM `ordered` WHERE `user_id`";
    // $shipping_checker_result = mysqli_query($conn,$shipping_checker_sql);
    // $count = mysqli_num_rows($shipping_checker_result);
    
    // if($count==0){
        $shipping_detail_sql = "INSERT INTO `ordered`(`sno`, `full_name`, `email`, `address`, `city`, `state`, `zip_code`, `country`, `product_name_string`, `product_price_string`, `product_quantity_string`, `tracking_status`, `user_id`, `status`) VALUES (Null,'$name','$email','$address','$city','$state','$zipcode','$country','$product_name_string','$product_price_string','$product_quantity_string','1','$user_id','1')";
        $shipping_detail_result = mysqli_query($conn,$shipping_detail_sql);

        if($shipping_detail_result){
            header("Location: order_pg.php");
        }
    // }
    else{
        header("Location: order_pg.php");
    }
}

?>