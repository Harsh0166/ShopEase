<?php
include_once('../connection.php');

$search = $_GET['query'];

$sql = "SELECT * FROM product_detail 
        WHERE product_name LIKE '%$search%' 
        OR category LIKE '%$search%' 
        -- OR description LIKE '%$search%'
        ";

$result = mysqli_query($conn, $sql);
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShopEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../../css/navbar.css">
  <link rel="stylesheet" href="../../css/homepage_sidebar.css">
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

    .product-image {
  width: 160px;
  height: 200px;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  border-radius: 5px;
  background-color: #f9f9f9; /* optional for clean background */
}

.product-image img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
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
      padding: 1px 4px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 700;
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
.search-container {
  position: relative;
  width: 100%;
}

.search-container input {
  width: 100%;
  padding: 8px 45px 8px 15px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
  box-sizing: border-box;
}

.search-container .search-btn {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #555;
  font-size: 18px;
  cursor: pointer;
  padding: 4px;
  line-height: 1;
}

.search-container .search-btn:hover {
  color: white;
  background-color: #111;
  border-radius: 50%;
  width: 35px;
  height: 35px;
}

     /* Responsive */
    @media (max-width: 768px) {
      .pc-navbar {
        display: none;
      }

      .mobile-navbar {
        display: flex;
      }
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
            <div class="search-container">

        <input type="text" name="query" placeholder="Search products..." required>
        <button type="submit" class="search-btn">
          <i class="fas fa-search"></i>
        </button>

            </div>
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
            <div class="search-container">
        <input type="text" name="query" placeholder="Search products..." required>
        <button type="submit" class="search-btn">
          <i class="fas fa-search"></i>
        </button>
            </div>
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
        <img src="../../img/'.$product_image.'" alt="Product Image">
      </div>
      <div class="product-details">
        <div class="product-title">'.$product_name.'</div>';

      $load_review_sql = "SELECT * FROM `review` WHERE `product_id`= '$product_id'";
      $load_review_result = mysqli_query($conn,$load_review_sql);
      $count = mysqli_num_rows($load_review_result);
      $total_review = 0;
      $total_rating = 0;
      while($row = $load_review_result->fetch_assoc()){ 
        $reviews[] = $row;
        $total_rating += (int)$row['stars'];
        $total_review++;
      }
        echo '<div class="rating">';
        if ($total_review > 0) {
            $avg_rating = $total_rating / $total_review;
            echo '<div class="rating">'.$avg_rating.' ★</div> ';
            
        } else {
            echo "0 ratings & 0";
        }

        echo ' </div> <b>'.$count.' Reviews </b> <ul class="specs">'.$product_description.'

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
