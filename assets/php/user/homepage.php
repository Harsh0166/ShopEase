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
  <link rel="stylesheet" href="../../css/homepage_sidebar.css">
  <link rel="stylesheet" href="../../css/navbar.css">
  <link rel="stylesheet" href="../../css/slider.css">
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
    a{
      text-decoration: none;
      color: black;
    }
    .hero {
      background: linear-gradient(135deg, #ff9a9e, #fad0c4);
      color: #333;
      text-align: center;
      padding: 3rem 1rem;
    }

    .hero h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .hero p {
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
    }

    .hero button {
      background-color: #111;
      color: white;
      padding: 0.8rem 1.5rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    
    footer {
      background-color: #111;
      color: white;
      text-align: center;
      padding: 1rem;
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

  <section class="hero">
    <h2>🔥 Mega Deals Everyday!</h2>
    <p>Shop the latest electronics, fashion, and more</p>
    <button>Explore Now</button>
  </section>

  <div id="categorySections">
  <h3>Electronics</h3><br>
  <div class="product-row">
    <?php
      $load_product_sql = "SELECT * FROM `product_detail` WHERE `category` = 'electronics'";
      $load_product_result = mysqli_query($conn,$load_product_sql);
      while($row = $load_product_result->fetch_assoc()){
        $sno = $row['s. no.'];
        $product_name = $row['product_name'];
        $price = $row['price'];
        $electronic_image = $row['image'];

        echo '<div class="product-card">
          <a href="product_detail.php?sno='.$sno.'">
          <img src="../../img/'.$electronic_image.'" alt="image not found">
          <h4>'.$product_name.'</h4>
          <p> Rs '.$price.'</p>
          <a href="add_to_cart.php?product_id='.$sno.'&product_name='.$product_name.'&price='.$price.'&product_image='.$electronic_image.'" class="add_cart_btn">Add to Cart</a>
          </a>
          </div>';
      };

    ?>
  </div>
</div>

<div id="categorySections">
  <h3>Toys</h3><br>
  <div class="product-row">
       <?php
      $load_product_sql = "SELECT * FROM `product_detail` WHERE `category` = 'other'";
      $load_product_result = mysqli_query($conn,$load_product_sql);
      while($row = $load_product_result->fetch_assoc()){
        $sno = $row['s. no.'];
        $product_name = $row['product_name'];
        $price = $row['price'];
        $other_image = $row['image'];


        echo '<div class="product-card">
          <a href="product_detail.php?sno='.$sno.'">
          <img src="../../img/'.$other_image.'" alt="image not found">
          <h4>'.$product_name.'</h4>
          <p> Rs '.$price.'</p>
          <a href="add_to_cart.php?product_id='.$sno.'&product_name='.$product_name.'&price='.$price.'&product_image='.$other_image.'" class="add_cart_btn">Add to Cart</a>
          </a>
          </div>';
      };

    ?>
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
  </script>

</body>
</html>
