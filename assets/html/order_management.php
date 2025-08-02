<?php
include_once("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Management | ShopEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../css/admin_header.css">
    <link rel="stylesheet" href="../css/sidebar.css">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #f5f5f5;
      min-height: 100vh;
    }

    h1 {
      text-align: center;
      margin-bottom: 2rem;
      font-size: 2rem;
    }

    .order-table-container {
      overflow-x: auto;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 900px;
    }

    th, td {
      padding: 1rem;
      border: 1px solid #ddd;
      text-align: center;
    }

    th {
      background-color: #111;
      color: white;
    }

    .status {
      padding: 0.5rem;
      border-radius: 6px;
      font-weight: bold;
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

    .Pending { background-color: #f1c40f; color: white; }
    .Shipped { background-color: #3498db; color: white; }
    .Delivered { background-color: #2ecc71; color: white; }
    .Cancelled { background-color: #e74c3c; color: white; }

    .action-btn {
      padding: 0.4rem 0.8rem;
      background-color: #e74c3c;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .action-btn:hover {
      background-color: #c0392b;
    }

    @media (max-width: 768px) {
      table {
        font-size: 0.9rem;
      }

      h1 {
        font-size: 1.5rem;
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
    <a href="#">Manage Users</a>
    <a href="#">Sales Analytics</a>
  </div>

  <!-- Main Content -->
  <div class="dashboard-content">
    <div class="dashboard-header">
      <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
      </div>  
      <h1>Order Management</h1>
      <button class="btn">Logout</button>
    </div>



  <?php
  ?>
  <div class="order-table-container">
    <table>
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer</th>
          <th>Address</th>
          <th>Product</th>
          <th>Qty</th>
          <th>Total</th>
          <th>Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
             $user_id = $_SESSION["user_id"];
        $show_ordered_detail_sql = "SELECT * FROM `ordered`";
        $show_ordered_detail_result = mysqli_query($conn,$show_ordered_detail_sql);
        while($row = $show_ordered_detail_result->fetch_assoc()){
            $product_name_array = explode(", ", $row['product_name_string'] );
            $product_price_array = explode(", ",$row['product_price_string'] );
            $product_qyantity_array = explode(", ",$row['product_quantity_string'] );
            $order_id = $row['sno'];
            $customer_name = $row['full_name'];
            $address = $row['address'];
            $city = $row['city'];
            $state = $row['state'];
            $zipcode = $row['zip_code'];
            $date_time = $row['time'];
        
        $total_product = count($product_name_array);

        $total_price = 0;
        for($j=0;$j<$total_product;$j++){
          $total_price += $product_price_array[$j];
        }

        echo '
        <tr>
          <td> #'.$order_id.'</td>
          <td>'.$customer_name.'</td>
          <td>'.$address.'</td>
          <td>'.$row['product_name_string'].'</td>
          <td>'.$row['product_quantity_string'].'</td>
          <td>Rs '.$total_price.'</td>
          <td>'.$date_time.'</td>
          <td><span class="status Pending">Pending</span></td>
          <td><button class="action-btn">Cancel</button></td>
        </tr>
        
        ';

    }
        ?>
        
      </tbody>
    </table>
  </div>
<script>
     function toggleMenu() {
      document.getElementById('sidebar').classList.toggle('open');
    }
</script>
</body>
</html>
