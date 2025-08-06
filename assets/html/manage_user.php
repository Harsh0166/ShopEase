<?php
include_once("connection.php");

if(isset($_GET['user_id']) && isset($_GET['status'])){
  $user_id = $_GET['user_id'];
  $status = $_GET['status'];

  if($status == 0){
    $update_user_unblock_sql = "UPDATE `user_registration` SET `status` ='1' WHERE `S.no.` = '$user_id'";
  $update_user_unblock_result = mysqli_query($conn,$update_user_unblock_sql);
  }
  else{
    $update_user_block_sql = "UPDATE `user_registration` SET `status` ='0' WHERE `S.no.` = '$user_id'";
    $update_user_block_result = mysqli_query($conn,$update_user_block_sql);
    
  }
 
  if($update_user_block_result){
    echo "
    <script> alert('User Is Blocked')
    window.location.href = 'manage_user.php' </script>";
  }else{
        echo "
    <script> alert('User Is Unblocked')
    window.location.href = 'manage_user.php' </script>";
  }
}
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
    <a href="manage_user.php">Manage Users</a>
    <a href="review_management.php">Manage Review</a>
  </div>

  <!-- Main Content -->
  <div class="dashboard-content">
    <div class="dashboard-header">
      <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
      </div>  
      <h1>User Management</h1>
      <button class="btn">Logout</button>
    </div>



  <?php
  ?>
  <div class="order-table-container">
    <table>
      <thead>
        <tr>
          <th>User ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Status</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>

<?php
  $manage_user_sql = "SELECT * FROM `user_registration`";
  $manage_user_result = mysqli_query($conn,$manage_user_sql);

  while($row = $manage_user_result->fetch_assoc()){
    $user_id = $row['S.no.'];
    $username = $row['username'];
    $email = $row['email'];
    $status = $row['status'];
    $date_time = $row['date_time'];
    
    echo '<tr>
        <td>'.$user_id.'</td>
        <td>'.$username.'</td>
        <td>'.$email.'</td>
        <td><span class="status active">';
        
        if($status == 1){
          echo 'Active';
        }
        else{
          echo 'Blocked';
        }
        

        echo '</span></td> 
        <td>'.$date_time.'</td>
        <td>';
          
          if($status == 1){
            echo '<a href="manage_user.php?user_id='.$user_id.'&status='.$status.'"><button class="btn edit-btn">Block </button></a>';
          }
          else{
            echo '<a href="manage_user.php?user_id='.$user_id.'&status='.$status.'"><button class="btn edit-btn">Unblock </button></a>';
          }
          
          echo '
          <!-- <button class="btn delete-btn">Delete</button> -->
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
