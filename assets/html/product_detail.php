<?php
  include_once("connection.php");

  if(isset($_GET['sno'])){
    $sno = $_GET['sno'];
    $product_detail_sql ="SELECT * FROM `product_detail` WHERE `s. no.` = $sno";
    $product_detail_result = mysqli_query($conn,$product_detail_sql);
    $row = $product_detail_result->fetch_assoc();
    $product_name = $row['product_name'];
    $price = $row['price'];
    $description = $row['description'];
    $image = $row['image'];
  }

   if(isset($_POST['review'])){
    $username = $_SESSION['username'];
    $review = $_POST['review'];
    $product_id = $sno;
    $user_id = $_SESSION['user_id'];
    
    $load_only_review_sql = "SELECT * FROM `review` WHERE `product_id` = '$product_id' And `user_id`='$user_id'";
    $load_only_review_result = mysqli_query($conn,$load_only_review_sql);
    $count = mysqli_num_rows($load_only_review_result);

    if($count == 0){
          $review_sql ="INSERT INTO `review`(`sno`, `name`, `stars`, `product_id`, `user_id`, `description`) VALUES (Null,'$username','','$product_id','$user_id','$review')";
          $review_result = mysqli_query($conn,$review_sql);
          if($review_result){
            header("Location: product_detail.php?sno=$sno");
          }
    }
    else{
      $review_update_sql = "UPDATE `review` SET `stars`='',`description`='$review' WHERE `product_id` = '$product_id' And `user_id`='$user_id'";
      mysqli_query($conn,$review_update_sql);
    }

   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Product Detail - ShopEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../css/homepage_sidebar.css">
  <link rel="stylesheet" href="../css/navbar.css">
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

.product-detail {
 display: flex;
  gap: 20px;
  align-items: flex-start;
  padding: 20px;
  flex-wrap: wrap;
}


.product-image img {
  width: 700px;
  height: auto;
  border-radius: 10px;
}

.product-info {
    max-width: 600px;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
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
       .pc-navbar {
        display: none;
      }

      .mobile-navbar {
        display: flex;
      }
      .img_&_detail {
    flex-direction: column;
    align-items: center;
  }

  .product-info {
    text-align: center;
    margin-top: 1rem;
  }
    }

    @media (min-width: 769px) {
         .mobile-navbar {
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

 <!-- Desktop Navbar -->
  <div class="pc-navbar">
    <div class="logo"><i class="fas fa-store"></i> ShopEase</div>
    <div class="search-bar">
      <input type="text" placeholder="Search products...">
    </div>
    <nav>
      <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
      <a href="cart.html"><i class="fas fa-cart-shopping"></i> Cart</a>
      <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    </nav>
  </div>

  <!-- Mobile Navbar -->
  <div class="mobile-navbar">
    <div class="mobile-top">
      <div class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
      <div class="logo"><i class="fas fa-store"></i> ShopEase</div>
    </div>
    <div class="mobile-search">
      <input type="text" placeholder="Search products...">
    </div>
  </div>

  <!-- Sidebar Menu -->
  <div class="sidebar" id="sidebar">
    <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
    <a href="cart.html"><i class="fas fa-cart-shopping"></i> Cart</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
  </div>
  <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

 <section class="product-detail">
    <?php 
      $product_id = $sno;
      $load_review_sql = "SELECT * FROM `review` WHERE `product_id`= '$product_id'";
      $load_review_result = mysqli_query($conn,$load_review_sql);

      echo '
    <div class="product-image">
      <img src="https://picsum.photos/300?random=1" alt="Product Image" />
    </div>
    <div class="product-info">
      <h2>'.$product_name .'</h2>
      <div class="rating">★★★★☆ (4.2/5) - 145 Reviews</div>
      <div class="price">Rs '.$price.'</div>
      <p class="description">'.$description.'</p>
      <button class="add-to-cart">Add to Cart</button>

   
      <h3 style="margin: 2rem 0 1rem;">Customer Ratings</h3>
      <div>
        ★★★★★ - 70% <br>
        ★★★★☆ - 20% <br>
        ★★★☆☆ - 7% <br>
        ★★☆☆☆ - 2% <br>
        ★☆☆☆☆ - 1%
      </div>

      <h3 style="margin: 2rem 0 1rem;">Customer Reviews</h3>
         <button onclick="openReviewForm()" class="add-to-cart" style="margin-top: 1rem;">
        Write a Review
      </button> <br>
      <div style="max-height:250px; overflow-y:auto; padding-right:0.5rem;">
        <div style="margin-bottom:1rem;">';

         while($row = $load_review_result->fetch_assoc()){
      $review_name = $row['name'];
      $review_desc = $row['description'];
      echo '
          <strong>'.$review_name.'</strong><br>★★★★★<br>"'.$review_desc.'"<br>'; };
        '</div>';
    ?>
      
      </div>

</section>
   

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
    <form action="" method="POST">
    <textarea name="review" required id="reviewText" placeholder="Write your review here..." style="width:100%; height:100px; margin-bottom:1rem; padding:0.5rem; border:1px solid #ccc; border-radius:5px;" ></textarea>

    <div style="text-align: right;">
      <button type="button" onclick="closeReviewForm()" style="background-color: #ccc; color: black; padding: 0.5rem 1rem; margin-right: 0.5rem; border: none; border-radius: 5px;">Cancel</button>
      <button type="submit" style="background-color: #111; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px;">Submit</button>
    </form>
    </div>
  </div>
</div>


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

    // let selectedRating = 0;

function openReviewForm() {
  document.getElementById('reviewForm').style.display = 'block';
}

function closeReviewForm() {
  document.getElementById('reviewForm').style.display = 'none';
  // selectedRating = 0;
  // resetStars();
}

// function setRating(rating) {
//   selectedRating = rating;
//   const stars = document.querySelectorAll('#stars i');
//   stars.forEach((star, index) => {
//     if (index < rating) {
//       star.classList.remove('fa-regular');
//       star.classList.add('fa-solid');
//     } else {
//       star.classList.add('fa-regular');
//       star.classList.remove('fa-solid');
//     }
//   });
// }

// function resetStars() {
//   const stars = document.querySelectorAll('#stars i');
//   stars.forEach(star => {
//     star.classList.add('fa-regular');
//     star.classList.remove('fa-solid');
//   });
// }

// function submitReview() {
//   const reviewText = document.getElementById('reviewText').value;
//   if (selectedRating === 0 || reviewText.trim() === '') {
//     alert('Please give a rating and write a review!');
//     return;
//   }
//   // Here you can save the review in your backend or localStorage
//   alert(`Review Submitted!\nRating: ${selectedRating} Stars\nReview: ${reviewText}`);
//   closeReviewForm();
// }

//  var loc = window.location.href;
//     loc=loc.split("?")[1].split("=")[2];
//     if(loc == 1){
//         alert("Added successfully");
//     }
//     else if(loc==2){

//           alert("Not added");
//     }

//       function toggleMenu() {
//       document.getElementById('sidebar').classList.toggle('open');
//     }

  </script>
</body>
</html>
