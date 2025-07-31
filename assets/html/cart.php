<?php
include_once("connection.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shopping Cart - ShopEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      background: #f5f5f5;
      overflow-x: hidden;
    }
    header {
      background-color: #111;
      color: white;
      padding: 0.5rem 1rem;
    }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }
    .logo {
      font-size: 1.5rem;
      display: flex;
      align-items: center;
    }
    .logo i {
      margin-right: 0.5rem;
    }
    nav {
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
    }
    nav a {
      color: white;
      text-decoration: none;
      font-size: 1rem;
    }
    nav a i {
      margin-right: 4px;
    }
    .menu-toggle {
      font-size: 2rem;
      cursor: pointer;
      color: white;
      display: none;
    }
    .sidebar {
      position: fixed;
      top: 0;
      left: -100%;
      height: 100vh;
      width: 250px;
      background-color: #222;
      color: white;
      padding: 2rem 1rem;
      transition: 0.3s ease;
      z-index: 999;
    }
    .sidebar.open {
      left: 0;
    }
    .sidebar a {
      display: block;
      margin-bottom: 1.5rem;
      color: white;
      text-decoration: none;
      font-size: 1.2rem;
    }
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0,0,0,0.5);
      display: none;
      z-index: 998;
    }
    .overlay.active {
      display: block;
    }

    /* Cart Section */
    .cart-container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 1rem;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .cart-title {
      font-size: 2rem;
      margin-bottom: 1.5rem;
      text-align: center;
    }
    .cart-items {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }
    .cart-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      border-bottom: 1px solid #ddd;
      padding-bottom: 1rem;
    }
    .cart-item img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 10px;
    }
    .item-details {
      flex: 1;
    }
    .item-details h4 {
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
    }
    .item-details .price {
      color: #e74c3c;
      font-size: 1rem;
    }
    .item-actions {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.5rem;
    }
    .item-actions input {
      width: 50px;
      text-align: center;
      padding: 0.3rem;
    }
    .item-actions button {
      background: #e74c3c;
      color: white;
      border: none;
      padding: 0.3rem 0.6rem;
      border-radius: 5px;
      cursor: pointer;
    }

    /* Cart Summary */
    .cart-summary {
      margin-top: 2rem;
      text-align: right;
    }
    .cart-summary h3 {
      margin-bottom: 1rem;
    }
    .cart-summary p {
      margin: 0.5rem 0;
      font-size: 1rem;
    }
    .checkout-btn {
      margin-top: 1rem;
      background: #111;
      color: white;
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
   
    }
    a{
         text-decoration: none;
         color: #fff;
    }

    footer {
      background-color: #111;
      color: white;
      text-align: center;
      padding: 1rem;
      margin-top: 2rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .top-bar {
        flex-direction: row;
        justify-content: space-between;
      }
      nav {
        display: none;
      }
      .menu-toggle {
        display: block;
      }
      .cart-item {
        flex-direction: column;
        align-items: flex-start;
      }
      .item-actions {
        flex-direction: row;
        gap: 1rem;
      }
      .cart-summary {
        text-align: center;
      }
    }
  </style>
</head>

<body>

<header>
  <div class="top-bar">
    <div class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
    <div class="logo"><i class="fas fa-store"></i> ShopEase</div>
    <nav>
      <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
      <a href="cart.php"><i class="fas fa-cart-shopping"></i> Cart</a>
      <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
  </div>
</header>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
  <a href="cart.php"><i class="fas fa-cart-shopping"></i> Cart</a>
  <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
</div>
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<!-- Cart Section -->
<div class="cart-container">
  <h2 class="cart-title">Your Shopping Cart</h2>

  <div class="cart-items">

  <?php
      $user_id = $_SESSION['user_id'];
        $show_ordered_sql = "SELECT * FROM `cart` WHERE `user_id` ='$user_id'";
        $show_ordered_result = mysqli_query($conn,$show_ordered_sql);
        $subtotal =0;
        $totalprice=0;
        while($row = $show_ordered_result->fetch_assoc()){
          $shipping = 0;
        $subtotal += $row['product_price'] *$row['product_quantity'];
        $totalprice = $subtotal+$shipping;
          echo '
            <div class="cart-item">
            <img src="https://picsum.photos/100?random=1" alt="Product 1">
            <div class="item-details">
              <h4>'.$row['product_name'].'</h4>
              <p class="price"> Rs'.$row['product_price'].'</p>
            </div>
            <div class="item-actions">
              <input type="number" value="'.$row['product_quantity'].'" min="1" sno= "'.$row['sno'].'" onchange="choose(this);">
              <button>Remove</button>
            </div>
          </div>
          ';
    }
    

  
  ?>
  </div>

  <div class="cart-summary">
    <h3>Order Summary</h3>

    <?php
    
        echo '
        <p>Subtotal: Rs'.$subtotal.'</p>
        <p>Shipping: Free</p>
        <p><strong>Total: Rs'.$totalprice.'</strong></p>';


    ?>

    <button class="checkout-btn"><a href="checkout.php">Proceed to Checkout</a></button>
  </div>
</div>

<footer>
  &copy; 2025 ShopEase. All rights reserved.
</footer>

<script>
  function toggleMenu() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('active');
  }

  function choose(a){
    debugger;
    var value = a.value;
    var id = a.getAttribute('sno');

    window.location.href="add_to_cart.php?value="+value+"&sno="+id;
  }
</script>

</body>
</html>
