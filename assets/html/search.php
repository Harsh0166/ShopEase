<?php
include_once("connection.php");

$search = $_GET['query'] ?? '';

$sql = "SELECT * FROM product_detail 
        WHERE product_name LIKE '%$search%' 
        OR category LIKE '%$search%' 
        OR description LIKE '%$search%'";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results - ShopEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/homepage_sidebar.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f1f3f6;
      box-sizing: border-box;
    }

    .container {
      max-width: 1100px;
      margin: 20px auto;
      padding: 0 20px;
    }

    .product-card {
      display: flex;
      justify-content: space-between;
      background: #fff;
      padding: 20px;
      margin-bottom: 15px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .product-image img {
      width: 150px;
      height: 200px;
      object-fit: cover;
      border-radius: 5px;
    }

    .product-details {
      flex: 1;
      padding: 0 20px;
    }

    .product-title {
      font-size: 18px;
      color: #2874f0;
      font-weight: bold;
    }

    .rating {
      display: inline-block;
      background: #388e3c;
      color: #fff;
      padding: 2px 6px;
      border-radius: 4px;
      font-size: 12px;
      margin-top: 5px;
    }

    .specs {
      list-style: none;
      padding: 0;
      margin: 10px 0;
      font-size: 14px;
      color: #555;
    }

    .price-section {
      text-align: right;
      min-width: 200px;
    }

    .new-price {
      font-size: 22px;
      font-weight: bold;
      color: #212121;
    }

    .old-price {
      font-size: 14px;
      color: #878787;
      text-decoration: line-through;
    }

    .discount {
      font-size: 14px;
      color: #388e3c;
      margin-left: 5px;
    }

    .offer {
      font-size: 13px;
      color: #d32f2f;
    }
    a{
        text-decoration: none;
    }

    @media (max-width: 768px) {
      .product-card {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .product-image img {
        width: 100%;
        height: auto;
      }

      .price-section {
        text-align: center;
        margin-top: 10px;
      }
    }
        /* Responsive */
    @media (max-width: 768px) {
      .pc-navbar {
        display: none;
      }

      .mobile-navbar {
        display: flex;
      }
    }

    @media (min-width: 769px) {
      .mobile-navbar {
        display: none;
      }
    }
  </style>
</head>
<body>
    <!-- Desktop Navbar -->
  <div class="pc-navbar">
    <div class="logo"><i class="fas fa-store"></i> ShopEase</div>
    <div class="search-bar">
      <form action="search.php" method="GET">
        <input type="text" name="query" placeholder="Search products..." required>
        <button type="submit" class="search-btn">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>


    <nav>
      <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
      <a href="cart.php"><i class="fas fa-cart-shopping"></i> Cart</a>
      <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    </nav>
  </div>

  <!-- Mobile Navbar -->
  <div class="mobile-navbar">
    <div class="mobile-top">
      <div class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
      <div class="logo"><i class="fas fa-store"></i> ShopEase</div>
    </div>
    <div class="search-bar">
      <form action="search.php" method="GET">
        <input type="text" name="query" placeholder="Search products..." required>
        <button type="submit" class="search-btn">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <div class="sidebar" id="sidebar">
    <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
    <a href="cart.php"><i class="fas fa-cart-shopping"></i> Cart</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
  </div>
  <div class="overlay" id="overlay" onclick="toggleMenu()"></div>


  <div class="container">

  <?php
  echo'
     <h2>Showing results for "'.$search.'"</h2>';

    while($row = $result->fetch_assoc()){
        $product_id = $row['s. no.'];
        $product_name = $row['product_name'];
        $product_price = $row['price'];
        $product_image = $row['image'];
        $product_description = $row['description'];

        echo '<a href="product_detail.php?sno='.$product_id.'">
        <div class="product-card">
      <div class="product-image">
        <img src="../img/'.$product_image.'" alt="Product Image">
      </div>
      <div class="product-details">
        <div class="product-title">'.$product_name.'</div>
        <div class="rating">4.4 ★</div>
        <ul class="specs">'.$product_description.'

        </ul>
      </div>
      <div class="price-section">
        <div class="new-price">₹'.$product_price.'</div>
      
      </div>
    </div></a>
        ';

    }

  ?>
    
  </div>
    <script>
    function toggleMenu() {
      document.getElementById('sidebar').classList.toggle('open');
      document.getElementById('overlay').classList.toggle('active');
    }
  </script>
</body>
</html>
