<?php
  include_once("connection.php");
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order History - ShopEase</title>
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

    /* Order History Page */
    .order-history-container {
      padding: 3rem 1rem;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }

    .order-history {
      background-color: white;
      border-radius: 10px;
      padding: 2rem;
      width: 100%;
      max-width: 900px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .order-history h2 {
      font-size: 2rem;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    /* Table styling */
    .order-history-table-wrapper {
      overflow-x: auto; 
      margin-bottom: 2rem;
    }

    .order-history-table {
      width: 100%;
      border-collapse: collapse;
    }

    .order-history-table th, .order-history-table td {
      padding: 1rem;
      border: 1px solid #ddd;
      text-align: left;
    }

    .order-history-table th {
      background-color: #f0f0f0;
    }

    .order-history-table td {
      font-size: 1.1rem;
    }

    .order-history-table a {
      color: #111;
      text-decoration: none;
    }

    .order-history-table a:hover {
      text-decoration: underline;
    }

    .status-label {
      padding: 0.25rem 0.5rem;
      font-size: 1.1rem;
      border-radius: 5px;
    }

    .status-shipped {
      background-color: #2ecc71;
      color: white;
    }

    .status-delivered {
      background-color: #3498db;
      color: white;
    }

    .status-pending {
      background-color: #f39c12;
      color: white;
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

  <!-- Order History Content -->
  <section class="order-history-container">
    <div class="order-history">
      <h2>Your Order History</h2>

      <div class="order-history-table-wrapper">
        <table class="order-history-table">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Date & Time</th>
              <th>Total</th>
              <th>Status</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $user_id = $_SESSION['user_id'];
              // $total_price = 0;
                $show_ordered_detail_sql = "SELECT * FROM `ordered` WHERE `user_id` = $user_id";
                $show_ordered_detail_result = mysqli_query($conn,$show_ordered_detail_sql);
                while($row = $show_ordered_detail_result->fetch_assoc()){
                  $product_price_array = explode(", ",$row['product_price_string'] );
                  $product_qyantity_array = explode(", ",$row['product_quantity_string'] );

                  $order_id = $row['sno'];
                  $date_time = $row['date_time'];
                  $status = $row['status'];

                  $total_price = 0;
                  for($j=0;$j<count($product_price_array);$j++){
                    $total_price += $product_price_array[$j]*$product_qyantity_array[$j];
                  }
                
                  echo'
                  <tr>
                    <td>#'.$order_id.'</td>
                    <td>'.$date_time.'</td>
                    <td>'.$total_price.'</td>
                    <td><span class="status-label status-shipped">'.$status.'</span></td>
                    <td><a href="track_order.php?order_id='.$order_id.'">View Order</a></td>
                  </tr>
                  ';
                }

                
            ?>
          </tbody>
        </table>
      </div>
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
