<?php
include_once('../connection.php');
if(!isset($_SESSION['username'])){
  header("Location: ../../../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ShopEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #f5f5f5;
      overflow-x: hidden;
    }

    /* Header & Nav */
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

    .search-bar {
      width: 100%;
      margin: 0.5rem 0;
    }

    .search-bar input {
      width: 100%;
      padding: 0.5rem;
      border-radius: 4px;
      border: none;
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

    /* Order Page Styling */
    .order-container {
      padding: 3rem 1rem;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }

    .order-details {
      background-color: white;
      border-radius: 10px;
      padding: 2rem;
      width: 100%;
      max-width: 900px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .order-details h2 {
      font-size: 2rem;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .order-summary {
      margin-bottom: 2rem;
    }

    .order-summary h3 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }

    .order-summary p {
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }

    .order-status {
      font-size: 1.2rem;
      margin-bottom: 1.5rem;
    }

    .order-status p {
      font-weight: bold;
    }

    .order-items {
      margin-bottom: 2rem;
    }

    /* Responsive table container */
    .order-items-wrapper {
      overflow-x: auto; /* Makes the table scrollable on small screens */
    }

    .order-items table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 1rem;
    }

    .order-items table th,
    .order-items table td {
      padding: 0.75rem;
      border: 1px solid #ddd;
      text-align: left;
    }

    .order-items table th {
      background-color: #f0f0f0;
    }

    .track-btn {
      display: block;
      width: 100%;
      padding: 0.75rem;
      background-color: #111;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
    }

    footer {
      background-color: #111;
      color: white;
      text-align: center;
      padding: 1rem;
    }

    /* Mobile view */
    @media (max-width: 768px) {
      .top-bar {
        flex-direction: row;
        justify-content: space-between;
      }

      .search-bar {
        order: 2;
        width: 100%;
        margin: 0.5rem 0;
      }

      nav {
        display: none;
      }

      .menu-toggle {
        display: block;
      }
    }

    @media (min-width: 769px) {
      .top-bar {
        flex-direction: row;
      }

      .search-bar {
        width: 50%;
      }

      nav {
        display: flex;
      }

      .menu-toggle {
        display: none;
      }
    }
  </style>
</head>
<body>

  <header>
    <div class="top-bar">
      <div class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
      <div class="logo"><i class="fas fa-store"></i> ShopEase</div>
      <div class="search-bar"><input type="text" placeholder="Search products..."></div>
      <nav>
        <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
        <a href="cart.php"><i class="fas fa-cart-shopping"></i> Cart</a>
        <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
      </nav>
    </div>
  </header>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
    <a href="cart.php"><i class="fas fa-cart-shopping"></i> Cart</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
  </div>
  <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

  <!-- Order Content -->
  <section class="order-container">
    <div class="order-details">
      <h2>Order Summary</h2>

      <!-- Order Status -->
      <div class="order-status">
        <p>Status: <strong>Ordered</strong></p>
        <p>Expected Delivery: <strong>3-5 business days</strong></p>
      </div>

  
      <?php
        $user_id = $_SESSION["user_id"];
        $show_ordered_detail_sql = "SELECT * FROM `ordered` WHERE `user_id` = $user_id";
        $show_ordered_detail_result = mysqli_query($conn,$show_ordered_detail_sql);
        while($row = $show_ordered_detail_result->fetch_assoc()){
            $product_name_array = explode(", ", $row['product_name_string'] );
            $product_price_array = explode(", ",$row['product_price_string'] );
            $product_qyantity_array = explode(", ",$row['product_quantity_string'] );
            $order_id = $row['sno'];
            $address = $row['address'];
            $city = $row['city'];
            $state = $row['state'];
            $zipcode = $row['zip_code'];
            $date_time = $row['date_time'];
        }
        $total_product = count($product_name_array);

        $total_price = 0;
        for($j=0;$j<$total_product;$j++){
          $total_price += $product_price_array[$j];
        }
   
        echo '
      <div class="order-summary">
        <h3>Order ID: #'.$order_id.'</h3>
        <p>Date: <strong>'.$date_time.'</strong></p>
        <p>Total: <strong>'.$total_price.'</strong></p>
        <p>Shipping Address: <strong>'.$address.', '.$city.', '.$state.', '.$zipcode.'</strong></p>
      </div>';
   ?>
      <!-- Order Items -->
      <div class="order-items-wrapper">
        <div class="order-items">
          <table>
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
                
                for($i=0;$i<$total_product;$i++){
                  echo'
                <tr>
                <td>'.$product_name_array[$i].'</td>
                <td>'.$product_price_array[$i].'</td>
                <td>'.$product_qyantity_array[$i].'</td>
                <td>'.$product_price_array[$i] * $product_qyantity_array[$i].'</td>
                </tr>';                
                }
                ?>
                
              
            </tbody>
          </table>
        </div>
      </div>

      <!-- Track Order Button -->
      <button class="track-btn">Track Your Order</button>
    </div>
  </section>

  <footer>
    &copy; 2025 ShopEase. All rights reserved.
  </footer>

  <script>
    function toggleMenu() {
      document.getElementById('sidebar').classList.toggle('open');
      document.getElementById('overlay').classList.toggle('active');
    }
  </script>

</body>
</html>
