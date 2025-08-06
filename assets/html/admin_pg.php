<?php
include_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - ShopEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/admin_header.css">
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
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    
    .stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background-color: white;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .stat-card h3 {
      margin-bottom: 1rem;
      font-size: 1.5rem;
    }

    .stat-card p {
      font-size: 1.2rem;
    }

    .product-list {
      margin-bottom: 2rem;
    }

    .product-list table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    .product-list table th, .product-list table td {
      padding: 1rem;
      border: 1px solid #ddd;
      text-align: left;
    }

    .product-list table th {
      background-color: #f0f0f0;
    }

    .btn {
      padding: 0.75rem 1.5rem;
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
      margin-top: auto;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
      .sidebar {
        width: 200px;
      }

      .dashboard-content {
        margin-left: 0;
      }

      .stats {
        grid-template-columns: 1fr;
      }

      .product-list table {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="logo"><i class="fas fa-cogs"></i>Admin</div>
    <div class="close-btn" onclick="toggleMenu()"><i class="fas fa-times"></i></div>
   <a href="admin_pg.php">Dashboard</a>
    <a href="product_manage.php">Manage Products</a>
    <a href="order_management.php">Manage Orders</a>
    <a href="manage_user.php">Manage Users</a>
    <a href="review_management.php">Manage Review</a>
  </div>

  <!-- Main Content -->
  <div class="dashboard-content">
    <div class="dashboard-header">
      <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
      </div>
      <h1>Admin Dashboard</h1>
      <button class="btn">Logout</button>
    </div>
<?php
  $user_id = $_SESSION["user_id"];
  $show_ordered_detail_sql = "SELECT * FROM `ordered`";
  $show_ordered_detail_result = mysqli_query($conn,$show_ordered_detail_sql);
  $total_order = mysqli_num_rows($show_ordered_detail_result); 
  $total_price = 0;
  while($row = $show_ordered_detail_result->fetch_assoc()){
    $product_price_array = explode(", ",$row['product_price_string'] );


    $total_product = count($product_price_array);

   
    for($j=0;$j<$total_product;$j++){
      $total_price +=(float)$product_price_array[$j];
    }

  }
?>


    <!-- Stats Section -->
    <div class="stats">
      <div class="stat-card">
        <h3>Total Orders</h3>
        <p><?php echo $total_order ?></p>
      </div>
      <div class="stat-card">
        <h3>Total Sales</h3>
        <p><?php echo $total_price ?></p>
      </div>
      <div class="stat-card">
        <h3>Pending Orders</h3>
        <p>35</p>
      </div>
    </div>



    <!-- Product List -->
    <div class="product-list">
      <h2>Products Added</h2>
      <table>
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
          </tr>
        </thead>
    <tbody>
<?php
      $load_product_sql = "SELECT * FROM `product_detail`";
      $load_product_result = mysqli_query($conn,$load_product_sql);
      while($row = $load_product_result->fetch_assoc()){
        $product_id = $row['s. no.'];
        $product_name = $row['product_name'];
        $price = $row['price'];
        $stock = $row['stock_quantity'];
        echo
        '<tr>
            <td>'.$product_name.'</td>
            <td>'.$price.'</td>
            <td>'.$stock.'</td>
            <td>
              <a href = "edit_product.php?product_id='.$product_id.'"><button class="btn">Edit</button></a>
              <button class="btn">Delete</button>
            </td>
          </tr>';
      }
?>   
      
        </tbody>
      </table>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    &copy; 2025 ShopEase. All rights reserved.
  </footer>

  <script>
    function toggleMenu() {
      document.getElementById('sidebar').classList.toggle('open');
    }
  </script>

</body>
</html>
