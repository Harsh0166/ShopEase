<?php
  include_once("conncetion.php");

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Product Detail - ShopEase</title>
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

    /* Main Section */
    .product-detail {
      display: flex;
      flex-direction: column;
      padding: 2rem;
      gap: 1.5rem;
      background: white;
      margin: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .product-detail img {
      max-width: 300px;
      margin: 0 auto;
    }

    .product-info {
      text-align: center;
    }

    .product-info h2 {
      font-size: 2rem;
      margin-bottom: 0.5rem;
    }

    .rating {
      color: gold;
      margin-bottom: 0.5rem;
    }

    .price {
      font-size: 1.5rem;
      color: #e74c3c;
      margin-bottom: 1rem;
    }

    .description {
      margin-bottom: 1.5rem;
      line-height: 1.6;
    }

    .specs-table {
      width: 100%;
      border-collapse: collapse;
      margin: 1rem 0;
    }

    .specs-table th, .specs-table td {
      padding: 0.75rem;
      border: 1px solid #ddd;
      text-align: left;
    }

    .specs-table th {
      background-color: #f0f0f0;
    }

    .add-to-cart {
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      background-color: #111;
      color: white;
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

      .product-detail {
        flex-direction: row;
        align-items: flex-start;
      }

      .product-detail img {
        margin: 0;
      }

      .product-info {
        text-align: left;
        flex: 1;
        margin-left: 2rem;
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
    <a href="cart.html"><i class="fas fa-cart-shopping"></i> Cart</a>
    <a href="profile.html"><i class="fas fa-user"></i> Profile</a>
      </nav>
    </div>
  </header>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
    <a href="cart.html"><i class="fas fa-cart-shopping"></i> Cart</a>
    <a href="profile.html"><i class="fas fa-user"></i> Profile</a>
  </div>
  <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

  <section class="product-detail">
    <img src="https://picsum.photos/300?random=1" alt="Product Image">
    <div class="product-info">
      <h2>Smartphone X1 Pro</h2>
      <div class="rating">
        ★★★★☆ (4.2/5) - 145 Reviews
      </div>
      <div class="price">$499.99</div>
      <p class="description">
        Experience cutting-edge technology with the Smartphone X1 Pro. With its sleek design, fast processor, and vibrant display, it’s built for everything from gaming to productivity.
      </p>
      <button class="add-to-cart">Add to Cart</button>
    </div>
  </section>
  
  <section class="product-detail">
    
      <!-- Rating Section -->
      <div>
        <h3 style="margin-bottom:1rem;">Customer Ratings</h3>
        <div>
          ★★★★★ - 70% <br>
          ★★★★☆ - 20% <br>
          ★★★☆☆ - 7% <br>
          ★★☆☆☆ - 2% <br>
          ★☆☆☆☆ - 1%
        </div>
      </div>
     
      <!-- Review Section -->
      <!-- Review Section -->
<div>
  <h3 style="margin-bottom:1rem;">Customer Reviews</h3>
  <div style="max-height:250px; overflow-y:auto; padding-right:0.5rem;">
    <div style="margin-bottom:1rem;">
      <strong>John D.</strong> <br>
      ★★★★★ <br>
      "Amazing phone! Battery life is superb and the camera quality is outstanding."
    </div>
    <div style="margin-bottom:1rem;">
      <strong>Sarah K.</strong> <br>
      ★★★★☆ <br>
      "Love the smooth display and fast charging. Slightly bulky though."
    </div>
    <div style="margin-bottom:1rem;">
      <strong>Mike W.</strong> <br>
      ★★★★☆ <br>
      "Performance is great for gaming. Worth the price!"
    </div>
    <!-- You can add more reviews here -->
    <div style="margin-bottom:1rem;">
      <strong>Emily R.</strong> <br>
      ★★★★★ <br>
      "Best phone I've ever used. Display is fantastic!"
    </div>
    <div style="margin-bottom:1rem;">
      <strong>Chris B.</strong> <br>
      ★★★☆☆ <br>
      "Average experience. Good camera but heating issue."
    </div>
  </div>
  <!-- Write a Review Button -->
<button onclick="openReviewForm()" style="margin: 1rem 2rem; padding: 0.75rem 1.5rem; background-color: #111; color: white; border: none; border-radius: 5px; cursor: pointer;">
  Write a Review
</button>
</div>



      </section>

<section class="product-detail">
      <!-- Similar Products Section -->
<h2>Similar Products</h2>
<div style="overflow-x: auto; white-space: nowrap; padding: 1rem; margin-bottom: 2rem;">
  <div style="display: inline-block; width: 200px; margin-right: 1rem; background: #fff; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
    <img src="https://picsum.photos/200?random=11" alt="Product 1" style="width: 100%; border-top-left-radius:8px; border-top-right-radius:8px;">
    <div style="padding: 0.5rem;">
      <h4 style="font-size: 1rem;">Smartwatch Y2</h4>
      <p style="color: #e74c3c;">$199.99</p>
    </div>
  </div>

  <div style="display: inline-block; width: 200px; margin-right: 1rem; background: #fff; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
    <img src="https://picsum.photos/200?random=12" alt="Product 2" style="width: 100%; border-top-left-radius:8px; border-top-right-radius:8px;">
    <div style="padding: 0.5rem;">
      <h4 style="font-size: 1rem;">Wireless Earbuds</h4>
      <p style="color: #e74c3c;">$99.99</p>
    </div>
  </div>

  <div style="display: inline-block; width: 200px; margin-right: 1rem; background: #fff; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
    <img src="https://picsum.photos/200?random=13" alt="Product 3" style="width: 100%; border-top-left-radius:8px; border-top-right-radius:8px;">
    <div style="padding: 0.5rem;">
      <h4 style="font-size: 1rem;">Bluetooth Speaker</h4>
      <p style="color: #e74c3c;">$59.99</p>
    </div>
  </div>

  <!-- Add more products if you want -->
</div>
</section>
  
  <!-- Your footer remains same -->
  <footer>
    &copy; 2025 ShopEase. All rights reserved.
  </footer>

  <script>
    function toggleMenu() {
      document.getElementById('sidebar').classList.toggle('open');
      document.getElementById('overlay').classList.toggle('active');
    }

    let selectedRating = 0;

function openReviewForm() {
  document.getElementById('reviewForm').style.display = 'block';
}

function closeReviewForm() {
  document.getElementById('reviewForm').style.display = 'none';
  selectedRating = 0;
  resetStars();
}

function setRating(rating) {
  selectedRating = rating;
  const stars = document.querySelectorAll('#stars i');
  stars.forEach((star, index) => {
    if (index < rating) {
      star.classList.remove('fa-regular');
      star.classList.add('fa-solid');
    } else {
      star.classList.add('fa-regular');
      star.classList.remove('fa-solid');
    }
  });
}

function resetStars() {
  const stars = document.querySelectorAll('#stars i');
  stars.forEach(star => {
    star.classList.add('fa-regular');
    star.classList.remove('fa-solid');
  });
}

function submitReview() {
  const reviewText = document.getElementById('reviewText').value;
  if (selectedRating === 0 || reviewText.trim() === '') {
    alert('Please give a rating and write a review!');
    return;
  }
  // Here you can save the review in your backend or localStorage
  alert(`Review Submitted!\nRating: ${selectedRating} Stars\nReview: ${reviewText}`);
  closeReviewForm();
}


  </script>


<!-- Review Popup Form -->
<div id="reviewForm" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); z-index:1000;">
  <div style="background:white; width:90%; max-width:400px; margin:5% auto; padding:2rem; border-radius:8px; position:relative;">
    <h3 style="margin-bottom: 1rem;">Write Your Review</h3>

    <!-- Star Rating -->
    <div id="stars" style="font-size:2rem; color:gold; margin-bottom:1rem; text-align: center;">
      <i class="fa-regular fa-star" onclick="setRating(1)"></i>
      <i class="fa-regular fa-star" onclick="setRating(2)"></i>
      <i class="fa-regular fa-star" onclick="setRating(3)"></i>
      <i class="fa-regular fa-star" onclick="setRating(4)"></i>
      <i class="fa-regular fa-star" onclick="setRating(5)"></i>
    </div>

    <textarea id="reviewText" placeholder="Write your review here..." style="width:100%; height:100px; margin-bottom:1rem; padding:0.5rem; border:1px solid #ccc; border-radius:5px;"></textarea>

    <div style="text-align: right;">
      <button onclick="closeReviewForm()" style="background-color: #ccc; color: black; padding: 0.5rem 1rem; margin-right: 0.5rem; border: none; border-radius: 5px;">Cancel</button>
      <button onclick="submitReview()" style="background-color: #111; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px;">Submit</button>
    </div>
  </div>
</div>


</body>
</html>
