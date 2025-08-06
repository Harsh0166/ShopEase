<?php
  include_once("connection.php");
  if(!isset($_SESSION['username'])){
  header("Location: ../../index.php");
}

  if(isset($_GET['sno'])){
    $sno = $_GET['sno'];
    $product_detail_sql ="SELECT * FROM `product_detail` WHERE `s. no.` = $sno";
    $product_detail_result = mysqli_query($conn,$product_detail_sql);
    $row = $product_detail_result->fetch_assoc();
    $product_name = $row['product_name'];
    $price = $row['price'];
    $description = $row['description'];
    $image = $row['image'];
    $category = $row['category'];
  }

   if(isset($_POST['review']) && isset($_POST['star'])){
    $username = $_SESSION['username'];
    $review = $_POST['review'];
    $product_id = $sno;
    $product_names = $product_name;
    $user_id = $_SESSION['user_id'];
    $star = $_POST['star'];

    
    $load_only_review_sql = "SELECT * FROM `review` WHERE `product_id` = '$product_id' And `user_id`='$user_id'";
    $load_only_review_result = mysqli_query($conn,$load_only_review_sql);
    $count = mysqli_num_rows($load_only_review_result);

    if($count == 0){
          $review_sql ="INSERT INTO `review`(`sno`, `name`, `stars`, `product_id`,`product_name`, `user_id`, `description`) VALUES (Null,'$username','$star','$product_id','$product_name','$user_id','$review')";
          $review_result = mysqli_query($conn,$review_sql);
          if($review_result){
            echo "<script>
        alert('Review Added Successfully');
        window.location.href = 'product_detail.php?sno=".$sno."';
        </script>";
          }

    }
    else{
      $review_update_sql = "UPDATE `review` SET `stars`='$star',`description`='$review' WHERE `product_id` = '$product_id' And `user_id`='$user_id'";
      $review_update_result =  mysqli_query($conn,$review_update_sql);

      if($review_update_result){
      echo "<script>
        alert('Review Updated Successfully');
        window.location.href = 'product_detail.php?sno=".$sno."';
        </script>";}

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
  <link rel="stylesheet" href="../css/slider.css">
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
  color: #111;
}
.product-detail {
  display: grid;
  grid-template-columns: 1.2fr 2fr;
  gap: 30px;
  align-items: start;
  padding: 30px 0 30px 0;
  max-width: 1200px;
  margin: 0 auto 5rem auto;
  height: calc(100vh - 100px); /* make use of full height */
}

.product-image {
  position: sticky;
  top: 100px; /* leaves space for navbar */
  width: 500px;
  height: 600px;
  background: white;
  padding: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #ddd;
  border-radius: 10px;
}

.product-image img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}



.product-info {
  height: 100%;
  overflow-y: auto;
  padding-right: 10px;
}

.product-info::-webkit-scrollbar {
  width: 0;
}
.product-info h2 {
  font-size: 2rem;
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
  text-align: center;
  text-decoration: none;
}

    footer {
      background-color: #111;
      color: white;
      text-align: center;
      padding: 1rem;
    }
    .rating {
      display: inline-block;
      background: #388e3c;
      color: #fff;
      padding: 2px 6px;
      border-radius: 4px;
      font-size: 12px;
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

 <section class="product-detail">
    <?php 
      $product_id = $sno;
      $load_review_sql = "SELECT * FROM `review` WHERE `product_id`= '$product_id'";
      $load_review_result = mysqli_query($conn,$load_review_sql);
      $count = mysqli_num_rows($load_review_result);
      $total_review = 0;
      $total_rating = 0;
      $reviews = [];
      $five_star = 0;
      $four_star=0;
      $three_star=0;
      $two_star=0;
      $one_star=0;
      while($row = $load_review_result->fetch_assoc()){ 
        $reviews[] = $row;
        $total_rating += (int)$row['stars'];
        $total_review++;
        if((int)$row['stars'] == 5){
          $five_star++;
        }
        else if((int)$row['stars'] == 4){
          $four_star++;
        }
        else if((int)$row['stars'] == 3){
          $three_star++;
        }
        else if((int)$row['stars'] == 2){
          $two_star++;
        }
        else if((int)$row['stars'] == 1){
          $one_star++;
        }
      }

      echo '
    <div class="product-image" id="productImage">
      <img src="../img/'.$image.'" alt="image not found">
    </div>
    <div class="product-info" id="productInfo" >
      <h2>'.$product_name .'</h2>
      <div class="rating"><b>';
      
      if ($total_review > 0) {
            $avg_rating = $total_rating / $total_review;
            echo '<div class="rating">'.$avg_rating.' ★</div> ';
            
        } else {
            echo '<div class="rating"> 0 ★</div>';
        }
      
      echo '</b></div> <b>'.$count.' Reviews </b>
      <div class="price">Rs '.$price.'</div>
      <p class="description">'.$description.'</p>
      <a href="add_to_cart.php?product_id='.$sno.'&product_name='.$product_name.'&price='.$price.'&product_image='.$image.'"  class="add-to-cart">Add to Cart</a>

   
      <h3 style="margin: 2rem 0 1rem;">Customer Ratings</h3>
      <div>

        ★★★★★ - '.$five_star.' <br>
        ★★★★☆ - '.$four_star.'<br>
        ★★★☆☆ - '.$three_star.'<br>
        ★★☆☆☆ - '.$two_star.' <br>
        ★☆☆☆☆ - '.$one_star.'
      </div>

      <h3 style="margin: 2rem 0 1rem;">Customer Reviews</h3>
         <button onclick="openReviewForm()" class="add-to-cart" style="margin-top: 1rem;">
        Write a Review
      </button> <br><br>
      <div style="max-height:250px; overflow-y:auto; padding-right:0.5rem;">
        <div style="margin-bottom:1rem;">';


      $i = 0;
      while($i < count($reviews)){
        $review_name = $reviews[$i]['name'];
        $review_desc = $reviews[$i]['description'];
        $review_stars = $reviews[$i]['stars'];

      $stars_html = '';
      for ($i = 1; $i <= 5; $i++) {
        if ($i <= $review_stars) {
          $stars_html .= '<i class="fa-solid fa-star" style="color:#388E3C;"></i>';
        } else {
          $stars_html .= '<i class="fa-regular fa-star" style="color:#388E3C;"></i>';
        }
      }
      echo '
          <strong>'.$review_name.'</strong><br>'.$stars_html.'<br>"'.$review_desc.'"<br>'; 
        '</div>';
    }
    ?>
      
      </div>

</section>
   

<div id="reviewForm" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); z-index:1000;">
  <div style="background:white; width:90%; max-width:400px; margin:5% auto; padding:2rem; border-radius:8px; position:relative;">
    <h3 style="margin-bottom: 1rem;">Write Your Review</h3>
      <form action="" method="POST">

    <!-- Star Rating -->
    <div id="stars" style="font-size:2rem; color:gold; margin-bottom:1rem; text-align: center;">
      <i class="fa-regular fa-star" onclick="setRating(1)"></i>
      <i class="fa-regular fa-star" onclick="setRating(2)"></i>
      <i class="fa-regular fa-star" onclick="setRating(3)"></i>
      <i class="fa-regular fa-star" onclick="setRating(4)"></i>
      <i class="fa-regular fa-star" onclick="setRating(5)"></i>
    </div>

    <input type="hidden" name="star" id="ratingValue" required>

    <textarea name="review" required id="reviewText" placeholder="Write your review here..." style="width:100%; height:100px; margin-bottom:1rem; padding:0.5rem; border:1px solid #ccc; border-radius:5px;" ></textarea>

    <div style="text-align: right;">
      <button type="button" onclick="closeReviewForm()" style="background-color: #ccc; color: black; padding: 0.5rem 1rem; margin-right: 0.5rem; border: none; border-radius: 5px;">Cancel</button>
      <button type="submit" style="background-color: #111; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px;">Submit</button>
    </div>
    </form>
    </div>
  </div>
</div>


  <div id="categorySections">
  <h3>Silmiar Product</h3><br>
  <div class="product-row">
 
    <?php
      $product_id = $sno;

      $similar_product_sql = "SELECT * FROM `product_detail` WHERE `category` ='$category'";
      $similar_product_result = mysqli_query($conn,$similar_product_sql);

      while($row=$similar_product_result->fetch_assoc()){
        $category_product_name = $row['product_name'];
        $category_product_price = $row['price'];
        $category_product_image = $row['image'];
        $category_product_id = $row['s. no.'];

            echo '<div class="product-card">
              <a href="product_detail.php?sno='.$category_product_id.'">
              <img src="../img/'.$category_product_image.'" alt="image not found">
              <h4>'.$category_product_name.'</h4>
              <p> Rs '.$category_product_price.'</p>
              </a>
              </div>';
          };

    ?>
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
  const imageBox = document.getElementById("productImage");
  const infoBox = document.getElementById("productInfo");

  imageBox.addEventListener("wheel", function (e) {
    e.preventDefault();

    infoBox.scrollTop += e.deltaY;
  });

  function setRating(rating) {
    const stars = document.querySelectorAll('#stars i');
    stars.forEach((star, index) => {
      star.classList.remove('fa-solid');
      star.classList.add('fa-regular');
      if (index < rating) {
        star.classList.remove('fa-regular');
        star.classList.add('fa-solid');
      }
    });

    document.getElementById('ratingValue').value = rating;
  }

  function closeReviewForm() {
    document.getElementById('reviewForm').style.display = 'none';
  }


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


  </script>
</body>
</html>
