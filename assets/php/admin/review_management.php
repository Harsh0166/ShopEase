<?php
include_once('../connection.php');

if(!isset($_SESSION['admin_name'])){
  header("Location: admin_login.php");
}
if(isset($_GET['review_id'])){
  $review_id = $_GET['review_id'];

  $delete_review_sql = "DELETE FROM `review` WHERE `sno` = '$review_id'";
  $delete_review_result =  mysqli_query($conn,$delete_review_sql);
  
  if($delete_review_result){
     echo "
    <script> alert('Review Deleted')
    window.location.href = 'review_management.php' </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ShopEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../../css/admin_header.css">
    <link rel="stylesheet" href="../../css/sidebar.css">

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
      /* margin-bottom: 2rem; */
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
    <a href="manage_user.php">Manage Users</a>
    <a href="review_management.php">Manage Review</a>    
    <a href="contact_management.php">Manage Contact</a>

  </div>

  <!-- Main Content -->
  <div class="dashboard-content">
    <div class="dashboard-header">
      <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
      </div>  
      <h1>Review Management</h1>
      <a href="admin_logout.php"><button class="btn">Logout</button></a>
    </div>



  <?php
  ?>
  <div class="order-table-container">
    <table>
      <thead>
         <tr>
      <th>#</th>
      <th>User</th>
      <th>Product ID</th>  
      <th>Product Name</th>
      <th>Stars</th>
      <th>Review</th>

      <th>Action</th>
    </tr>
      </thead>
      <tbody>
<?php
  $manage_review_sql = "SELECT * FROM `review`";
  $manage_review_result = mysqli_query($conn,$manage_review_sql);

  while($row = $manage_review_result->fetch_assoc()){
    $review_id = $row['sno'];
    $review_username = $row['name'];
    $review_product_id = $row['product_id'];
    $review_product_name = $row['product_name'];
    $review_stars = $row['stars'];
    $review_description = $row['description'];


    echo '<tr>
        <td>'.$review_id.'</td>
        <td>'.$review_username.'</td>
        <td>'.$review_product_id.'</td>
        <td>'.$review_product_name.'</td>
        <td>'.$review_stars.'</td>
        <td style="max-width: 300px;">'.$review_description.'</td> 
       
        <td>
          <a href="review_management.php?review_id='.$review_id.'"><button class="btn edit-btn">Delete</button></a>
        </td>
      </tr>';
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
