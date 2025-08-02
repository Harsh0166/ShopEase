<?php
    include_once("connection.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $product_id = $_POST["product_id"];
        $product_name = $_POST["product_name"];
        $product_price = $_POST["price"];
        $product_stock = $_POST["stock"];
        $product_categoory = $_POST["category"];
        $product_description = $_POST["description"];
        $product_image = $_POST["image"];

        $product_add_sql = "UPDATE `product_detail` SET `product_name`='$product_name',`price`='$product_price',`stock_quantity`='$product_stock',`category`='$product_categoory',`description`='$product_description',`image`='[value-7]' WHERE `s. no.` = '$product_id'";
        $product_add_result = mysqli_query($conn,$product_add_sql);
       

        if($product_add_result){

            header("Location: product_manage.php?product_id=$product_id&msg=1");
        }
        else{
             header("Location: product_manage.php?product_id=$product_id&msg=2");
        }

    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Products - Admin | ShopEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
    }

    h1 {
      margin-bottom: 1.5rem;
      font-size: 2rem;
      color: #111;
    }

    .form-container {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      max-width: 700px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
    }

    form input,
    form select,
    form textarea {
      width: 100%;
      padding: 0.75rem;
      margin-bottom: 1.5rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    form textarea {
      resize: vertical;
    }

    .btn {
      background-color: #111;
      color: white;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
    }

    .btn:hover {
      background-color: #333;
    }

    @media (max-width: 768px) {
      .form-container {
        padding: 1rem;
      }
    }
  </style>
</head>
<body>

 <div class="sidebar" id="sidebar">
    <div class="logo"><i class="fas fa-cogs"></i>Admin</div>
    <div class="close-btn" onclick="toggleMenu()"><i class="fas fa-times"></i></div>
    <a href="admin_pg.php">Dashboard</a>
    <a href="product_manage.php">Manage Products</a>
    <a href="order_management.php">Manage Orders</a>
    <a href="#">Manage Users</a>
    <a href="#">Sales Analytics</a>
  </div>
<div class="dashboard-content">
    <div class="dashboard-header">
      <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
      </div>
      <h1>Manage product</h1>
      <button class="btn">Logout</button>
    </div>
<?php
    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
        $load_product_sql = "SELECT * FROM `product_detail`WHERE `s. no.`= '$product_id'";
        $load_product_result = mysqli_query($conn,$load_product_sql);
        while($row = $load_product_result->fetch_assoc()){
            $product_no = $row['s. no.'];
            $product_name = $row['product_name'];
            $price = $row['price'];
            $stock = $row['stock_quantity'];
            $category = $row['category'];
            $description = $row['description'];
            
        }
    }
?>
  <div class="form-container">
    <form id="addProductForm" action="" method="POST">
      <label for="name">Product Name</label>
      <input type="hidden" value="<?php echo $product_no; ?>" name="product_id" >
      <input type="text" id="name" name="product_name" value="<?php echo $product_name?>" required />

      <label for="price">Price</label>
      <input type="number" id="price" name="price" value="<?php echo $price ?>" required />

      <label for="stock">Stock Quantity</label>
      <input type="number" id="stock" name="stock" value="<?php echo $stock ?>" required />

      <label for="category">Category</label>
      <select id="category" name="category" value="<?php echo $category ?>" required>
        <option value="">Select a category</option>
        <option value="electronics">Electronics</option>
        <option value="fashion">Fashion</option>
        <option value="home">Home & Living</option>
        <option value="other">Other</option>
      </select>

      <label for="description">Description</label>
      <textarea id="description" name="description" rows="4" value="<?php echo $description ?>" required></textarea>

      <label for="image">Product Image</label>
      <input type="file" id="image" name="image" accept="image/*" required />

      <button type="submit" class="btn">Add Product</button>
    </form>
  </div>

  <script>
    var loc = window.location.href;
    loc=loc.split("?")[1].split("&")[1].split("=")[1];
    if(loc == 1){
        alert("update successfully");
    }
    else if(loc== 2){

          alert("Not updated");
    }

      function toggleMenu() {
      document.getElementById('sidebar').classList.toggle('open');
    }
  </script>

</body>
</html>
