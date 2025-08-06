<?php
include_once('../connection.php');

  if(!isset($_SESSION['username'])){
  header("Location: ../../../index.php");
}
    $user_id = $_SESSION["user_id"];
    $show_ordered_sql = "SELECT * FROM `cart` WHERE `user_id` ='$user_id'";
    $show_ordered_result = mysqli_query($conn,$show_ordered_sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShopEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>

    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f5f5;

    }

    header, footer {
      background-color: #111;
      color: white;
      padding: 1rem;
      text-align: center;
    }

    .checkout-container {
      max-width: 800px;
      margin: 2rem auto;
      background-color: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      margin-bottom: 1.5rem;
      text-align: center;
    }
    .form{
        width: 100% ;
    }
    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
    }

    .form-group input, .form-group select {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .order-summary {
      margin-top: 2rem;
    }

    .order-summary h3 {
      margin-bottom: 1rem;
    }

    .order-summary ul {
      list-style: none;
      padding: 0;
    }

    .order-summary ul li {
      display: flex;
      justify-content: space-between;
      padding: 0.5rem 0;
      border-bottom: 1px solid #eee;
    }

    .checkout-btn {
      display: block;
      width: 100%;
      padding: 1rem;
      background-color: #111;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 1.1rem;
      cursor: pointer;
      margin-top: 2rem;
    }
  </style>
</head>
<body>

<header>
  <h1>ShopEase Checkout</h1>
</header>
<?php
    $name = $_SESSION['username'];
    $email = $_SESSION['email'];
    $shipping_checker_sql = "SELECT * FROM `ordered` WHERE `user_id`='$user_id'";
    $shipping_checker_result = mysqli_query($conn,$shipping_checker_sql);
      if($row = $shipping_checker_result->fetch_assoc()){
        $username = $row['full_name'];
        $email = $row['email'];
        $address = $row['address'];
        $city = $row['city'];
        $state = $row['state'];
        $zipcode = $row['zip_code'];
        $country = $row['country'];

      }
      else{
        $username = $_SESSION['username'] ?? '';
        $email = $_SESSION['email'] ?? '';
        $address = $city = $state = $zipcode = $country = '';
      }
?>
<div class="checkout-container">
  <h2>Shipping Details</h2>
  <form class="form" action="checkout_checker.php" method="POST">
    <div class="form-group">
      <label for="name">Full Name</label>
      <input type="text" id="name" placeholder="Enter your full name" name="fullname" value="<?php echo htmlspecialchars($username)?>" required>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" placeholder="Enter your email" name="email" value="<?php echo htmlspecialchars($email) ?>" required>
    </div>

    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" id="address" placeholder="Enter your address" name="address" value="<?php echo htmlspecialchars($address) ?>" required>
    </div>

    <div class="form-group">
      <label for="city">City</label>
      <input type="text" id="city" placeholder="Enter your city" name="city" value="<?php echo htmlspecialchars($city) ?>" required>
    </div>

    <div class="form-group">
      <label for="state">State</label>
      <input type="text" id="city" placeholder="Enter your state" name="state" value="<?php echo htmlspecialchars($state) ?>" required>
    </div>

    <div class="form-group">
      <label for="zip">ZIP Code</label>
      <input type="text" id="zip" placeholder="Enter your ZIP code" name="zipcode" value="<?php echo htmlspecialchars($zipcode) ?>" required>
    </div>

    <div class="form-group">
      <label for="country">Country</label>
      <select id="country" name="country" value="<?php echo htmlspecialchars($country)?>" required>
        <option value="">Select country</option>
        <option value="India">India</option>
        <option value="USA">USA</option>
        <option value="UK">UK</option>
      </select>
    </div>

    <div class="order-summary">
      <h3>Order Summary</h3>
      <ul>
        <?php
          $shipping = 0;
          $subtotal =0;
          $totalprice=0;

           while($row = $show_ordered_result->fetch_assoc()){
            $subtotal += $row['product_price'] *$row['product_quantity'];
            $totalprice = $subtotal+$shipping;
            echo'
            <li><span>'.$row["product_name"].' x '.$row["product_quantity"].'</span><span>'.$row["product_price"] * $row["product_quantity"].'</span></li>';
        }
        echo '
          <li><strong>Total</strong><strong>'.$totalprice.'</strong></li>';
        ?>
        
      </ul>
    </div>

    <button type="submit" class="checkout-btn">Place Order</button>
  </form>
</div>

<footer>
  &copy; 2025 ShopEase. All rights reserved.
</footer>

</body>
</html>
